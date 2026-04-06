<?php
include '../includes/conexion.php';
include '../includes/auth.php';

requireRole(['1']);

$id = intval($_GET['id']);

$id_grupo_trabajadores = isset($_GET['id_grupo_trabajadores']) 
    ? trim($_GET['id_grupo_trabajadores']) 
    : null;

if(isset($_GET['id_cliente']) && $_SERVER["REQUEST_METHOD"] != "POST"){
    $id_cliente = intval($_GET['id_cliente']);
    $id_operacion = intval($_GET['id']);
	$id_grupo_trabajadores = trim($_GET['id_grupo_trabajadores']);

    $conn->query("
        UPDATE operacion 
        SET id_cliente = $id_cliente 
        WHERE id_operacion = $id_operacion
    ");

    if(isset($_GET['ajax']) && $_GET['ajax'] === '1') {
        header('Content-Type: application/json');
        $cliente = $conn->query("SELECT * FROM crm WHERE id_cliente = $id_cliente")->fetch_assoc();
        if($cliente){
            echo json_encode([
                'success' => true,
                'cliente' => [
                    'nombre' => $cliente['nombre'],
                    'apellidos' => $cliente['apellidos'],
                    'direccion' => $cliente['direccion'],
                    'entre_calles' => $cliente['entre_calles'],
                    'correo' => $cliente['correo'],
                    'numero_telefonico' => $cliente['numero_telefonico']
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cliente no encontrado']);
        }
        exit;
    }

    header("Location: editar.php?id=".$id_operacion."&id_grupo_trabajadores=".$id_grupo_trabajadores);
    exit;
}

include '../includes/header.php';

$operacion = $conn->query("
SELECT * FROM operacion WHERE id_operacion=$id
")->fetch_assoc();

$id_cliente = isset($_GET['id_cliente']) 
    ? intval($_GET['id_cliente']) 
    : $operacion['id_cliente'];

//Sección de listado de entidades existentes en tablas
$result_trabajadores = $conn->query("
SELECT R.id_trabajador,
	   R.nombre, 
	   R.apellidos, 
	   R.correo, 
	   R.numero_telefonico,
	   GT.id_grupo_trabajadores FROM rh AS R INNER JOIN 
	   grupo_trabajadores AS GT ON GT.id_trabajador = R.id_trabajador INNER JOIN 
	   grupos_trabajadores AS GTR ON GTR.id_grupo_trabajadores = GT.id_grupo_trabajadores INNER JOIN 
	   operacion AS O ON O.id_grupo_trabajadores = GTR.id_grupo_trabajadores WHERE O.id_operacion =$id
");

$result_cliente = $conn->query("
SELECT C.id_cliente,
	   C.nombre, 
	   C.apellidos,
       C.direccion,
       C.entre_calles,
	   C.correo, 
	   C.numero_telefonico FROM crm AS C INNER JOIN 
	   operacion AS O ON O.id_cliente = C.id_cliente WHERE O.id_operacion = $id
");

$result_grupo_productos = $conn->query("
SELECT P.id_producto,
	   P.nombre, 
	   GP.cantidad, 
	   P.conservado, 
	   P.tipo,
	   P.marca FROM productos AS P INNER JOIN 
	   grupo_productos AS GP ON GP.id_producto = P.id_producto INNER JOIN 
	   grupos_productos AS GSP ON GSP.id_grupo_productos = GP.id_grupo_productos INNER JOIN 
	   operacion AS O ON O.id_grupo_productos = GSP.id_grupo_productos WHERE O.id_operacion = $id
");

$result_grupo_materiales = $conn->query("
SELECT M.id_material,
	   M.nombre, 
	   GM.cantidad,  
	   M.marca,
	   GM.id_grupo_materiales FROM material AS M INNER JOIN 
	   grupo_materiales AS GM ON GM.id_material = M.id_material INNER JOIN 
	   grupos_materiales AS GSM ON GSM.id_grupo_materiales = GM.id_grupo_materiales INNER JOIN 
	   operacion AS O ON O.id_grupo_materiales = GSM.id_grupo_materiales WHERE O.id_operacion = $id
");

$result_clientes = $conn->query("
SELECT * FROM crm;
");

if(!$operacion){
    header("Location: listar.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $trabajo_realizado = trim($_POST['trabajo_realizado']);
	$estatus = isset($_POST['estatus']) ? trim($_POST['estatus']) : '';
    $id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : 0;
	
    $stmt = $conn->prepare("
        UPDATE operacion 
        SET trabajo_realizado=?, estatus=?, id_cliente=?
        WHERE id_operacion=?
    ");

    $stmt->bind_param("ssii",$trabajo_realizado,$estatus,$id_cliente,$id);
    $stmt->execute();

    header("Location: editar.php?id=".$id."&id_grupo_trabajadores=".$id_grupo_trabajadores);
    exit;
}
?>

<div class="card shadow rounded-4">
<div class="card-body">

<h3 class="mb-4">✏️ Editar Operaci&oacute;n</h3>

<form method="POST" class="row g-3">

<input type="hidden" name="id_cliente" value="<?= $id_cliente; ?>">

<div class="col-12">
<label>Trabajo_realizado</label>
<input type="text" name="trabajo_realizado"
class="form-control"
value="<?= htmlspecialchars($operacion['trabajo_realizado']); ?>"
required>
</div>

<div class="col-md-6">
<label>Estatus</label>
<select name="estatus" class="form-select">
<option value="Terminado" <?= $operacion['estatus']=='Terminado'?'selected':'' ?>>Terminado</option>
<option value="En proceso" <?= $operacion['estatus']=='En proceso'?'selected':'' ?>>En proceso</option>
<option value="Cancelado" <?= $operacion['estatus']=='Cancelado'?'selected':'' ?>>Cancelado</option>
</select>
</div>

<div class="col-12 mt-3">
<button type="submit" class="btn btn-sm btn-warning">
    <i class="bi bi-arrow-repeat"></i> Actualizar trabajo realizado y estatus
</button>
</div>

<h4 class="col-12">Lista de trabajadores en la operaci&oacute;n</h4>

<div class="col-12 mt-3">
	<a href="agregar_trabajador.php?id=<?= $id; ?>&id_grupo_trabajadores=<?= $id_grupo_trabajadores; ?>" 
	class="btn btn-sm btn-warning">
	<i class="bi bi-person-plus"></i> Editar listado de trabajadores
	</a>
</div>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 300px; overflow-y: auto;" id="tabla-trabajadores-participantes">

<table class="table table-hover align-middle" id="tabla-trabajadores">
<thead class="table-light">
<tr>
<th>#</th>
<th>Nombre</th>
<th>Apellidos</th>
<th>Correo</th>
<th>Numero Tel&eacute;fonico</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result_trabajadores->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['apellidos']); ?></td>

<td><?= htmlspecialchars($row['correo']); ?></td>

<td><?= htmlspecialchars($row['numero_telefonico']); ?></td>

<td>
<button onclick="quitarTrabajador(<?= $row['id_trabajador']; ?>, '<?= $id_grupo_trabajadores; ?>', <?= $id; ?>)"
class="btn btn-sm btn-danger">
🗑️ Quitar
</button>

</td>

</tr>
<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

<h4 class="col-12">Datos de cliente</h4>

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th>Nombre</th>
<th>Apellidos</th>
<th>Direcci&oacute;n</th>
<th>Entre calles</th>
<th>Correo</th>
<th>Numero Tel&eacute;fonico</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>

<?php while($row = $result_cliente->fetch_assoc()): ?>

<td id="cliente-nombre"><?= htmlspecialchars($row['nombre']); ?></td>

<td id="cliente-apellidos"><?= htmlspecialchars($row['apellidos']); ?></td>

<td id="cliente-direccion"><?= htmlspecialchars($row['direccion']); ?></td>

<td id="cliente-entre_calles"><?= htmlspecialchars($row['entre_calles']); ?></td>

<td id="cliente-correo"><?= htmlspecialchars($row['correo']); ?></td>

<td id="cliente-numero_telefonico"><?= htmlspecialchars($row['numero_telefonico']); ?></td>

<td>
<a 
  class="btn btn-sm btn-warning"
  data-bs-toggle="collapse"
  href="#collapseCliente"
  role="button"
  aria-expanded="false"
  aria-controls="collapseCliente">
  <i class="bi bi-arrow-counterclockwise"></i> Cambiar
</a>
</td>

<?php endwhile; ?>

</tbody>
</table>

<div class="collapse mt-3" id="collapseCliente">
  <div class="card card-body" style="max-height: 400px; overflow-y: auto;">
	<table class="table table-hover align-middle">
	<thead class="table-light">
	<tr>
	<th>Nombre</th>
	<th>Apellidos</th>
	<th>Direcci&oacute;n</th>
	<th>Entre calles</th>
	<th>Correo</th>
	<th>Numero Tel&eacute;fonico</th>
	<th>Acciones</th>
	</tr>
	</thead>
	<tbody>

	<?php while($row = $result_clientes->fetch_assoc()): ?>

	<td><?= htmlspecialchars($row['nombre']); ?></td>

	<td><?= htmlspecialchars($row['apellidos']); ?></td>

	<td><?= htmlspecialchars($row['direccion']); ?></td>

	<td><?= htmlspecialchars($row['entre_calles']); ?></td>

	<td><?= htmlspecialchars($row['correo']); ?></td>

	<td><?= htmlspecialchars($row['numero_telefonico']); ?></td>
	
	<td>
	<a href="javascript:void(0);" class="btn btn-sm btn-secondary"
	   onclick="selectCliente(<?= $id; ?>, <?= $row['id_cliente']; ?>, '<?= $id_grupo_trabajadores; ?>')">
	<i class="bi bi-arrow-counterclockwise"></i> Seleccionar
	</a>
	</td>

	</tr>
	<?php endwhile; ?>
	</tbody>
	</table>
  </div>
</div>

<h4 class="col-12">Lista de productos en la operaci&oacute;n</h4>

<div class="col-12 mt-3">
	<a href="agregar_producto.php?id=<?= $id; ?>&id_grupo_productos=<?= $id_grupo_trabajadores; ?>"  
	class="btn btn-sm btn-warning">
	<i class="bi bi-cart-plus"></i> Editar listado de productos
	</a>
</div>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 300px; overflow-y: auto;">

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th>#</th>
<th>Nombre</th>
<th>Cantidad usada:</th>
<th>Consevado en:</th>
<th>Tipo</th>
<th>Marca</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result_grupo_productos->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['cantidad']); ?></td>

<td><?= htmlspecialchars($row['conservado']); ?></td>

<td><?= htmlspecialchars($row['tipo']); ?></td>

<td><?= htmlspecialchars($row['marca']); ?></td>


<td class="text-center">
<div class="d-flex flex-column flex-sm-row justify-content-center gap-1">

<button class="btn btn-success btn-sm"
        data-id="<?= $row['id_producto']; ?>"
        onclick="actualizarCantidad(<?= $row['id_producto']; ?>,'sumar','<?= $id_grupo_trabajadores; ?>' )"><i class="bi bi-plus-lg"></i>

<button class="btn btn-danger btn-sm"
        data-id="<?= $row['id_producto']; ?>"
        onclick="actualizarCantidad(<?= $row['id_producto']; ?>,'restar','<?= $id_grupo_trabajadores; ?>' )"><i class="bi bi-dash-lg"></i>

<button onclick="quitarProducto(<?= $row['id_producto']; ?>, '<?= $id_grupo_trabajadores; ?>', <?= $id; ?>)"
class="btn btn-sm btn-danger">
🗑️ Quitar
</button>

</div>
</td>


</tr>
<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

<h4 class="col-12">Lista de materiales en la operaci&oacute;n</h4>

<div class="col-12 mt-3">
	<a href="agregar_material.php?id=<?= $id; ?>&id_grupo_materiales=<?= $id_grupo_trabajadores; ?>" 
	class="btn btn-sm btn-warning">
	<i class="bi bi-cart-plus"></i> Editar listado de materiales
	</a>
</div>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 300px; overflow-y: auto;" id="tabla-trabajadores-participantes">

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th>#</th>
<th>Nombre</th>
<th>Cantidad usada:</th>
<th>Marca</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result_grupo_materiales->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['cantidad']); ?></td>

<td><?= htmlspecialchars($row['marca']); ?></td>

<td>

<button onclick="quitarMaterial(<?= $row['id_material']; ?>, '<?= $id_grupo_trabajadores; ?>', <?= $id; ?>)"
class="btn btn-sm btn-danger">
🗑️ Quitar
</button>

</td>


</tr>
<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

</form>

</div>
</div>

<div class="col-12 mt-3">
    <a href="listar.php" class="btn btn-secondary">
        <i class="bi bi-arrow-return-left"></i> Regresar
    </a>
</div>

<?php include '../includes/footer.php'; ?>

<script>
function quitarTrabajador(id, grupo_trabajadores) {

    console.log("ID trabajador:", id);
    console.log("Grupo:", grupo_trabajadores);

    if (!confirm("¿Seguro que quieres quitar este trabajador?")) return;

    sessionStorage.setItem('scrollPos', window.scrollY);

    fetch(`eliminar_trabajador.php?id=${id}&grupo=${grupo_trabajadores}`)
    .then(res => res.text())
}

function quitarProducto(id, grupo_productos, id_operacion) {

    if (!confirm("¿Seguro que quieres quitar este producto?")) return;

    fetch(`eliminar_producto.php?id=${id}&grupo=${grupo_productos}&operacion=${id_operacion}`)
    .then(res => res.text())
    .then(() => {
        location.reload();
    });
}

function quitarMaterial(id, grupo_material, id_operacion) {

    if (!confirm("¿Seguro que quieres quitar este material?")) return;

    fetch(`eliminar_material.php?id=${id}&grupo=${grupo_material}&operacion=${id_operacion}`)
    .then(res => res.text())
    .then(() => {
        location.reload();
    });
}

function actualizarCantidad(id, accion, grupo_productos){
    fetch("actualizar_cantidad.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + id + "&accion=" + accion + "&grupo=" + grupo_productos
    })
    .then(response => response.text())
    .then(cantidad => {
        if(cantidad.startsWith("ERROR")){
            alert(cantidad); 
			location.reload();
            return;
        }
		location.reload();
        document.getElementById("cantidad-" + id).innerText = cantidad;
    })
    .catch(error => console.error('Error:', error));
}

function selectCliente(idOperacion, idCliente, idGrupoTrabajadores) {
    fetch(`editar.php?id=${idOperacion}&id_cliente=${idCliente}&id_grupo_trabajadores=${idGrupoTrabajadores}&ajax=1`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert(data.message || 'No se pudo seleccionar cliente');
                return;
            }

            document.getElementById('cliente-nombre').textContent = data.cliente.nombre;
            document.getElementById('cliente-apellidos').textContent = data.cliente.apellidos;
            document.getElementById('cliente-direccion').textContent = data.cliente.direccion;
            document.getElementById('cliente-entre_calles').textContent = data.cliente.entre_calles;
            document.getElementById('cliente-correo').textContent = data.cliente.correo;
            document.getElementById('cliente-numero_telefonico').textContent = data.cliente.numero_telefonico;

            const collapseElement = document.querySelector('#collapseCliente');
            if (collapseElement && typeof bootstrap !== 'undefined') {
                const bs = new bootstrap.Collapse(collapseElement, { toggle: false });
                bs.show();
            }
        })
        .catch(error => {
            console.error(error);
            alert('Error en la petición, intente otra vez');
        });
}

// No forzamos desplazamiento de página en la carga.
window.addEventListener('load', function() {
    if (window.location.hash === '#collapseCliente') {
        const elemento = document.querySelector('#collapseCliente');
        if (elemento && typeof bootstrap !== 'undefined') {
            const bsCollapse = bootstrap.Collapse.getInstance(elemento) || new bootstrap.Collapse(elemento, { toggle: false });
            bsCollapse.show();
        }
    }
});

window.addEventListener('load', function () {
    const scrollPos = sessionStorage.getItem('scrollPos');
    if (scrollPos !== null) {
        window.scrollTo(0, parseInt(scrollPos));
        sessionStorage.removeItem('scrollPos');
    }
});
</script>
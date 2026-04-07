<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);

$result_clientes = $conn->query("
SELECT C.id_cliente,
	   C.nombre, 
	   C.apellidos,
       C.direccion,
       C.entre_calles,
	   C.correo, 
	   C.numero_telefonico FROM crm AS C
");

function generateRandomIdGrupo($length = 8) {
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $id_grupo = '';
    $charsetLength = strlen($charset) - 1;

    for ($i = 0; $i < $length; $i++) {
        $id_grupo .= $charset[rand(0, $charsetLength)];
    }

    return $id_grupo;
}
if($_SERVER['REQUEST_METHOD']=='POST'){

    $codigo_operacion = generateRandomIdGrupo();

    $trabajo_realizado = trim($_POST['trabajo_realizado']);
    $estatus = trim($_POST['estatus']);
    $id_cliente = intval($_POST['id_cliente']);
    $id_grupo_trabajadores = $codigo_operacion;
    $id_grupo_productos = $codigo_operacion;
    $id_grupo_materiales = $codigo_operacion;

    $conn->begin_transaction();

try {

    // Insertar en grupos_trabajadores
    $stmt = $conn->prepare("INSERT INTO grupos_trabajadores (id_grupo_trabajadores) VALUES (?)");
    $stmt->bind_param("s", $id_grupo_trabajadores);
    $stmt->execute();

    // Insertar en grupos_productos
    $stmt = $conn->prepare("INSERT INTO grupos_productos (id_grupo_productos) VALUES (?)");
    $stmt->bind_param("s", $id_grupo_productos);
    $stmt->execute();

    // Insertar en grupos_materiales
    $stmt = $conn->prepare("INSERT INTO grupos_materiales (id_grupo_materiales) VALUES (?)");
    $stmt->bind_param("s", $id_grupo_materiales);
    $stmt->execute();

    $stmt = $conn->prepare("
        INSERT INTO operacion 
        (trabajo_realizado, estatus, id_grupo_trabajadores, id_grupo_productos, id_grupo_materiales, id_cliente)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("sssssi",$trabajo_realizado,$estatus,$id_grupo_trabajadores,$id_grupo_productos,$id_grupo_materiales,$id_cliente);
    $stmt->execute();

    $conn->commit();
    header("Location: listar.php?exito=Se creo la nueva operaci&oacute;n");
    exit;
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>➕ Nueva operaci&oacute;n</h3>
</div>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-12">

<label class="form-label">Trabajo a realizar</label>
<input type="text" name="trabajo_realizado" class="form-control" required>
</div>

<div class="col-md-3">
<label class="form-label">Estatus</label>
<select name="estatus" class="form-select" required>
<option value="En proceso">En proceso</option>
<option value="Terminado">Terminado</option>
<option value="Cancelado">Cancelado</option>
</select>
</div>

<label class="form-label">Cliente a seleccionar</label>

<div id="mensaje-cliente" class="alert alert-info" style="display:none;"></div>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">


<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Nombre</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Apellidos</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Direcci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Entre calles</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Correo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Numero Tel&eacute;fonico</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Acciones</th>
</tr>
</thead>
<tbody>

<?php while($row = $result_clientes->fetch_assoc()): ?>
<tr>
<td id="cliente-nombre"><?= htmlspecialchars($row['nombre']); ?></td>

<td id="cliente-apellidos"><?= htmlspecialchars($row['apellidos']); ?></td>

<td id="cliente-direccion"><?= htmlspecialchars($row['direccion']); ?></td>

<td id="cliente-entre_calles"><?= htmlspecialchars($row['entre_calles']); ?></td>

<td id="cliente-correo"><?= htmlspecialchars($row['correo']); ?></td>

<td id="cliente-numero_telefonico"><?= htmlspecialchars($row['numero_telefonico']); ?></td>

<td>

<a href="javascript:void(0);"
   class="btn btn-sm btn-success"
   onclick="seleccionarCliente(<?= $row['id_cliente']; ?>, '<?= addslashes($row['nombre']); ?>')">
   Seleccionar
</a>
</td>
</tr>

<?php endwhile; ?>

</tbody>
</table>
</div>
</div>

<input type="hidden" name="id_cliente" id="id_cliente">

<div class="col-12">
<button class="btn btn-success">
💾 Guardar Producto
</button>
<a href="listar.php" class="btn btn-secondary">Cancelar</a>
</div>

</form>

</div>
</div>

<script>
function seleccionarCliente(id, nombre) {
    // Asigna el id al input hidden
    document.getElementById('id_cliente').value = id;

    // Muestra el mensaje
    const mensaje = document.getElementById('mensaje-cliente');
    mensaje.style.display = 'block';
    mensaje.textContent = `El cliente: ${nombre} fue seleccionado`;

    // Opcional: resalta la fila seleccionada
    document.querySelectorAll('table tbody tr').forEach(tr => tr.classList.remove('table-primary'));
    const fila = event.target.closest('tr');
    if(fila) fila.classList.add('table-primary');
}
</script>

<?php include '../includes/footer.php'; ?>
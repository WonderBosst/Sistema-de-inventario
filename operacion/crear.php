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

    $titulo = trim($_POST['titulo']);
    $escrito = trim($_POST['escrito']);
    $id_operacion = intval($_POST['id_operacion']);

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

    $nuevo_id_operacion = $conn->insert_id;

    if (!empty($titulo) && !empty($escrito)) {
        $stmt_nota = $conn->prepare("INSERT INTO notas (titulo, escrito, id_operacion) VALUES (?, ?, ?)");
        $stmt_nota->bind_param("ssii", $titulo, $escrito, $nuevo_id_operacion, $estatusnotas);
        $stmt_nota->execute();
    }

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

<form id="formOperacion" method="POST" class="row g-3">

<div class="col-12">

<label class="form-label">Trabajo a realizar</label>
<input type="text" name="trabajo_realizado" class="form-control" required>
</div>

<input type="hidden" name="estatus" value="En proceso">

<p class="d-inline-flex gap-1">
  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Agregar nota?
  </a>
</p>
<div class="collapse" id="collapseExample">
  <div class="col-md-6 mb-3">
    <label class="form-label">T&iacute;tulo de la nota</label>
    <input type="text" name="titulo" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Descripci&oacute;n</label>
    <div class="form-floating">
      <textarea class="form-control" name="escrito" placeholder="Agrega una descripci&oacute;n" id="floatingTextarea2" style="height: 100px"></textarea>
    </div>
  </div>
</div>


<label class="form-label">Cliente a seleccionar</label>

<div id="mensaje-cliente" class="alert alert-info" style="display:none;"></div>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">


<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
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
<?php $contador = 1; ?>
<?php while($row = $result_clientes->fetch_assoc()): ?>
<tr>

<td><strong><?= $contador; ?></strong></td>

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

<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>
</div>
</div>

<input type="hidden" name="id_cliente" id="id_cliente">

<div class="col-12">
<button class="btn btn-success">
💾 Guardar datos
</button>
<a href="listar.php" class="btn btn-secondary">Cancelar</a>
</div>

</form>

</div>
</div>

<script>
function seleccionarCliente(id, nombre) {
    document.getElementById('id_cliente').value = id;

   // Muestra el mensaje con estilo de éxito
    const mensaje = document.getElementById('mensaje-cliente');
    mensaje.style.display = 'block';
    mensaje.classList.remove('alert-info', 'alert-danger');
    mensaje.classList.add('alert-success');
    mensaje.innerHTML = `✅ <strong>Cliente seleccionado:</strong> ${nombre}`;

    // Resalta la fila seleccionada
    document.querySelectorAll('table tbody tr').forEach(tr => tr.classList.remove('table-primary'));
    const fila = event.target.closest('tr');
    if(fila) fila.classList.add('table-primary');
}

document.getElementById('formOperacion').addEventListener('submit', function(event) {
    const idCliente = document.getElementById('id_cliente').value;

    if (!idCliente || idCliente === "" || idCliente === "0") {
        // DETENEMOS EL ENVÍO
        event.preventDefault();

        // 1. Alerta nativa del navegador (puedes cambiarla por SweetAlert después)
        alert("⚠️ ¡Falta información!\n\nPor favor, selecciona un cliente de la lista antes de guardar la operación.");

        // 2. Cambiamos el diseño del mensaje para que resalte en rojo
        const mensaje = document.getElementById('mensaje-cliente');
        mensaje.style.display = 'block';
        mensaje.className = 'alert alert-danger animate__animated animate__shakeX'; // Clase shake si usas animate.css
        mensaje.innerHTML = "❌ <strong>Error:</strong> No has seleccionado ningún cliente.";

        // 3. Movemos el foco a la tabla de clientes
        mensaje.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>

<?php include '../includes/footer.php'; ?>
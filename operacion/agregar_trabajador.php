<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

if (!isset($_GET['id']) || !isset($_GET['id_grupo_trabajadores'])) {
    header("Location: editar.php");
    exit;
}

$id = intval($_GET['id']);
$id_grupo_trabajo = trim($_GET['id_grupo_trabajadores']);

// MENSAJE
$mensaje = "";

// PROCESAR AGREGAR
if($_SERVER['REQUEST_METHOD']=='POST'){

    $id_grupo_trabajadores = trim($_POST['id_grupo_trabajadores']);
    $id_trabajador = intval($_POST['id_trabajador']);

    $stmt = $conn->prepare("
        INSERT INTO grupo_trabajadores (id_grupo_trabajadores, id_trabajador)
        VALUES (?,?)
    ");

    $stmt->bind_param("si", $id_grupo_trabajadores, $id_trabajador);

    if($stmt->execute()){
        echo "ok";
    } else {
        echo "error";
    }
}

// MOSTRAR MENSAJE DESPUÉS DE REDIRECCIÓN
if(isset($_GET['msg'])){
    $mensaje = "Trabajador agregado a la operación";
}

// CONSULTA (la tuya está bien)
$result_trabajadores = $conn->query("
    SELECT R.nombre, 
           R.apellidos,
           R.correo, 
           R.numero_telefonico,
           R.id_trabajador 
    FROM rh AS R 
    WHERE R.id_trabajador NOT IN (
        SELECT id_trabajador 
        FROM grupo_trabajadores 
        WHERE id_grupo_trabajadores = '$id_grupo_trabajo'
    ) 
    AND R.activo = 1;
");
?>

<h3 class="mb-4">✏️ Editar integrantes en la operación</h3>

<h4 class="col-12">Lista de trabajadores disponibles</h4>

<?php if($mensaje): ?>
<div class="alert alert-success">
    <?= $mensaje; ?>
</div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 700px; overflow-y: auto;">

<table class="table table-hover align-middle small">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Nombre</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Apellidos</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Correo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Numero Teléfono</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Acciones</th>
</tr>
</thead>
<tbody>

<?php $contador = 1; ?>
<?php while($row = $result_trabajadores->fetch_assoc()): ?>

<tr>
<td><strong><?= $contador; ?></strong></td>
<td><?= htmlspecialchars($row['nombre']); ?></td>
<td><?= htmlspecialchars($row['apellidos']); ?></td>
<td><?= htmlspecialchars($row['correo']); ?></td>
<td><?= htmlspecialchars($row['numero_telefonico']); ?></td>

<td>
<form onsubmit="agregarTrabajador(event, <?= $row['id_trabajador']; ?>)" style="display:inline;">
    <input type="hidden" name="id_grupo_trabajadores" value="<?= $id_grupo_trabajo; ?>">
    <input type="hidden" name="id_trabajador" value="<?= $row['id_trabajador']; ?>">
    
    <button type="submit" class="btn btn-sm btn-success">
        <i class="bi bi-plus-lg"></i> Agregar
    </button>
</form>
</td>

</tr>

<?php $contador++; ?>
<?php endwhile; ?>

<?php if($contador === 1): ?>
<tr>
<td colspan="6" class="text-center text-muted">
    No hay trabajadores disponibles
</td>
</tr>
<?php endif; ?>

</tbody>
</table>

</div>
</div>

<div class="col-12 mt-3">
    <a href="editar.php?id=<?= $id; ?>&id_grupo_trabajadores=<?= $id_grupo_trabajo; ?>" 
    class="btn btn-sm btn-secondary">
    <i class="bi bi-arrow-return-left"></i> Regresar
    </a>
</div>

<?php include '../includes/footer.php'; ?>

<script>
function agregarTrabajador(event, id_trabajador){
    event.preventDefault();

    const id_grupo = "<?= $id_grupo_trabajo; ?>";

    fetch("agregar_trabajador_ajax.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id_trabajador=" + id_trabajador + "&id_grupo_trabajadores=" + id_grupo
    })
    .then(res => res.text())
    .then(respuesta => {

        event.target.closest("tr").remove();

        alert("Trabajador agregado");
    })
    .catch(err => console.error(err));
}
</script>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

$conn->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

requireRole(['1']);

if (!isset($_GET['id']) || !isset($_GET['id_grupo_materiales'])) {
    header("Location: editar.php");
    exit;
}

$id = intval($_GET['id']);
$id_grupo_materiales = trim($_GET['id_grupo_materiales']);

$mensaje = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

    $id_grupo_materiales = trim($_POST['id_grupo_materiales']);
    $id_material = intval($_POST['id_material']);

    $cantidad = intval($_POST['cantidad']);    

    $stmt = $conn->prepare("

        INSERT INTO grupo_materiales (id_grupo_materiales, id_material, cantidad)
        VALUES (?,?,?)
    ");

    $stmt->bind_param("sii", $id_grupo_materiales, $id_material, $cantidad);


    try {
        $stmt->execute();
        // Solo asignar mensaje, no redirigir todavía
        $mensaje = "Material agregado a la operación";
    } catch (mysqli_sql_exception $e) {
        // Captura específicamente el error del trigger
        if (strpos($e->getMessage(), 'No hay suficiente stock') !== false) {
            $mensaje = "No hay suficiente stock para este material";
        } else {
            $mensaje = "Ocurrió un error al agregar el material: " . $e->getMessage();
        }
    }
}

if(isset($_GET['msg'])){
    $mensaje = "Material agregado a la operación";
}

$result_materiales = $conn->query("
    SELECT M.id_material,
	   M.nombre, 
       M.cantidad,
       M.marca,
       M.fecha_creacion
       FROM material AS M 
    WHERE M.id_material NOT IN (
    SELECT id_material FROM grupo_materiales
    WHERE id_grupo_materiales = '$id_grupo_materiales'
    );
");
?>

<h3 class="mb-4">✏️ Editar materiales en la operación</h3>

<h4 class="col-12">Lista de materiales disponibles</h4>

<?php if($mensaje): ?>
    <div class="alert <?= strpos($mensaje,'stock') !== false ? 'alert-danger' : 'alert-success' ?>">
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
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Cantidad</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Marca</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha_creacion</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Acciones</th>
</tr>
</thead>
<tbody>

<?php $contador = 1; ?>
<?php while($row = $result_materiales->fetch_assoc()): ?>

<tr>
<td><strong><?= $contador; ?></strong></td>
<td><?= htmlspecialchars($row['nombre']); ?></td>
<td><?= htmlspecialchars($row['cantidad']); ?></td>
<td><?= htmlspecialchars($row['marca']); ?></td>
<td><?= htmlspecialchars($row['fecha_creacion']); ?></td>
<td>
<form method="POST" class="d-flex gap-2 align-items-center">
    <input type="number" name="cantidad" class="form-control" min="1" style="width: 80px;" required>
    <input type="hidden" name="id_grupo_materiales" value="<?= $id_grupo_materiales; ?>">
    <input type="hidden" name="id_material" value="<?= $row['id_material']; ?>">
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
    No hay material disponible
</td>
</tr>
<?php endif; ?>

</tbody>
</table>

</div>
</div>

<div class="col-12 mt-3">
    <a href="editar.php?id=<?= $id; ?>&id_grupo_trabajadores=<?= $id_grupo_materiales; ?>" 
    class="btn btn-sm btn-secondary">
    <i class="bi bi-arrow-return-left"></i> Regresar
    </a>
</div>

<?php include '../includes/footer.php'; ?>
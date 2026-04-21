<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

if (!isset($_GET['id']) || !isset($_GET['id_grupo_productos'])) {
    header("Location: editar.php");
    exit;
}

$id = intval($_GET['id']);
$id_grupo_productos = trim($_GET['id_grupo_productos']);

$mensaje = "";

if($_SERVER['REQUEST_METHOD']=='POST'){

    $id_grupo_productos = trim($_POST['id_grupo_productos']);
    $id_producto = intval($_POST['id_producto']);
	$consumido = intval($_POST['consumido']);
	
	$stmt = $conn->prepare("
        INSERT INTO grupo_productos (id_grupo_productos, id_producto, consumido, cantidad)
        VALUES (?,?,?,?)
    ");

    $stmt->bind_param("sii", $id_grupo_productos, $id_producto, $consumido, $cantidad);

    if($stmt->execute()){
        $mensaje = "Producto agregado a la operación";
    } else {
        $mensaje = "Error al agregar producto";
    }

    header("Location: agregar_producto.php?id=".$id."&id_grupo_productos=".$id_grupo_productos."&msg=1");
    exit;
}

if(isset($_GET['msg'])){
    $mensaje = "Producto agregado a la operación";
}

$result_productos = $conn->query("
    SELECT P.id_producto,
	   P.nombre, 
       P.cantidad,
       p.medida,
       P.conservado, 
       P.tipo,
       P.marca,
       P.fecha_creacion
    FROM productos AS P 
    WHERE P.id_producto NOT IN (
        SELECT id_producto 
        FROM grupo_productos
        WHERE id_grupo_productos = '$id_grupo_productos'
    );
");
?>

<h3 class="mb-4">✏️ Editar productos en la operación</h3>

<h4 class="col-12">Lista de productos disponibles</h4>

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
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Cantidad</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Medida</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Conservado en:</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Tipo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Marca</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha_creacion</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Acciones</th>
</tr>
</thead>
<tbody>

<?php $contador = 1; ?>
<?php while($row = $result_productos->fetch_assoc()): ?>

<tr>
<td><strong><?= $contador; ?></strong></td>
<td><?= htmlspecialchars($row['nombre']); ?></td>
<td><?= htmlspecialchars($row['cantidad']); ?></td>
<td><?= htmlspecialchars($row['medida']); ?></td>
<td><?= htmlspecialchars($row['conservado']); ?></td>
<td><?= htmlspecialchars($row['tipo']); ?></td>
<td><?= htmlspecialchars($row['marca']); ?></td>
<td><?= htmlspecialchars($row['fecha_creacion']); ?></td>

<td>
<form method="POST" class="d-flex gap-2 align-items-center">
    <input type="number" name="consumido" class="form-control" min="1" style="width: 80px;" required>
    <input type="hidden" name="id_grupo_productos" value="<?= $id_grupo_productos; ?>">
    <input type="hidden" name="id_producto" value="<?= $row['id_producto']; ?>">
    
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
    No hay productos disponibles
</td>
</tr>
<?php endif; ?>

</tbody>
</table>

</div>
</div>

<div class="col-12 mt-3">
    <a href="editar.php?id=<?= $id; ?>&id_grupo_trabajadores=<?= $id_grupo_productos; ?>" 
    class="btn btn-sm btn-secondary">
    <i class="bi bi-arrow-return-left"></i> Regresar
    </a>
</div>

<?php include '../includes/footer.php'; ?>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['admin','panadero']);
include '../includes/header.php';

$result = $conn->query("
SELECT p.*, pr.nombre 
FROM produccion p
JOIN productos pr ON p.producto_id = pr.id
WHERE p.activo = 1
ORDER BY p.fecha DESC
");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Producci&oacute;n</h3>
    <a href="crear.php" class="btn btn-primary">Nueva Producci&oacute;n</a>
</div>

<?php if(isset($_GET['exito'])): ?>
<div class="alert alert-success"><?= $_GET['exito'] ?></div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error'] ?></div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body table-responsive">

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th>#</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Costo Total</th>
<th>Fecha</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>

<?php $i=1; while($row=$result->fetch_assoc()): ?>
<tr>
<td><?= $i++ ?></td>
<td><?= htmlspecialchars($row['nombre']) ?></td>
<td><?= $row['cantidad_producida'] ?></td>
<td class="fw-bold text-success">
$<?= number_format($row['costo_total_usd'],2) ?>
</td>
<td><?= $row['fecha'] ?></td>
<td>
<a href="editar.php?id=<?= $row['id'] ?>" 
class="btn btn-sm btn-warning">✏️</a>

<a href="eliminar.php?id=<?= $row['id'] ?>" 
class="btn btn-sm btn-danger"
onclick="return confirm('¿Eliminar producci&oacute;n?')">🗑️</a>
</td>
</tr>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

<?php include '../includes/footer.php'; ?>
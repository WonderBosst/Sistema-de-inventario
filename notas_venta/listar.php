<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['admin','ventas']);

$result = $conn->query("SELECT * FROM notas_venta ORDER BY created_at DESC");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>📒 Notas de Venta</h3>
    <a href="crear.php" class="btn btn-success">➕ Nueva Nota</a>
</div>

<div class="card shadow rounded-4">
<div class="card-body table-responsive">

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th>#</th>
<th>Cliente</th>
<th>Total</th>
<th>Saldo</th>
<th>Entrega</th>
<th>Estado</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= htmlspecialchars($row['cliente'] ?? '-') ?></td>
<td>$<?= number_format($row['total_usd'],2) ?></td>
<td class="fw-bold text-danger">
$<?= number_format($row['saldo_usd'],2) ?>
</td>
<td><?= $row['fecha_entrega'] ?? '-' ?></td>
<td>
<span class="badge bg-<?=
$row['estado']=='pendiente'?'warning':
($row['estado']=='proceso'?'info':
($row['estado']=='entregado'?'success':'danger'))
?>">
<?= ucfirst($row['estado']) ?>
</span>
</td>
<td>
<a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
<a href="cambiar_estado.php?id=<?= $row['id'] ?>&estado=entregado"
class="btn btn-sm btn-success">✔</a>
</td>
</tr>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

<?php include '../includes/footer.php'; ?>
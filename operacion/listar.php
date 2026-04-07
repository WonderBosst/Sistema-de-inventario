<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

$result = $conn->query("
SELECT O.id_operacion, O.trabajo_realizado, O.estatus, C.nombre, C.direccion, O.fecha_creacion, O.fecha_finalizacion, O.id_grupo_trabajadores FROM operacion AS O INNER JOIN crm AS C ON C.id_cliente = O.id_cliente
");

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-clipboard-check"></i> Operaciones</h3>
    <a href="crear.php" class="btn btn-success">➕ Nueva operaci&oacute;n</a>
</div>


<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">

<table class="table table-hover align-middle small">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Trabajo realizado</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Cliente</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Direcci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Estatus</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha inicio</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha finalizaci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Accciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['trabajo_realizado']); ?></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['direccion']); ?></td>

<td>
<?php if($row['estatus'] == 'Terminado'): ?>
<span class="badge bg-success">Terminado</span>
<?php elseif($row['estatus'] == 'En proceso'): ?>
<span class="badge bg-info">En proceso</span>
<?php else: ?>
<span class="badge bg-danger">Cancelado</span>
<?php endif; ?>
</td>

<td><?= htmlspecialchars($row['fecha_creacion']); ?></td>

<td><?= htmlspecialchars($row['fecha_finalizacion']); ?></td>

<td>
<a href="editar.php?id=<?= $row['id_operacion']; ?>&id_grupo_trabajadores=<?= $row['id_grupo_trabajadores']; ?>" 
class="btn btn-sm btn-info">
<i class="bi bi-info-circle"></i> Informaci&oacute;n
</a>
</td>

</tr>
<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

<?php include '../includes/footer.php'; ?>
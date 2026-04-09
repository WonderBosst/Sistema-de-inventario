<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);

$result = $conn->query("
SELECT * FROM crm
");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-person-fill-add "></i> Clientes</h3>
    <a href="crear.php" class="btn btn-success">➕ Nuevo cliente</a>
</div>

<?php if(isset($_GET['exito'])): ?>
<div class="alert alert-success"><?= $_GET['exito'] ?></div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error'] ?></div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">

<table class="table table-hover align-middle small">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Nombre</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Apellidos</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Direcci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Entre calles</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Correo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">N&uacute;mero tel&eacute;fonico</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Suscripci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Acciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>

<?php while($row = $result->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['apellidos']); ?></td>

<td><?= htmlspecialchars($row['direccion']); ?></td>

<td><?= htmlspecialchars($row['entre_calles']); ?></td>

<td><?= htmlspecialchars($row['correo']); ?></td>

<td><?= ($row['numero_telefonico']); ?></td>

<td>
<?php if($row['activo'] == 1): ?>
<span class="badge bg-success">Usa servicio</span>
<?php else: ?>
<span class="badge bg-danger">Sin servicio</span>
<?php endif; ?>
</td>

<td class="text-center">
<div class="d-flex flex-column flex-sm-row justify-content-center gap-1">

<a href="editar.php?id=<?= $row['id_cliente'] ?>" 
class="btn btn-sm btn-warning">✏️</a>

</div>
</td>

</tr>
<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

<?php include '../includes/footer.php'; ?>
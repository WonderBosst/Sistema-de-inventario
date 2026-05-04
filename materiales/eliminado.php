<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

$result = $conn->query("
SELECT * FROM material WHERE estatus = false
");

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Material eliminado</h3>
    <a href="listar.php" class="btn btn-secondary">⬅ Volver</a>
</div>

<?php if(isset($_GET['exito'])): ?>
<div class="alert alert-success">
    <?= htmlspecialchars($_GET['exito']); ?>
</div>
<?php endif; ?>

<nav class="navbar bg-body-tertiary mb-3 rounded-4 shadow-sm">
  <div class="container-fluid">
    <div class="col-12 col-md-6"> <form class="d-flex" role="search" onsubmit="return false;">
        <input class="form-control" type="search" id="inputBusqueda" placeholder="Buscar materiales...">
      </form>
    </div>
  </div>
</nav>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">
    
<table class="table table-hover align-middle small" id="tablaMateriales">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Codigo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Nombre</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Marca</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Raz&oacute;n de eliminación</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha creaci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha eliminaci&oacute;n</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['codigo']); ?></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['marca']); ?></td>

<td>
    <?php if(!empty($row['razon'])): ?>
        <span class="text-muted italic small">
            <i class="bi bi-info-circle"></i> <?= htmlspecialchars($row['razon']); ?>
        </span>
    <?php else: ?>
        <span class="text-muted">No especificada</span>
    <?php endif; ?>
</td>

<td><?= htmlspecialchars($row['fecha_creacion']); ?></td>

<td><?= htmlspecialchars($row['fecha_eliminacion']); ?></td>


</tr>
<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const buscador = document.getElementById("inputBusqueda");
    const filas = document.querySelectorAll("#tablaMateriales tbody tr");

    buscador.addEventListener("keyup", function() {
        const termino = buscador.value.toLowerCase().trim();

        filas.forEach(fila => {
            const texto = fila.textContent.toLowerCase();
            fila.style.display = texto.includes(termino) ? "" : "none";
        });
    });
});

</script>

<?php include '../includes/footer.php'; ?>
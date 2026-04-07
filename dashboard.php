<?php
header('Content-Type: text/html; charset=utf8mb4');
include 'includes/conexion.php';
include 'includes/auth.php';
include 'includes/header.php';

$rol_usuario = $_SESSION['rol'] ?? '1';

?>

<h5 class="mb-3 fw-bold">Panel de Control</h5>

<div class="row g-4">

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="productos/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-basket fs-1 text-primary"></i>
<h6 class="mt-3">Productos</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="materiales/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-box-seam fs-1 text-warning"></i>
<h6 class="mt-3">Material</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="crm/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-person-fill-add fs-1 text-success"></i>
<h6 class="mt-3">CRM</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="rh/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-people fs-1 text-success"></i>
<h6 class="mt-3">RH</h6>
</div>
</a>
</div>
<?php endif; ?>

<!-- NUEVO MODULO NOTAS -->
<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="notas/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-journal-check fs-1 text-info"></i>
<h6 class="mt-3">Notas</h6>
</div>
</a>
</div>
<?php endif; ?>


<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="operacion/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-clipboard-check fs-1 text-secondary"></i>
<h6 class="mt-3">Operaci&oacute;n</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="reportes/vista.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-card-checklist fs-1 text-info"></i>
<h6 class="mt-3">Reportes</h6>
</div>
</a>
</div>
<?php endif; ?>

</div>

<!-- ===== GR�FICO ===== -->

<?php if($rol_usuario == '1'): ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('produccionChart'), {
type: 'bar',
data: {
labels: <?= json_encode($labels) ?>,
datasets: [{
label: 'Produccion',
data: <?= json_encode($valores) ?>,
backgroundColor: '#633123'
}]
}
});
</script>
<?php endif; ?>

<style>
.hover-scale:hover {
transform: scale(1.05);
transition: 0.3s;
}
</style>

<?php include 'includes/footer.php'; ?>
<?php
header('Content-Type: text/html; charset=utf8mb4');
include 'includes/conexion.php';
include 'includes/auth.php';
include 'includes/header.php';

$rol_usuario = $_SESSION['rol'] ?? '1';
echo $rol_usuario;
var_dump($rol_usuario);
print_r($rol_usuario);
// ===== ESTADÍSTICAS =====

/*$stock_bajo = $conn->query("
SELECT COUNT(*) as total 
FROM  
WHERE stock_actual <= 5
")->fetch_assoc()['total']; */

$produccion_hoy = $conn->query("
SELECT COUNT(id_operacion) AS total
FROM operacion
WHERE MONTH(fecha_creacion) = MONTH(CURDATE())
AND YEAR(fecha_creacion) = YEAR(CURDATE());
")->fetch_assoc()['total'] ?? 0;

/*$ventas_hoy = $conn->query("
SELECT SUM(ingreso_total_usd) as total 
FROM ventas 
WHERE DATE(fecha)=CURDATE()
")->fetch_assoc()['total'] ?? 0; 

$utilidad_hoy = $ventas_hoy; */

/*$notas_pendientes = $conn->query("
SELECT COUNT(*) as total 
FROM notas_venta 
WHERE estado='pendiente'
")->fetch_assoc()['total']; */
?>

<!-- ===== TARJETAS SUPERIORES ===== -->

<!-- <div class="row g-4 mb-4 text-center">

<div class="col-6 col-md-3">
<div class="card shadow rounded-4 p-3 bg-danger text-white">
<i class="bi bi-exclamation-triangle fs-2"></i>
<h6 class="mt-2">Stock Bajo</h6>
<h4><?= $stock_bajo ?></h4>
</div>
</div>

<div class="col-6 col-md-3">
<a href="notas_venta/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-3 bg-info text-white">
<i class="bi bi-journal-check fs-2"></i>
<h6 class="mt-2">Notas Pendientes</h6>
<h4><?= $notas_pendientes ?></h4>
</div>
</a>
</div>

</div>
-->
<!-- ===== MENÚ PRINCIPAL ===== -->

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
<a href="notas_venta/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-journal-check fs-1 text-info"></i>
<h6 class="mt-3">Notas</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="reportes/index.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-bar-chart fs-1 text-info"></i>
<h6 class="mt-3">Reportes</h6>
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

</div>

<!-- ===== GRÁFICO ===== -->

<?php if($rol_usuario == '1'): ?>
<div class="card shadow rounded-4 mt-5">
<div class="card-body">
<h5>Producci&oacute;n ultimos 7 d&iacute;as</h5>
<canvas id="produccionChart"></canvas>
</div>
</div>

<?php
$data = $conn->query("
SELECT DATE(fecha) as dia, SUM(cantidad_producida) as total
FROM produccion
GROUP BY DATE(fecha)
ORDER BY fecha DESC LIMIT 7
");

$labels = [];
$valores = [];

while($d = $data->fetch_assoc()){
$labels[] = $d['dia'];
$valores[] = $d['total'];
}
?> 

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
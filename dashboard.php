<?php
header('Content-Type: text/html; charset=utf8mb4');
include 'includes/conexion.php';
include 'includes/auth.php';
include 'includes/header.php';

$rol_usuario = $_SESSION['rol'] ?? '1';

// --- LÓGICA DE STOCK BAJO ---
$productos_bajos = [];
if ($rol_usuario == '1') {
    // Buscamos productos con cantidad menor a 6
    $res_stock = $conn->query("SELECT nombre, cantidad FROM productos WHERE cantidad < 6");
    while ($row_s = $res_stock->fetch_assoc()) {
        $productos_bajos[] = $row_s;
    }
}
?>

<h5 class="mb-3 fw-bold">Panel de Control</h5>

<div class="row g-4">

<?php if (!empty($productos_bajos)): ?>
    <div class="alert alert-danger shadow-sm rounded-4 mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
            <div>
                <strong>¡Atención! Stock Crítico:</strong> Hay productos con menos de 6 unidades.
                <ul class="mb-0 mt-2">
                    <?php foreach ($productos_bajos as $p): ?>
                        <li>
                            <strong><?= htmlspecialchars($p['nombre']); ?></strong>: 
                            <span class="badge bg-danger"><?= $p['cantidad']; ?> unidades</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <hr>
        <a href="productos/listar.php" class="alert-link small">Ir a inventario para reponer →</a>
    </div>
<?php endif; ?>

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

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="estadisticas/vista.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-bar-chart fs-1 text-danger"></i>
<h6 class="mt-3">Estad&iacute;sticas</h6>
</div>
</a>
</div>
<?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
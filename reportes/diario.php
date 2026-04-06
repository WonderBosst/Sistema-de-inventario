<?php
include '../includes/conexion.php';
include '../includes/header.php';
include '../includes/auth.php';
requireRole(['admin']);

$where = "DATE(fecha) = CURDATE()";

function obtenerDatos($conn, $where){
    $ventas = $conn->query("SELECT SUM(ingreso_total_usd) as total FROM ventas WHERE $where")->fetch_assoc()['total'] ?? 0;
    $produccion = $conn->query("SELECT SUM(costo_total_usd) as total FROM produccion WHERE $where AND activo=1")->fetch_assoc()['total'] ?? 0;
    return [
        'ventas'=>$ventas,
        'produccion'=>$produccion,
        'utilidad'=>$ventas-$produccion
    ];
}

$data = obtenerDatos($conn,$where);
?>

<h3>Reporte Diario</h3>

<div class="row g-4 mt-3">

<div class="col-md-4">
<div class="card shadow p-4 text-center bg-success text-white">
<h5>Ventas</h5>
<h3>$<?= number_format($data['ventas'],2) ?></h3>
</div>
</div>

<div class="col-md-4">
<div class="card shadow p-4 text-center bg-danger text-white">
<h5>Costo Produccion</h5>
<h3>$<?= number_format($data['produccion'],2) ?></h3>
</div>
</div>

<div class="col-md-4">
<div class="card shadow p-4 text-center bg-primary text-white">
<h5>Utilidad</h5>
<h3>$<?= number_format($data['utilidad'],2) ?></h3>
</div>
</div>

</div>

<?php include '../includes/footer.php'; ?>
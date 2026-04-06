<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['admin']);
include 'funciones_reportes.php';

$desde = $_GET['desde'] ?? '';
$hasta = $_GET['hasta'] ?? '';

if(!$desde || !$hasta){
    header("Location: index.php");
    exit;
}

$where = "DATE(fecha) BETWEEN '$desde' AND '$hasta'";
$data = obtenerDatosReporte($conn,$where);
?>

<h3>🔎 Reporte Personalizado</h3>
<p>Desde: <strong><?= $desde ?></strong> | Hasta: <strong><?= $hasta ?></strong></p>

<?php include 'plantilla_reporte.php'; ?>

<?php include '../includes/footer.php'; ?>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['admin']);
include 'funciones_reportes.php';

$where = "YEAR(fecha)=YEAR(CURDATE()) AND MONTH(fecha)=MONTH(CURDATE())";
$data = obtenerDatosReporte($conn,$where);
?>

<h3>🗓 Reporte Mensual</h3>

<?php include 'plantilla_reporte.php'; ?>

<?php include '../includes/footer.php'; ?>
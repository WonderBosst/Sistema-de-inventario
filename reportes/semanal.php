<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['admin']);
include 'funciones_reportes.php';

$where = "YEARWEEK(fecha,1) = YEARWEEK(CURDATE(),1)";
$data = obtenerDatosReporte($conn,$where);
?>

<h3>📆 Reporte Semanal</h3>

<?php include 'plantilla_reporte.php'; ?>

<?php include '../includes/footer.php'; ?>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';

requireRole(['admin','ventas']);

$id = intval($_GET['id']);
$estado = $_GET['estado'];

$stmt = $conn->prepare("UPDATE notas_venta SET estado=? WHERE id=?");
$stmt->bind_param("si",$estado,$id);
$stmt->execute();

header("Location: listar.php");
exit;
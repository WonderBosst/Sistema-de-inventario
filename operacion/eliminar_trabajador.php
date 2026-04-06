<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['1']);
$id = intval($_GET['id']);
$id_grupo_trabajadores = $conn->real_escape_string($_GET['grupo']);

$stmt = $conn->prepare("
    DELETE FROM grupo_trabajadores 
    WHERE id_trabajador = ? 
    AND id_grupo_trabajadores = ?
");

$stmt->bind_param("is", $id, $id_grupo_trabajadores);

if(!$stmt->execute()){
    die("Error en la consulta: " . $stmt->error);
}
?>
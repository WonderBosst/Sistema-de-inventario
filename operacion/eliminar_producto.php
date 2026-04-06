<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['1']);
$id = intval($_GET['id']);
$id_grupo_trabajadores = $conn->real_escape_string($_GET['grupo']);
$id_operacion = intval($_GET['operacion']);

$stmt = $conn->prepare("
    DELETE FROM grupo_productos 
    WHERE id_producto = ? 
    AND id_grupo_productos = ?
");

$stmt->bind_param("is", $id, $id_grupo_trabajadores);

if(!$stmt->execute()){
    die("Error en la consulta: " . $stmt->error);
}
    header("Location: editar.php?id=".$id_operacion."&id_grupo_trabajadores=".$id_grupo_trabajadores);
    exit;
?>
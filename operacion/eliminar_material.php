<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['1']);
$id = intval($_GET['id']);
$id_grupo_materiales = $conn->real_escape_string($_GET['grupo']);
$id_operacion = intval($_GET['operacion']);

$stmt = $conn->prepare("
    DELETE FROM grupo_materiales
    WHERE id_material = ? 
    AND id_grupo_materiales = ?
");

$stmt->bind_param("is", $id, $id_grupo_materiales);

if(!$stmt->execute()){
    die("Error en la consulta: " . $stmt->error);
}
    header("Location: editar.php?id=".$id_operacion."&id_grupo_materiales=".$id_grupo_materiales);
    exit;
?>
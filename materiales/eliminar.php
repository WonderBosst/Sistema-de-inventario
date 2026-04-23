<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['1']);

$id = intval($_GET['id']);

$result = $conn->query("UPDATE material SET estatus = false WHERE id_material =$id");

if(!$result){
    die("Error en la consulta: " . $conn->error);
}
    header("Location: listar.php");
    exit;
?>
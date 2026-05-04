<?php
include '../includes/conexion.php';
include '../includes/auth.php';

$id = $_GET['id'];
$razon = isset($_GET['razon']) ? $_GET['razon'] : 'Sin motivo especificado';

$stmt = $conn->prepare("UPDATE material SET estatus = false, razon = ? WHERE id_material = ?");
$stmt->bind_param("si", $razon, $id);

if($stmt->execute()){
    header("Location: listar.php?exito=Material eliminado correctamente");
}
?>
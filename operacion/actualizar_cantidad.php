<?php
include '../includes/conexion.php';
include '../includes/auth.php';

requireRole(['1']);

if(isset($_POST['id']) && isset($_POST['accion']) && isset($_POST['grupo'])) {

$id = intval($_POST['id']);
$accion = $_POST['accion'];
$id_grupo_productos = trim($_POST['grupo']);

$result = $conn->query("SELECT cantidad FROM productos WHERE id_producto = $id");
$row = $result->fetch_assoc();
$stock_actual = floatval($row['cantidad']);

if($accion == "sumar"){

    if($stock_actual <= 0){
        echo "ERROR: No hay suficiente stock";
        exit;
    }
    $conn->query("UPDATE grupo_productos SET cantidad = cantidad + 1 WHERE id_producto = $id AND id_grupo_productos = '$id_grupo_productos'");
}

if($accion == "restar"){

    $result = $conn->query("SELECT cantidad FROM grupo_productos WHERE id_producto = $id AND id_grupo_productos = '$id_grupo_productos'");
    $row = $result->fetch_assoc();
    $cantidad_actual_grupo = floatval($row['cantidad']);

    if($cantidad_actual_grupo <= 0){
        echo "ERROR: No se puede reducir más, cantidad mínima 0";
        exit;
    }

    $conn->query("UPDATE grupo_productos SET cantidad = cantidad - 1 WHERE id_producto = $id AND id_grupo_productos = '$id_grupo_productos'");
}

$result = $conn->query("SELECT cantidad FROM productos WHERE id_producto = $id");
$row = $result->fetch_assoc();

echo $row['cantidad'];
}
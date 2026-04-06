<?php
include '../includes/conexion.php';
include '../includes/auth.php';

requireRole(['1']); // Verifica rol

if(isset($_POST['id']) && isset($_POST['accion'])) {

    $id = intval($_POST['id']);
    $accion = $_POST['accion'];

    if($accion == "sumar"){
        $conn->query("UPDATE productos SET cantidad = cantidad + 1 WHERE id_producto = $id");
    }

    if($accion == "restar"){
        $conn->query("UPDATE productos SET cantidad = cantidad - 1 WHERE id_producto = $id AND cantidad > 0");
    }

    $result = $conn->query("SELECT cantidad FROM productos WHERE id_producto = $id");
    $row = $result->fetch_assoc();

    echo $row['cantidad'];
}
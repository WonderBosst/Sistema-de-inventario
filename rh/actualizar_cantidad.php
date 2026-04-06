<?php
include '../includes/conexion.php';
include '../includes/auth.php';

requireRole(['1']); // Verifica rol

if(isset($_POST['id']) && isset($_POST['accion'])) {

    $id = intval($_POST['id']);
    $accion = $_POST['accion'];

    if($accion == "sumar"){
        $conn->query("UPDATE material SET cantidad = cantidad + 1 WHERE id_material = $id");
    }

    if($accion == "restar"){
        $conn->query("UPDATE material SET cantidad = cantidad - 1 WHERE id_material = $id AND cantidad > 0");
    }

    // Obtener cantidad actualizada
    $result = $conn->query("SELECT cantidad FROM material WHERE id_material = $id");
    $row = $result->fetch_assoc();

    // Devuelve solo la nueva cantidad
    echo $row['cantidad'];
}
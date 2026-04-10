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
    $stock_general = floatval($row['cantidad']);

    if($accion == "sumar"){
        if($stock_general <= 0){
            echo "ERROR: No hay suficiente stock en inventario";
            exit;
        }
        $conn->query("UPDATE grupo_productos SET cantidad = cantidad + 1 WHERE id_producto = $id AND id_grupo_productos = '$id_grupo_productos'");
    }

    if($accion == "restar"){
        $result_grupo = $conn->query("SELECT cantidad FROM grupo_productos WHERE id_producto = $id AND id_grupo_productos = '$id_grupo_productos'");
        $row_grupo = $result_grupo->fetch_assoc();
        $cantidad_actual_grupo = floatval($row_grupo['cantidad']);

        if($cantidad_actual_grupo <= 0){
            echo "ERROR: La cantidad ya es 0";
            exit;
        }

        $conn->query("UPDATE grupo_productos SET cantidad = cantidad - 1 WHERE id_producto = $id AND id_grupo_productos = '$id_grupo_productos'");
    }

    $result_final = $conn->query("SELECT cantidad FROM grupo_productos WHERE id_producto = $id AND id_grupo_productos = '$id_grupo_productos'");
    $row_final = $result_final->fetch_assoc();

    echo $row_final['cantidad'];
}
<?php
include "../includes/conexion.php";
include "../includes/auth.php";

requireRole(['admin','ventas']);

$id = $_GET['id'];

$venta = $conn->query("SELECT * FROM ventas WHERE id=$id")->fetch_assoc();

if(!$venta){
    header("Location: listar.php");
    exit;
}

// Devolver stock
$conn->query("
UPDATE productos 
SET stock_actual = stock_actual + {$venta['cantidad']} 
WHERE id={$venta['producto_id']}
");

// Eliminar venta
$conn->query("DELETE FROM ventas WHERE id=$id");

header("Location: listar.php?exito=Venta eliminada correctamente");
exit;
?>
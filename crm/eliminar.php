<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['1']);

include 'funciones.php';

$id = intval($_GET['id']);

$prod = $conn->query("SELECT * FROM produccion WHERE id=$id AND activo=1")
              ->fetch_assoc();

if(!$prod){
    header("Location: listar.php");
    exit;
}

$conn->begin_transaction();

try{

    revertirProduccion($conn,$prod['producto_id'],$prod['cantidad_producida']);

    $conn->query("UPDATE produccion SET activo=0 WHERE id=$id");

    $conn->commit();

    header("Location: listar.php?exito=Producción eliminada");
    exit;

}catch(Exception $e){
    $conn->rollback();
    header("Location: listar.php?error=Error al eliminar");
    exit;
}
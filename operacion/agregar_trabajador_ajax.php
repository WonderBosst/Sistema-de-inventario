<?php
include '../includes/conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

    $id_grupo_trabajadores = trim($_POST['id_grupo_trabajadores']);
    $id_trabajador = intval($_POST['id_trabajador']);

    $stmt = $conn->prepare("
        INSERT INTO grupo_trabajadores (id_grupo_trabajadores, id_trabajador)
        VALUES (?,?)
    ");

    $stmt->bind_param("si", $id_grupo_trabajadores, $id_trabajador);

    if($stmt->execute()){
        echo "ok";
    } else {
        echo "error";
    }
}
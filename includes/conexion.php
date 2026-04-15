<?php
$host = "localhost";
$user = "root";
$pass = "hallo123456789";
$db   = "friendly_cleaner";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die("Error de conexión");
}

// CODIFICACIÓN UTF-8 CORRECTA
$conn->set_charset("utf8mb4");
mysqli_set_charset($conn, "utf8mb4");

// Headers para navegador
header('Content-Type: text/html; charset=utf8mb4');
?>
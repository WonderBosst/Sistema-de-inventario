<?php
if(session_status() === PHP_SESSION_NONE) session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

function requireRole($roles){

    $userRole = strtolower(trim($_SESSION['rol']));

    $roles = array_map(function($r){
        return strtolower(trim($r));
    }, (array)$roles);

    if(!in_array($userRole, $roles)){
        header("Location: /dashboard.php");
        exit();
    }
}
?>
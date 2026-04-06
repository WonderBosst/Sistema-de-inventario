<?php
header('Content-Type: text/html; charset=utf8mb4');
if (!isset($pageTitle)) $pageTitle = "EcoFriendlySolutions";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="/assets/css/estilos.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-dark" style="background-color: #268db5;">
  <div class="container-fluid">
    <div class="d-flex align-items-center">
      <i class="bi bi-boxes me-2" style="font-size: 1.8rem; color: white;"></i>
      <span class="navbar-brand mb-0 h1"><?= htmlspecialchars($pageTitle) ?></span>
    </div>
    <div class="d-flex gap-2">
      <a href="/ecofriendlysolutions/dashboard.php" class="btn btn-light btn-sm" title="Volver al dashboard">
        <i class="bi bi-house-fill"></i> Inicio
      </a>
      <a href="/ecofriendlysolutions/logout.php" class="btn btn-light btn-sm" onclick="return confirm('¿Deseas cerrar sesi&oacute;n?')" title="Cerrar sesión">
        <i class="bi bi-box-arrow-right"></i> Salir
      </a>
    </div>
  </div>
</nav>
<div class="container py-3 flex-grow-1">
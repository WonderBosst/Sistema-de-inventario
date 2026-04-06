<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EcoFriendlySolutions</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark" style="background:#633123;">
  <div class="container-fluid">
    <span class="navbar-brand fw-bold">Sistema EcoFriendlySolutions</span>
    <a href="logout.php" class="btn btn-light btn-sm">Salir</a>
  </div>
</nav>

<div class="container py-4">
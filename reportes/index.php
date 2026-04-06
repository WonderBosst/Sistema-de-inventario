<?php
include '../includes/header.php';
include '../includes/auth.php';
requireRole(['admin']);
?>

<h3 class="mb-4">Reportes</h3>

<div class="row g-4">

<div class="col-md-3">
<a href="diario.php" class="text-decoration-none">
<div class="card shadow p-4 text-center">
<h5>Diario</h5>
</div>
</a>
</div>

<div class="col-md-3">
<a href="semanal.php" class="text-decoration-none">
<div class="card shadow p-4 text-center">
<h5>Semanal</h5>
</div>
</a>
</div>

<div class="col-md-3">
<a href="mensual.php" class="text-decoration-none">
<div class="card shadow p-4 text-center">
<h5>Mensual</h5>
</div>
</a>
</div>

<div class="col-md-3">
<a href="anual.php" class="text-decoration-none">
<div class="card shadow p-4 text-center">
<h5>Anual</h5>
</div>
</a>
</div>

</div>

<hr class="my-5">

<h5>Reporte Personalizado</h5>

<form action="personalizado.php" method="GET" class="row g-3">

<div class="col-md-4">
<label>Desde</label>
<input type="date" name="desde" class="form-control" required>
</div>

<div class="col-md-4">
<label>Hasta</label>
<input type="date" name="hasta" class="form-control" required>
</div>

<div class="col-md-4 d-flex align-items-end">
<button class="btn btn-primary w-100">Generar</button>
</div>

</form>

<?php include '../includes/footer.php'; ?>
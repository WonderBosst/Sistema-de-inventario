<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);


?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-card-checklist"></i> Reportes</h3>
    <a href="crear.php" class="btn btn-success">➕ Imprimir</a>
</div>


<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">


</div>
</div>

<?php include '../includes/footer.php'; ?>
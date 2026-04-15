<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

?>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">

<div class="col-md-3">
<label class="form-label">Seleccione el mes que quiera consultar los trabajos realizados
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top"
     title="Seleccione el mes que quiere consultar">
  </i>
</label>
<select name="mes" class="form-select" required>
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>

</div>
</div>

<script>
function verPDF(trabajo, operacion, cliente) {
    let url = `generar_pdf.php?trabajo=${encodeURIComponent(trabajo)}&operacion=${encodeURIComponent(operacion)}&cliente=${encodeURIComponent(cliente)}`;
    
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById("visorPDF").src = data;
        })
        .catch(err => console.error("Error al cargar PDF:", err));
}
</script>

<?php include '../includes/footer.php'; ?>
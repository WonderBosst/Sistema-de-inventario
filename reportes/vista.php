<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

$result = $conn->query("
SELECT O.id_operacion, O.trabajo_realizado, O.estatus, C.nombre, C.id_cliente, C.direccion, O.fecha_creacion, O.fecha_finalizacion, O.id_grupo_trabajadores FROM operacion AS O INNER JOIN crm AS C ON C.id_cliente = O.id_cliente
");

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-card-checklist fs-1 text-info"></i> Reportes</h3>
</div>

<nav class="navbar bg-body-tertiary mb-3 rounded-4 shadow-sm">
  <div class="container-fluid">
    <div class="col-12 col-md-6"> <form class="d-flex" role="search" onsubmit="return false;">
            <input class="form-control me-2" type="search" id="inputBusqueda" placeholder="Buscar operación...">
        </form>
    </div>
  </div>
</nav>

<div style="max-height: 300px; overflow-y: auto;">
<table class="table table-hover align-middle small" id="tablaop">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Trabajo realizado</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Cliente</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Direcci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Estatus</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha inicio</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha finalizaci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Accciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['trabajo_realizado']); ?></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['direccion']); ?></td>

<td>
<?php if($row['estatus'] == 'Terminado'): ?>
<span class="badge bg-success">Terminado</span>
<?php elseif($row['estatus'] == 'En proceso'): ?>
<span class="badge bg-info">En proceso</span>
<?php else: ?>
<span class="badge bg-danger">Cancelado</span>
<?php endif; ?>
</td>

<td><?= htmlspecialchars($row['fecha_creacion']); ?></td>

<td><?= htmlspecialchars($row['fecha_finalizacion']); ?></td>

<td>
<button onclick="verPDF(
  '<?= $row['trabajo_realizado'] ?>',
  '<?= $row['id_operacion'] ?>',
  '<?= $row['id_cliente'] ?>',
)">
Ver informaci&oacute;n
</button>
</td>

</tr>
<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>
</div>

<iframe id="visorPDF" width="100%" height="700px" style="border:1px solid #ccc;"></iframe>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputBusqueda = document.getElementById("inputBusqueda");
    const filas = document.querySelectorAll("#tablaop tbody tr");

    inputBusqueda.addEventListener("keyup", function() {
        const valor = inputBusqueda.value.toLowerCase().trim();

        filas.forEach(fila => {
            const textoFila = fila.textContent.toLowerCase();
            
            if (textoFila.indexOf(valor) > -1) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });
});

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
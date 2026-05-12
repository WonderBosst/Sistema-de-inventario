<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

$result = $conn->query("
SELECT * FROM notas WHERE estatus = true
");

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-journal-text"></i> Notas</h3>
    <a href="crear.php" class="btn btn-success">➕ Nueva nota</a>
</div>

<nav class="navbar bg-body-tertiary mb-3 rounded-4 shadow-sm">
  <div class="container-fluid">
    <div class="col-12 col-md-6"> <form class="d-flex" role="search" onsubmit="return false;">
            <input class="form-control me-2" type="search" id="inputBusqueda" placeholder="Buscar personal...">
        </form>
    </div>
  </div>
</nav>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">
    
<table class="table table-hover align-middle small" id="tablaNotas">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">T&iacute;tulo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Descripci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Acciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['titulo']); ?></td>

<td><?= htmlspecialchars($row['escrito']); ?></td>

<td class="text-center">
<div class="d-flex flex-row flex-sm-row justify-content-center gap-1">

<a href="editar.php?id=<?= $row['id_notas']; ?>" 
class="btn btn-sm btn-warning">
✏️ Editar
</a>
<a href="eliminar.php?id=<?= $row['id_notas'] ?>" 
class="btn btn-sm btn-danger"
onclick="return confirm('¿Eliminar nota?')">🗑️</a>
</td>

</div>
</td>

</tr>
<?php $contador++; ?>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const inputBusqueda = document.getElementById("inputBusqueda");
    const filas = document.querySelectorAll("#tablaNotas tbody tr");

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
</script>

<?php include '../includes/footer.php'; ?>
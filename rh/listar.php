<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

$result = $conn->query("
SELECT * FROM rh
");

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-people "></i> Recursos Humanos</h3>
    <a href="crear.php" class="btn btn-success">➕ Nuevo Trabajador</a>
</div>

<?php if(isset($_GET['exito'])): ?>
<div class="alert alert-success">
    <?= htmlspecialchars($_GET['exito']); ?>
</div>
<?php endif; ?>

<nav class="navbar bg-body-tertiary mb-3 rounded-4 shadow-sm">
  <div class="container-fluid">
    <div class="col-12 col-md-6"> <form class="d-flex" role="search" onsubmit="return false;">
            <input class="form-control me-2" type="search" id="inputBusqueda" placeholder="Buscar personal...">
        </form>
    </div>
  </div>
</nav>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 700px; overflow-y: auto;">

<table class="table table-hover align-middle small" id="tablarh">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Nombre</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Apellidos</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Edad</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Dirección</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Entre Calles</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Correo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">N&uacute;mero tel&eacute;fonico</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Activo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha de creaci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Acciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result->fetch_assoc()): ?>

<tr><td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['apellidos']); ?></td>

<td><?= ($row['edad']); ?></td>

<td><?= htmlspecialchars($row['direccion']); ?></td>

<td><?= htmlspecialchars($row['entre_calles']); ?></td>

<td><?= htmlspecialchars($row['correo']); ?></td>

<td><?= ($row['numero_telefonico']); ?></td>

<td>
<?php if($row['activo'] == 1): ?>
<span class="badge bg-success">Activo</span>
<?php else: ?>
<span class="badge bg-danger">Dado de baja</span>
<?php endif; ?>
</td>

<td><?= htmlspecialchars($row['fecha_creacion']); ?></td>

<td class="text-center">
<div class="d-flex flex-row flex-sm-row justify-content-center gap-1">

<a href="editar.php?id=<?= $row['id_trabajador']; ?>" 
class="btn btn-sm btn-warning">
✏️ Editar
</a>

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
    const filas = document.querySelectorAll("#tablarh tbody tr");

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

function actualizarCantidad(id, accion){
    fetch("actualizar_cantidad.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + id + "&accion=" + accion
    })
    .then(response => response.text())
    .then(cantidad => {
        document.getElementById("cantidad-" + id).innerText = cantidad;
    })
    .catch(error => console.error('Error:', error));
}
</script>

<?php include '../includes/footer.php'; ?>
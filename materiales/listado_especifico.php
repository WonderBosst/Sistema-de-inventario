<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);


requireRole(['1']);

$nombre = trim($_GET['nombre']);

$result = $conn->query("
SELECT M.id_material, M.codigo, M.nombre, M.marca, M.fecha_creacion FROM material AS M WHERE M.estatus = true AND M.nombre = '$nombre';
");

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">
        <i class="bi bi-backpack2"></i> Materiales
    </h3>
    <a href="listar.php" class="btn btn-secondary">⬅ Volver</a>
</div>

<?php if(isset($_GET['exito'])): ?>
<div class="alert alert-success">
    <?= htmlspecialchars($_GET['exito']); ?>
</div>
<?php endif; ?>

<nav class="navbar bg-body-tertiary mb-3 rounded-4 shadow-sm">
  <div class="container-fluid">
    <div class="col-12 col-md-6"> <form class="d-flex" role="search" onsubmit="return false;">
        <input class="form-control" type="search" id="inputBusqueda" placeholder="Buscar materiales...">
      </form>
    </div>
  </div>
</nav>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">
    
<table class="table table-hover align-middle small" id="tablaMateriales">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Codigo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Nombre</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Marca</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Fecha creaci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;" class="text-center" >Acciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><strong><?= $contador; ?></strong></td>


<td><?= htmlspecialchars($row['codigo']); ?></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><?= htmlspecialchars($row['marca']); ?></td>

<td><?= htmlspecialchars($row['fecha_creacion']); ?></td>

<td class="text-center">
        <div class="d-flex flex-row flex-sm-row justify-content-center gap-1">
            <a href="generar_pdf_qr.php?codigo=<?= urlencode($row['codigo']); ?>&nombre=<?= urlencode($row['nombre']); ?>&marca=<?= urlencode($row['marca']); ?>" 
               target="_blank" 
               class="btn btn-sm btn-info text-white" 
               title="Generar PDF con QR">
                🖨️ Descargar QR
            </a>

            <a href="editar.php?id=<?= $row['id_material']; ?>&nombre=<?= $row['nombre']; ?>" 
               class="btn btn-sm btn-warning">
                ✏️ Editar
            </a>

            <a href="#" 
               class="btn btn-sm btn-danger"
               onclick="let motivo = prompt('¿Por qué desea eliminar este material?'); 
                        if(motivo) { window.location.href = 'procesar_eliminar.php?id=<?= $row['id_material'] ?>&razon=' + encodeURIComponent(motivo); } 
                        return false;">
                🗑️
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
    const buscador = document.getElementById("inputBusqueda");
    const filas = document.querySelectorAll("#tablaMateriales tbody tr");

    buscador.addEventListener("keyup", function() {
        const termino = buscador.value.toLowerCase().trim();

        filas.forEach(fila => {
            const texto = fila.textContent.toLowerCase();
            fila.style.display = texto.includes(termino) ? "" : "none";
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
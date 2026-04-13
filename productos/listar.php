<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

/*
Consultamos productos en existencia
*/
requireRole(['1']);

if(isset($_GET['id']) && isset($_GET['accion'])){

    $id = intval($_GET['id']);
    $accion = $_GET['accion'];

    if($accion == "sumar"){
        $conn->query("UPDATE productos SET cantidad = cantidad + 1 WHERE id_producto = $id");
    }

    if($accion == "restar"){
        $conn->query("UPDATE productos SET cantidad = cantidad - 1 WHERE id_producto = $id AND cantidad > 0");
    }

    header("Location: listar.php?exito=Cantidad actualizada");
    exit;
}

$result = $conn->query("
SELECT * FROM productos
");

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>📦 Productos</h3>
    <a href="crear.php" class="btn btn-success">➕ Nuevo Producto</a>
</div>

<?php if(isset($_GET['exito'])): ?>
<div class="alert alert-success">
    <?= htmlspecialchars($_GET['exito']); ?>
</div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body table-responsive" style="max-height: 600px; overflow-y: auto;">

<table class="table table-hover align-middle small">
<thead class="table-light">
<tr>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">#</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Aplicaci&oacute;n</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Cantidad</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Reserva</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Medida</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Conservado en:</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Tipo</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Marca</th>
<th style="position: sticky; top: 0; z-index: 2; background-color: #f8f9fa;">Acciones</th>
</tr>
</thead>
<tbody>
<?php $contador = 1; ?>
<?php while($row = $result->fetch_assoc()): ?>

<td><strong><?= $contador; ?></strong></td>

<td><?= htmlspecialchars($row['nombre']); ?></td>

<td><span id="cantidad-<?= $row['id_producto']; ?>">
    <?= $row['cantidad']; ?>
</span></td>

<td><?= htmlspecialchars($row['reserva']); ?></td>

<td><?= htmlspecialchars($row['medida']); ?></td>

<td><?= htmlspecialchars($row['conservado']); ?></td>

<td><?= htmlspecialchars($row['tipo']); ?></td>

<td><?= htmlspecialchars($row['marca']); ?></td>

<td class="text-center">
<div class="d-flex flex-column flex-sm-row justify-content-center gap-1">

<button class="btn btn-success btn-sm"
        onclick="actualizarCantidad(<?= $row['id_producto']; ?>,'sumar')">
    <i class="bi bi-plus-lg"></i>
</button>

<button class="btn btn-danger btn-sm"
        onclick="actualizarCantidad(<?= $row['id_producto']; ?>,'restar')">
    <i class="bi bi-dash-lg"></i>
</button>

<a href="editar.php?id=<?= $row['id_producto']; ?>" 
class="btn btn-warning btn-sm">
✏️
</a>

<a href="eliminar.php?id=<?= $row['id_producto'] ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar producto?')">🗑️</a>

<button class="btn btn-info d-inline-flex align-items-center">
  <i class="bi bi-info-circle me-2"></i> Informaci&oacute;n
</button>

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
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
<tr class="<?= $claseAlerta ?>">
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

<td>
      <span id="cantidad-<?= $row['id_producto']; ?>" 
            class="<?= ($row['cantidad'] < 6) ? 'text-danger fw-bold' : '' ?>">
         <?= $row['cantidad']; ?>
         <?php if($row['cantidad'] < 6) echo '<i class="bi bi-exclamation-triangle-fill text-danger"></i>'; ?>
      </span>
   </td>

<td><?= htmlspecialchars($row['reserva']); ?></td>

<td><?= htmlspecialchars($row['medida']); ?></td>

<td><?= htmlspecialchars($row['conservado']); ?></td>

<td><?= htmlspecialchars($row['tipo']); ?></td>

<td><?= htmlspecialchars($row['marca']); ?></td>

<td class="text-center">
<div class="d-flex flex-row flex-sm-row justify-content-center gap-1">

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

<button class="btn btn-info btn-sm btn-info-producto" 
        data-cantidad="<?= $row['cantidad']; ?>"
        data-conservado="<?= htmlspecialchars($row['conservado']); ?>"
        data-nombre="<?= htmlspecialchars($row['nombre']); ?>"
        data-reserva="<?= htmlspecialchars($row['reserva']); ?>"
        data-medida="<?= htmlspecialchars($row['medida']); ?>"
        data-tipo="<?= htmlspecialchars($row['tipo']); ?>"
        data-marca="<?= htmlspecialchars($row['marca']); ?>">
    <i class="bi bi-info-circle"></i> Informaci&oacute;n
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

<?php include '../includes/footer.php'; ?>

<script>
function actualizarCantidad(id, accion) {
    $.ajax({
        url: "actualizar_cantidad.php",
        method: "POST",
        data: { id: id, accion: accion },
        success: function(nuevaCantidad) {
            // 1. Convertimos a número para comparar
            const cant = parseInt(nuevaCantidad);
            const $span = $("#cantidad-" + id);
            const $fila = $span.closest('tr');

            // 2. Actualizamos el texto
            $span.text(nuevaCantidad);

            // 3. Lógica de alertas visuales
            if (cant < 6) {
                // Si es bajo, pintamos la fila de rojo y añadimos alerta
                $fila.addClass('table-danger');
                $span.addClass('text-danger fw-bold');
                if (!$span.find('.bi-exclamation-triangle').length) {
                    $span.append(' <i class="bi bi-exclamation-triangle-fill text-danger"></i>');
                }
            } else {
                // Si el stock es suficiente, limpiamos las alertas
                $fila.removeClass('table-danger');
                $span.removeClass('text-danger fw-bold');
                $span.find('i').remove();
            }

            // 4. Actualizamos el atributo data para el botón de información
            $fila.find('.btn-info-producto').attr('data-cantidad', nuevaCantidad);
        },
        error: function() {
            alert("Error al actualizar la cantidad");
        }
    });
}
</script>
<?php
$pageTitle = "Ventas - Panel de Control";
include "../includes/header.php";
include "../includes/conexion.php";
include "../includes/auth.php";

requireRole(['admin','ventas']);

$query = "
SELECT v.*, p.nombre as producto_nombre
FROM ventas v
LEFT JOIN productos p ON v.producto_id = p.id
ORDER BY v.fecha DESC
";

$result = $conn->query($query);

if(!$result){
    echo "Error en la consulta: " . $conn->error;
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>💰 Ventas</h3>
    <a href="agregar.php" class="btn btn-primary">➕ Nueva Venta</a>
</div>

<?php if(isset($_GET['exito'])): ?>
<div class="alert alert-success alert-dismissible fade show">
    ✅ <?php echo htmlspecialchars($_GET['exito']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card card-custom">
    <div class="card-body">

        <?php if($result->num_rows > 0): ?>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1; while($row=$result->fetch_assoc()): ?>
                    <tr>
                        <td><strong><?php echo $i++; ?></strong></td>
                        <td><?php echo htmlspecialchars($row['producto_nombre']); ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td>$<?php echo number_format($row['precio_unitario_usd'],2); ?></td>
                        <td>
                            <span class="badge bg-success">
                                $<?php echo number_format($row['ingreso_total_usd'],2); ?>
                            </span>
                        </td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">✏️</a>
                            <a href="eliminar.php?id=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Eliminar venta?')">🗑️</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php else: ?>
            <div class="alert alert-warning text-center">
                📭 No hay ventas registradas.
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
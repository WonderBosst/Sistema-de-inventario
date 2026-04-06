<?php
$pageTitle = "Agregar Venta";
include "../includes/header.php";
include "../includes/conexion.php";
include "../includes/auth.php";

requireRole(['admin','ventas']);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    $producto = $conn->query("SELECT * FROM productos WHERE id=$producto_id")->fetch_assoc();

    if(!$producto){
        header("Location: listar.php?error=Producto no válido");
        exit;
    }

    if($producto['stock_actual'] < $cantidad){
        header("Location: listar.php?error=Stock insuficiente");
        exit;
    }

    $precio = $producto['precio_venta_usd'];
    $total = $precio * $cantidad;

    // Descontar stock
    $conn->query("UPDATE productos 
                  SET stock_actual = stock_actual - $cantidad 
                  WHERE id=$producto_id");

    // Insertar venta
    $stmt = $conn->prepare("
        INSERT INTO ventas (producto_id,cantidad,precio_unitario_usd,ingreso_total_usd)
        VALUES (?,?,?,?)
    ");
    $stmt->bind_param("iidd",$producto_id,$cantidad,$precio,$total);
    $stmt->execute();

    header("Location: listar.php?exito=Venta registrada correctamente");
    exit;
}

$productos = $conn->query("SELECT * FROM productos WHERE stock_actual > 0");
?>

<div class="card card-custom">
    <div class="card-body">

        <h3 class="mb-4">➕ Nueva Venta</h3>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Producto</label>
                <select name="producto_id" class="form-select" required>
                    <?php while($p=$productos->fetch_assoc()): ?>
                        <option value="<?php echo $p['id']; ?>">
                            <?php echo $p['nombre']; ?> (Stock: <?php echo $p['stock_actual']; ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>

            <button class="btn btn-success">💾 Guardar Venta</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
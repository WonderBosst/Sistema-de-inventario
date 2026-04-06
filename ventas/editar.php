<?php
$pageTitle = "Editar Venta";
include "../includes/header.php";
include "../includes/conexion.php";
include "../includes/auth.php";

requireRole(['admin','ventas']);

$id = $_GET['id'] ?? 0;

$venta = $conn->query("
SELECT v.*, p.nombre 
FROM ventas v
LEFT JOIN productos p ON v.producto_id = p.id
WHERE v.id = $id
")->fetch_assoc();

if(!$venta){
    header("Location: listar.php?error=Venta no encontrada");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $producto_id = $_POST['producto_id'];
    $cantidad_nueva = $_POST['cantidad'];

    // 🔁 1️⃣ Devolver stock anterior
    $conn->query("
        UPDATE productos
        SET stock_actual = stock_actual + {$venta['cantidad']}
        WHERE id = {$venta['producto_id']}
    ");

    // 🔎 2️⃣ Obtener producto actualizado
    $producto = $conn->query("
        SELECT * FROM productos WHERE id=$producto_id
    ")->fetch_assoc();

    if(!$producto){
        header("Location: listar.php?error=Producto inválido");
        exit;
    }

    if($producto['stock_actual'] < $cantidad_nueva){
        header("Location: listar.php?error=Stock insuficiente");
        exit;
    }

    $precio = $producto['precio_venta_usd'];
    $total = $precio * $cantidad_nueva;

    // ➖ 3️⃣ Descontar nuevo stock
    $conn->query("
        UPDATE productos
        SET stock_actual = stock_actual - $cantidad_nueva
        WHERE id = $producto_id
    ");

    // 📝 4️⃣ Actualizar venta
    $stmt = $conn->prepare("
        UPDATE ventas
        SET producto_id=?, cantidad=?, precio_unitario_usd=?, ingreso_total_usd=?
        WHERE id=?
    ");
    $stmt->bind_param("iiddi",$producto_id,$cantidad_nueva,$precio,$total,$id);
    $stmt->execute();

    header("Location: listar.php?exito=Venta actualizada correctamente");
    exit;
}

$productos = $conn->query("SELECT * FROM productos");
?>

<div class="card card-custom">
    <div class="card-body">

        <h3 class="mb-4">✏️ Editar Venta</h3>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Producto</label>
                <select name="producto_id" class="form-select" required>
                    <?php while($p=$productos->fetch_assoc()): ?>
                        <option value="<?php echo $p['id']; ?>"
                            <?php if($p['id'] == $venta['producto_id']) echo "selected"; ?>>
                            <?php echo $p['nombre']; ?> (Stock: <?php echo $p['stock_actual']; ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" name="cantidad" 
                       value="<?php echo $venta['cantidad']; ?>" 
                       class="form-control" required>
            </div>

            <button class="btn btn-warning">💾 Actualizar Venta</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['admin']);
include 'funciones.php';
include '../includes/header.php';

$id = intval($_GET['id']);

$produccion = $conn->query("
SELECT * FROM produccion 
WHERE id=$id AND activo=1
")->fetch_assoc();

if(!$produccion){
    header("Location: listar.php?error=Producción no encontrada");
    exit;
}

if($_SERVER['REQUEST_METHOD']=='POST'){

    $nueva_cantidad = intval($_POST['cantidad']);

    if($nueva_cantidad <= 0){
        header("Location: editar.php?id=$id&error=Cantidad inválida");
        exit;
    }

    $conn->begin_transaction();

    try{

        // 1️⃣ Revertir producción anterior
        revertirProduccion(
            $conn,
            $produccion['producto_id'],
            $produccion['cantidad_producida']
        );

        // 2️⃣ Validar nuevo stock
        if(!validarStock(
            $conn,
            $produccion['producto_id'],
            $nueva_cantidad
        )){
            throw new Exception("Stock insuficiente");
        }

        // 3️⃣ Aplicar nueva producción
        $nuevo_costo = aplicarProduccion(
            $conn,
            $produccion['producto_id'],
            $nueva_cantidad
        );

        // 4️⃣ Actualizar registro
        $stmt = $conn->prepare("
        UPDATE produccion 
        SET cantidad_producida=?, costo_total_usd=? 
        WHERE id=?
        ");
        $stmt->bind_param(
            "idi",
            $nueva_cantidad,
            $nuevo_costo,
            $id
        );
        $stmt->execute();

        $conn->commit();

        header("Location: listar.php?exito=Producción actualizada");
        exit;

    }catch(Exception $e){

        $conn->rollback();

        header("Location: editar.php?id=$id&error=".$e->getMessage());
        exit;
    }
}
?>

<h3 class="mb-4">✏️ Editar Producción</h3>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error'] ?></div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST">

<div class="mb-3">
<label class="form-label fw-bold">Cantidad</label>
<input type="number" 
name="cantidad"
value="<?= $produccion['cantidad_producida'] ?>"
class="form-control"
required>
</div>

<button class="btn btn-warning">
💾 Actualizar
</button>

<a href="listar.php" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
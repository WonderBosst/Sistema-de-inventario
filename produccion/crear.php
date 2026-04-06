<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['admin','panadero']);

include 'funciones.php';
include '../includes/header.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

    $producto_id = intval($_POST['producto_id']);
    $cantidad = intval($_POST['cantidad']);

    if(!validarStock($conn,$producto_id,$cantidad)){
        header("Location: crear.php?error=No hay suficiente materia prima");
        exit;
    }

    $conn->begin_transaction();

    try{

        $costo_total = aplicarProduccion($conn,$producto_id,$cantidad);

        $stmt = $conn->prepare("INSERT INTO produccion 
            (producto_id,cantidad_producida,costo_total_usd,activo) 
            VALUES (?,?,?,1)");

        $stmt->bind_param("iid",$producto_id,$cantidad,$costo_total);
        $stmt->execute();

        $conn->commit();

        header("Location: listar.php?exito=Producción registrada");
        exit;

    }catch(Exception $e){
        $conn->rollback();
        header("Location: crear.php?error=Error al producir");
        exit;
    }
}

$productos = $conn->query("SELECT id,nombre FROM productos WHERE activo=1");
?>

<h3>Nueva Producción</h3>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error'] ?></div>
<?php endif; ?>

<form method="POST">
<select name="producto_id" class="form-select mb-3" required>
<option value="">Seleccionar producto</option>
<?php while($p=$productos->fetch_assoc()): ?>
<option value="<?= $p['id'] ?>"><?= $p['nombre'] ?></option>
<?php endwhile; ?>
</select>

<input type="number" name="cantidad" class="form-control mb-3" required>

<button class="btn btn-primary">Producir</button>
</form>

<?php include '../includes/footer.php'; ?>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['admin','ventas']);

if(!isset($_GET['id'])){
    header("Location: listar.php");
    exit;
}

$id = intval($_GET['id']);

$nota = $conn->query("
SELECT * FROM notas_venta WHERE id=$id
")->fetch_assoc();

if(!$nota){
    header("Location: listar.php?error=Nota no encontrada");
    exit;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $cliente = $_POST['cliente'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $total = floatval($_POST['total_usd'] ?? 0);
    $anticipo = floatval($_POST['anticipo_usd'] ?? 0);
    $saldo = $total - $anticipo;
    $fecha = $_POST['fecha_entrega'] ?? null;
    $estado = $_POST['estado'] ?? 'pendiente';

    $stmt = $conn->prepare("
    UPDATE notas_venta 
    SET cliente=?, telefono=?, descripcion=?, 
        total_usd=?, anticipo_usd=?, saldo_usd=?, 
        fecha_entrega=?, estado=?
    WHERE id=?
    ");

    $stmt->bind_param("sssdddssi",
        $cliente,
        $telefono,
        $descripcion,
        $total,
        $anticipo,
        $saldo,
        $fecha,
        $estado,
        $id
    );

    $stmt->execute();

    header("Location: listar.php?exito=Nota actualizada correctamente");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>✏️ Editar Nota de Venta</h3>
    <a href="listar.php" class="btn btn-secondary">⬅ Volver</a>
</div>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-md-6">
<label>Cliente</label>
<input type="text" name="cliente"
class="form-control"
value="<?= htmlspecialchars($nota['cliente'] ?? '') ?>">
</div>

<div class="col-md-6">
<label>Teléfono</label>
<input type="text" name="telefono"
class="form-control"
value="<?= htmlspecialchars($nota['telefono'] ?? '') ?>">
</div>

<div class="col-12">
<label>Descripción</label>
<textarea name="descripcion" class="form-control"><?= htmlspecialchars($nota['descripcion'] ?? '') ?></textarea>
</div>

<div class="col-md-4">
<label>Total USD</label>
<input type="number" step="0.01"
name="total_usd"
class="form-control"
value="<?= $nota['total_usd'] ?>">
</div>

<div class="col-md-4">
<label>Anticipo USD</label>
<input type="number" step="0.01"
name="anticipo_usd"
class="form-control"
value="<?= $nota['anticipo_usd'] ?>">
</div>

<div class="col-md-4">
<label>Fecha Entrega</label>
<input type="date"
name="fecha_entrega"
class="form-control"
value="<?= $nota['fecha_entrega'] ?>">
</div>

<div class="col-md-6">
<label>Estado</label>
<select name="estado" class="form-select">
<option value="pendiente" <?= $nota['estado']=='pendiente'?'selected':'' ?>>Pendiente</option>
<option value="proceso" <?= $nota['estado']=='proceso'?'selected':'' ?>>En Proceso</option>
<option value="entregado" <?= $nota['estado']=='entregado'?'selected':'' ?>>Entregado</option>
<option value="cancelado" <?= $nota['estado']=='cancelado'?'selected':'' ?>>Cancelado</option>
</select>
</div>

<div class="col-12">
<button class="btn btn-warning w-100">
💾 Actualizar Nota
</button>
</div>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['admin','ventas']);

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $cliente = $_POST['cliente'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $total = floatval($_POST['total_usd'] ?? 0);
    $anticipo = floatval($_POST['anticipo_usd'] ?? 0);
    $saldo = $total - $anticipo;
    $fecha = $_POST['fecha_entrega'] ?? null;

    $stmt = $conn->prepare("
    INSERT INTO notas_venta 
    (cliente,telefono,descripcion,total_usd,anticipo_usd,saldo_usd,fecha_entrega)
    VALUES (?,?,?,?,?,?,?)
    ");

    $stmt->bind_param("sssddds",
        $cliente,$telefono,$descripcion,
        $total,$anticipo,$saldo,$fecha
    );

    $stmt->execute();
    header("Location: listar.php?exito=Nota creada");
    exit;
}
?>

<h3>➕ Nueva Nota de Venta</h3>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-md-6">
<label>Cliente</label>
<input type="text" name="cliente" class="form-control">
</div>

<div class="col-md-6">
<label>Teléfono</label>
<input type="text" name="telefono" class="form-control">
</div>

<div class="col-12">
<label>Descripción</label>
<textarea name="descripcion" class="form-control"></textarea>
</div>

<div class="col-md-4">
<label>Total USD</label>
<input type="number" step="0.01" name="total_usd" class="form-control">
</div>

<div class="col-md-4">
<label>Anticipo USD</label>
<input type="number" step="0.01" name="anticipo_usd" class="form-control">
</div>

<div class="col-md-4">
<label>Fecha Entrega</label>
<input type="date" name="fecha_entrega" class="form-control">
</div>

<div class="col-12">
<button class="btn btn-primary w-100">Guardar Nota</button>
</div>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $nombre = trim($_POST['nombre']);
	$cantidad = intval($_POST['cantidad']);
    $conservado = $_POST['conservado'];
	$tipo = $_POST['tipo'];
	$marca = $_POST['marca'];

    if($cantidad <= 0){
        header("Location: crear.php?error=La cantidad debe ser mayor a 0");
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO productos (nombre, cantidad, conservado, tipo, marca)
        VALUES (?,?,?,?,?)
    ");

    $stmt->bind_param("sisss",$nombre,$cantidad,$conservado,$tipo,$marca);
    $stmt->execute();

    header("Location: listar.php?exito=Producto creado correctamente");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>➕ Nuevo Producto</h3>
    <a href="listar.php" class="btn btn-secondary">⬅ Volver</a>
</div>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error']; ?></div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-12">
<label class="form-label">Aplicaci&oacute;n</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="col-md-3">
<label class="form-label">Cantidad</label>
<input type="number" step="0"
name="cantidad"
class="form-control"
required>
</div>

<div class="col-md-3">
<label class="form-label">Conservado en:</label>
<select name="conservado" class="form-select" required>
<option value="Botellas">Botellas</option>
<option value="Frascos">Frascos</option>
<option value="Bolsas">Bolsas</option>
<option value="Cajas">Cajas</option>
<option value="Tubos">Tubos</option>
</select>
</div>

<div class="col-md-3">
<label class="form-label">Tipo</label>
<select name="tipo" class="form-select" required>
<option value="Sprays">Sprays</option>
<option value="Geles">Geles</option>
<option value="Liquido">Liquido</option>
<option value="Pastillas">Pastillas</option>
<option value="Espuma">Espuma</option>
<option value="Toallitas humedas">Toallitas h&uacute;medas</option>
<option value="Barras de jabon">Barras de jab&oacute;n</option>
</select>
</div>

<div class="col-md-3">
<label class="form-label">Marca</label>
<input type="text" name="marca" class="form-control" required>
</div>

<div class="col-12">
<button class="btn btn-success">
💾 Guardar Producto
</button>
<a href="listar.php" class="btn btn-secondary">Cancelar</a>
</div>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
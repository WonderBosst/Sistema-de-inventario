<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $nombre = trim($_POST['nombre']);
	$cantidad = intval($_POST['cantidad']);
    $reserva = intval($_POST['reserva']);
    $medida = $_POST['medida'];
    $conservado = $_POST['conservado'];
	$tipo = $_POST['tipo'];
	$marca = $_POST['marca'];

    if($cantidad <= 0){
        header("Location: crear.php?error=La cantidad debe ser mayor a 0");
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO productos (nombre, cantidad, reserva, medida, conservado, tipo, marca)
        VALUES (?,?,?,?,?)
    ");

    $stmt->bind_param("siissss",$nombre,$cantidad,$reserva,$medida,$conservado,$tipo,$marca);
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
  <label class="form-label">
  Aplicaci&oacute;n 
  <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Describa para qué sirve el producto. Ejemplo: Limpieza de superficies.">
  </i>
</label>
  <input type="text" name="nombre" class="form-control" required>
</div>

<div class="col-md-3">
<label class="form-label">Cantidad
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba en unidades cuantos productos tiene.">
  </i>
</label>
<input type="number" step="0"
name="cantidad"
class="form-control" min="1"
required>
</div>

<div class="col-md-3">
<label class="form-label">Reserva por unidad?
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba cuanto pesa por producto en cantidad númerica. Ejemplo: 1 botella igual a 900 ML">
  </i>
</label>
<input type="number" step="0"
name="reserva"
class="form-control" min="1"
required>
</div>

<div class="col-md-3">
<label class="form-label">Unidad de medida: 
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Seleccione la unidad de medida del producto">
  </i>
</label>
<select name="medida" class="form-select" required>
<option value="kg">Kilogramos</option>
<option value="g">Gramos</option>
<option value="L">Litros</option>
<option value="ml">Mililitros</option>
<option value="unidades">Unidades</option>
</select>
</div>

<div class="col-md-3">
<label class="form-label">Conservado en: 
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Seleccione como se conserva el producto">
  </i>
</label>
<select name="conservado" class="form-select" required>
<option value="Botellas">Botellas</option>
<option value="Frascos">Frascos</option>
<option value="Bolsas">Bolsas</option>
<option value="Cajas">Cajas</option>
<option value="Tubos">Tubos</option>
</select>
</div>

<div class="col-md-3">
<label class="form-label">Tipo
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Seleccione como esta hecho el producto.">
  </i>
</label>
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
<label class="form-label">Marca
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba que distribuidor representa el producto.">
  </i>
</label>
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
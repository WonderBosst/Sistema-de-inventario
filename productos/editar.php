<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

$id = intval($_GET['id']);

$producto = $conn->query("
SELECT * FROM productos WHERE id_producto=$id
")->fetch_assoc();

if(!$producto){
    header("Location: listar.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = trim($_POST['nombre']);
	$cantidad = intval($_POST['cantidad']);
    $conservado = $_POST['conservado'];
	$tipo = $_POST['tipo'];
	$marca = $_POST['marca'];

    $stmt = $conn->prepare("
        UPDATE productos 
        SET nombre=?, cantidad=?, conservado=?, tipo=?, marca=?
        WHERE id_producto=?
    ");

    $stmt->bind_param("sisssi",$nombre,$cantidad,$conservado,$tipo,$marca,$id);
    $stmt->execute();

    header("Location: listar.php?exito=Producto actualizado");
    exit;
}
?>

<div class="card shadow rounded-4">
<div class="card-body">

<h3 class="mb-4">✏️ Editar Producto</h3>

<form method="POST" class="row g-3">

<div class="col-12">
<label>Aplicaci&oacute;n
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Describa para qué sirve el producto. Ejemplo: Limpieza de superficies.">
  </i>
</label>
<input type="text" name="nombre"
class="form-control"
value="<?= htmlspecialchars($producto['nombre']); ?>"
required>
</div>

<div class="col-md-3">
<label>Cantidad
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba en unidades cuantos productos tiene.">
    </i>
</label>
<input type="double"
name="cantidad"
class="form-control"
value="<?= $producto['cantidad']; ?>"
required>
</div>

<div class="col-md-3">
<label>Reserva por unidad?
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba cuanto pesa por producto en cantidad númerica. Ejemplo: 1 botella igual a 900 ML">
    </i>
</label>
<input type="number" step="0"
name="reserva"
class="form-control"
value="<?= $producto['reserva']; ?>"
required>
</div>

<div class="col-md-3">
<label>Unidad de medida: 
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

<div class="col-md-6">
<label>Conservado en:
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Seleccione como se conserva el producto">
    </i>
</label>
<select name="conservado" class="form-select">
<option value="Botellas" <?= $producto['conservado']=='Botellas'?'selected':'' ?>>Botellas</option>
<option value="Frascos" <?= $producto['conservado']=='Frascos'?'selected':'' ?>>Frascos</option>
<option value="Bolsas" <?= $producto['conservado']=='Bolsas'?'selected':'' ?>>Bolsas</option>
<option value="Cajas" <?= $producto['conservado']=='Cajas'?'selected':'' ?>>Cajas</option>
<option value="Tubos" <?= $producto['conservado']=='Tubos'?'selected':'' ?>>Tubos</option>
</select>
</div>

<div class="col-md-6">
<label>Tipo
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Seleccione como esta hecho el producto.">
    </i>
</label>
<select name="tipo" class="form-select">
<option value="Sprays" <?= $producto['tipo']=='Spray'?'selected':'' ?>>Spray</option>
<option value="Geles" <?= $producto['tipo']=='Geles'?'selected':'' ?>>Geles</option>
<option value="Liquido" <?= $producto['tipo']=='Liquido'?'selected':'' ?>>Liquido</option>
<option value="Pastillas" <?= $producto['tipo']=='Pastillas'?'selected':'' ?>>Pastillas</option>
<option value="Espumas" <?= $producto['tipo']=='Espumas'?'selected':'' ?>>Espuma</option>
<option value="Toallitas humedas" <?= $producto['tipo']=='Toallitas humedas'?'selected':'' ?>>Toallitas h&uacute;medas</option>
<option value="Barras de jabon" <?= $producto['tipo']=='Barras de jabon'?'selected':'' ?>>Barras de jab&oacute;n</option>
</select>
</div>

<div class="col-md-6">
<label>Marca
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba que distribuidor representa el producto.">
    </i>
</label>
<input type="text" name="marca"
class="form-control"
value="<?= htmlspecialchars($producto['marca']); ?>"
required>
</div>

<div class="col-12 mt-3">
<button class="btn btn-warning">Actualizar</button>
<a href="listar.php" class="btn btn-secondary">Cancelar</a>
</div>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
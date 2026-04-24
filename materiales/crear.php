<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $nombre = trim($_POST['nombre']);
	$cantidad = intval($_POST['cantidad']);
	$marca = $_POST['marca'];

    if($cantidad <= 0){
        header("Location: crear.php?error=La cantidad debe ser mayor a 0");
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO material (nombre, cantidad, marca)
        VALUES (?,?,?)
    ");

    $stmt->bind_param("sis",$nombre,$cantidad,$marca);
    $stmt->execute();

    header("Location: listar.php?exito=Material creado correctamente");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>➕ Nuevo Material</h3>
    <a href="listar.php" class="btn btn-secondary">⬅ Volver</a>
</div>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error']; ?></div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-12">
<label class="form-label">Nombre de material 
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el uso que tiene el material.">
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
     title="Escriba en número la cantidad de unidades de material de limpieza">
  </i>
</label>
<input type="number" step="0"
name="cantidad"
class="form-control"
required>
</div>

<div class="col-md-3">
<label class="form-label">Marca
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el distribuidor del material de limpieza">
  </i>
</label>
<input type="text" name="marca" class="form-control" required>
</div>

<div class="col-12">
<button class="btn btn-success w-100">
💾 Guardar Producto
</button>
</div>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
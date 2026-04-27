<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

$id = intval($_GET['id']);

$material = $conn->query("
SELECT * FROM material WHERE id_material=$id
")->fetch_assoc();

if(!$material){
    header("Location: listar.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = trim($_POST['nombre']);
	$cantidad = intval($_POST['cantidad']);
	$marca = $_POST['marca'];

    $stmt = $conn->prepare("
        UPDATE material 
        SET nombre=?, cantidad=?, marca=?
        WHERE id_material=?
    ");

    $stmt->bind_param("sisi",$nombre,$cantidad,$marca,$id);
    $stmt->execute();

    header("Location: listar.php?exito=Material actualizado");
    exit;
}
?>

<div class="card shadow rounded-4">
<div class="card-body">

<h3 class="mb-4">✏️ Editar Material</h3>

<form method="POST" class="row g-3">

<div class="col-12">
<label>Nombre
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el uso que tiene el material.">
    </i>
</label>
<input type="text" name="nombre"
class="form-control"
value="<?= htmlspecialchars($material['nombre']); ?>"
required>
</div>

<div class="col-md-6">
<label>Cantidad
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba en número la cantidad de unidades de material de limpieza">
    </i>
</label>
<input type="double"
name="cantidad"
class="form-control"
value="<?= $material['cantidad']; ?>"
required>
</div>

<div class="col-md-6">
<label>Marca
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el distribuidor del material de limpieza">
    </i>
</label>
<input type="text" name="marca"
class="form-control"
value="<?= htmlspecialchars($material['marca']); ?>"
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
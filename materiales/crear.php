<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);

$querySugerencias = $conn->query("SELECT DISTINCT nombre FROM material ORDER BY nombre ASC");
$sugerencias = [];
while ($rowS = $querySugerencias->fetch_assoc()) {
    $sugerencias[] = $rowS['nombre'];
}

function generateRandomCodigo() {
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomPart = '';
    
    for ($i = 0; $i < 8; $i++) {
        $randomPart .= $letters[rand(0, strlen($letters) - 1)];
    }

    return "cleaner-" . $randomPart ;
}

if($_SERVER['REQUEST_METHOD']=='POST'){

    $codigo = generateRandomCodigo();
    $nombre = trim($_POST['nombre']);
	$marca = $_POST['marca'];

    $stmt = $conn->prepare("
        INSERT INTO material (codigo, nombre, marca)
        VALUES (?,?,?)
    ");

    $stmt->bind_param("sss",$codigo,$nombre,$marca);
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

<div class="col-md-3">
    <label class="form-label">Art&iacute;culo de limpieza 
        <i class="bi bi-question-circle text-primary" 
           style="cursor: pointer; margin-left: 5px;" 
           data-bs-toggle="tooltip" 
           data-bs-placement="top" 
           title="Escriba el nombre del articulo de limpieza en singular.">
        </i>
    </label>

    <input type="text" name="nombre" class="form-control" list="listaMateriales" autocomplete="off" required>
    
    <datalist id="listaMateriales">
        <?php foreach($sugerencias as $sug): ?>
            <option value="<?= htmlspecialchars($sug); ?>">
        <?php endforeach; ?>
    </datalist>
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
💾 Guardar material
</button>
</div>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $titulo = trim($_POST['titulo']);
    $escrito = trim($_POST['escrito']);

    $stmt = $conn->prepare("
        INSERT INTO notas (titulo, escrito)
        VALUES (?,?)
    ");

    $stmt->bind_param("ssi",$titulo,$escrito);
    $stmt->execute();

    header("Location: listar.php?exito=Nota creada correctamente");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>➕ Nueva nota</h3>
    <a href="listar.php" class="btn btn-secondary">⬅ Volver</a>
</div>


<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-md-2">
<label class="form-label">T&iacute;tulo
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba un titulo para reconocer el escrito">
    </i>
</label>
<input type="text" name="titulo" class="form-control" required>
</div>

<label class="form-label">Descripci&oacute;n
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba ideas, descripciónes, consejos, sugerencias o cualquier información que sea importante">
    </i>
</label>
<div class="form-floating">
  <textarea class="form-control" name="escrito" id="floatingTextarea2" style="height: 100px" required></textarea>
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
<?php
include '../includes/conexion.php';
include '../includes/auth.php';
requireRole(['1']);

include '../includes/header.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $direccion = trim($_POST['direccion']);
    $entre_calles = trim($_POST['entre_calles']);
    $correo = trim($_POST['correo']);
    $numero_telefonico = intval($_POST['numero_telefonico']);

    $stmt = $conn->prepare("
        INSERT INTO crm (nombre, apellidos, direccion, entre_calles, correo, numero_telefonico)
        VALUES (?,?,?,?,?,?)
    ");

    $stmt->bind_param("sssssi",$nombre,$apellidos,$direccion,$entre_calles,$correo,$numero_telefonico);
    $stmt->execute();

    header("Location: listar.php?exito=Cliente creado correctamente");
    exit;
}
?>

<h3>Nuevo cliente</h3>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error'] ?></div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-md-3">
<label class="form-label">Nombre
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Agregue el nombre del cliente que se añadira al sistema">
    </i>
</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="col-md-3">
<label class="form-label">Apellidos
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escribe los apellidos del cliente que se añadira al sistema">
    </i>
</label>
<input type="text" name="apellidos" class="form-control" required>
</div>

<div class="col-12">
<label class="form-label">Direcci&oacute;n
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba la dirección de la casa del cliente">
    </i>
</label>
<input type="text" name="direccion" class="form-control" required>
</div>

<div class="col-12">
<label class="form-label">Entre_calles
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba las calles paralelas al domicilio del cliente">
    </i>
</label>
<input type="text" name="entre_calles" class="form-control" required>
</div>

<div class="col-md-3">
<label class="form-label">Correo
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el medio por el cual el cliente recibe mensajes electrónicos">
    </i>
</label>
<input type="text" name="correo" class="form-control" required>
</div>

<div class="col-md-3">
<label class="form-label">N&uacute;mero tel&eacute;fonico
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el número de contacto teléfonico del cliente">
    </i>
</label>
<input type="text" name="numero_telefonico" class="form-control" required>
</div>

<div class="col-12 mt-3">
<button class="btn btn-success"> 💾 Guardar datos </button>
<a href="listar.php" class="btn btn-secondary">Cancelar</a>
</div>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
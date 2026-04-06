<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $rol = intval($_POST['rol']);
	$password = trim($_POST['password']);
	$edad = intval($_POST['edad']);
    $direccion = trim($_POST['direccion']);
    $entre_calles = trim($_POST['entre_calles']);
    $correo = trim($_POST['correo']);
    $numero_telefonico = intval($_POST['numero_telefonico']);
    $activo = $_POST['activo'];
    
	if($rol == 1){
		$stmt = $conn->prepare("
        INSERT INTO rh (nombre, apellidos, rol, password, edad, direccion, entre_calles, correo, numero_telefonico) 
		values  (?,?,?,?,?,?,?,?,?)
		");

		$stmt->bind_param("ssisisssi",$nombre,$apellidos,$rol,$password,$edad,$direccion,$entre_calles,$correo,$numero_telefonico);
		
	} else {
	    $password = "";
		
        $stmt = $conn->prepare("
        INSERT INTO rh (nombre, apellidos, edad, direccion, entre_calles, correo, numero_telefonico) 
		values  (?,?,?,?,?,?,?)
        ");

        $stmt->bind_param("ssisssi",$nombre,$apellidos,$edad,$direccion,$entre_calles,$correo,$numero_telefonico);
	}
	
    if(!$stmt->execute()){
        echo $stmt->error;
        exit;
    }

    header("Location: listar.php?exito=Trabajador creado correctamente");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-person-fill-add"></i> Nuevo Trabajador</h3>
</div>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error']; ?></div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-md-6">
<label class="form-label">Nombre</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="col-md-6">
<label class="form-label">Apellidos</label>
<input type="text" name="apellidos" class="form-control" required>
</div>

<div class="col-12">
<label class="form-label">Rol</label>
<select name="rol" id="rolSelect" class="form-select" required>
<option value="0">Trabajador</option>
<option value="1">Administrador</option>
</select>
</div>

<div class="collapse mt-3" id="collapseRol">
  <div class="card card-body">
    <div class="mb-3">
       <label>Contraseña</label>
       <input type="password"
       name="password"
       id="passwordInput"
       class="form-control">
    </div>
  </div>
</div>

<div class="col-md-6">
<label class="form-label">Edad</label>
<input type="text" name="edad" class="form-control" required>
</div>

<div class="col-md-6">
<label class="form-label">Direcci&oacute;n</label>
<input type="text" name="direccion" class="form-control" required>
</div>

<div class="col-md-6">
<label class="form-label">Entre calles</label>
<input type="text" name="entre_calles" class="form-control" required>
</div>

<div class="col-md-6">
<label class="form-label">Correo</label>
<input type="text" name="correo" class="form-control" required>
</div>

<div class="col-md-6">
<label class="form-label">N&uacute;mero Tel&eacute;fonico</label>
<input type="text" name="numero_telefonico" class="form-control" required>
</div>

<div class="col-12">
<button class="btn btn-success w-100">
💾 Registrar Trabajador
</button>
</div>

</form>

</div>
</div>

<div class="col-12 mt-3">
	<a href="listar.php" 
	class="btn btn-sm btn-secondary">
	<i class="bi bi-arrow-return-left"></i> Regresar
	</a>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const rol = document.getElementById("rolSelect");
    const collapseElement = document.getElementById("collapseRol");
    const password = document.getElementById("passwordInput");

    const collapse = new bootstrap.Collapse(collapseElement, { toggle: false });

    function toggleRol(){
        if(rol.value === "1"){
            collapse.show();
            password.required = true;
        } else {
            collapse.hide();
            password.required = false;
        }
    }

    rol.addEventListener("change", toggleRol);

    toggleActivo(); // inicializa al cargar
});
</script>

<?php include '../includes/footer.php'; ?>
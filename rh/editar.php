<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';

requireRole(['1']);

$id = intval($_GET['id']);

$trabajador = $conn->query("
SELECT * FROM rh WHERE id_trabajador=$id
")->fetch_assoc();

if(!$trabajador){
    header("Location: listar.php");
    exit;
}


if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $edad = intval($_POST['edad']);
    $rol = intval($_POST['rol']);
    $direccion = trim($_POST['direccion']);
    $entre_calles = trim($_POST['entre_calles']);
    $correo = trim($_POST['correo']);
    $numero_telefonico = intval($_POST['numero_telefonico']);
    $activo = $_POST['activo'];
	$password = "";

	if($activo == "0"){ 
	
		$rol = 0;
	    $password = "";
		
        $stmt = $conn->prepare("
        UPDATE rh 
        SET nombre=?, apellidos=?, edad=?, rol=?, password=?, direccion=?, entre_calles=?, correo=?, numero_telefonico=?, activo=?
        WHERE id_trabajador=?
        ");

        $stmt->bind_param("ssiissssiii",$nombre,$apellidos,$edad,$rol,$password,$direccion,$entre_calles,$correo,$numero_telefonico,$activo,$id);
    
	} elseif($rol == 1){

        $password = trim($_POST['password']);

        $stmt = $conn->prepare("
        UPDATE rh 
        SET nombre=?, apellidos=?, edad=?, rol=?, password=?, direccion=?, entre_calles=?, correo=?, numero_telefonico=?, activo=?
        WHERE id_trabajador=?
        ");

        $stmt->bind_param("ssiissssiii",$nombre,$apellidos,$edad,$rol,$password,$direccion,$entre_calles,$correo,$numero_telefonico,$activo,$id);

    }
		
        $stmt = $conn->prepare("
        UPDATE rh 
        SET nombre=?, apellidos=?, edad=?, rol=?, password=?, direccion=?, entre_calles=?, correo=?, numero_telefonico=?, activo=?
        WHERE id_trabajador=?
        ");

        $stmt->bind_param("ssiissssiii",$nombre,$apellidos,$edad,$rol,$password,$direccion,$entre_calles,$correo,$numero_telefonico,$activo,$id);
    
    if(!$stmt->execute()){
        echo $stmt->error;
        exit;
    }

    header("Location: listar.php?exito=Trabajador actualizado");
    exit;
}
?>

<div class="card shadow rounded-4">
<div class="card-body">

<h3 class="mb-4">✏️ Editar Trabajador</h3>

<form method="POST" class="row g-3">

<div class="col-md-6">
<label>Nombre
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el nombre del trabajador">
    </i>
</label>
<input type="text" name="nombre"
class="form-control"
value="<?= htmlspecialchars($trabajador['nombre']); ?>"
required>
</div>

<div class="col-md-6">
<label>Apellidos
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba los apellidos del trabajador">
    </i>
</label>
<input type="text"
name="apellidos"
class="form-control"
value="<?= htmlspecialchars ($trabajador['apellidos']); ?>"
required>
</div>

<div class="mb-3">
<label>Rol
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Seleccione el rol que ejercera la persona en la empresa">
    </i>
</label>
<select name="rol" id="rolSelect" class="form-select">
    <option value="1" <?= $trabajador['rol']=='1'?'selected':'' ?>>Administrador</option>
    <option value="0" <?= $trabajador['rol']=='0'?'selected':'' ?>>Trabajador</option>
</select>
</div>

<div class="collapse mt-3" id="collapseRol">
  <div class="card card-body">
    <div class="mb-3">
       <label>Contraseña
            <i class="bi bi-question-circle text-primary" 
                style="cursor: pointer; margin-left: 5px;" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                title="Debido a que el nuevo personal sera administrador asignale una contraseña">
            </i>
       </label>
       <input type="password"
       name="password"
       id="passwordInput"
       class="form-control"
       value="<?= $trabajador['rol'] == 1 ? htmlspecialchars($trabajador['password']) : '' ?>">
    </div>
  </div>
</div>

<div class="col-md-6">
<label>Edad
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Anote la edad de la persona">
    </i>
</label>
<input type="text" name="edad"
class="form-control"
value="<?= htmlspecialchars($trabajador['edad']); ?>"
required>
</div>

<div class="col-12">
<label>Direcci&oacute;n
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escribe la dirección del trabajador">
    </i>
</label>
<input type="text" name="direccion"
class="form-control"
value="<?= htmlspecialchars($trabajador['direccion']); ?>"
required>
</div>

<div class="col-12">
<label>Entre calles
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba las calles paralelas al domicilio del trabajador">
    </i>
</label>
<input type="text" name="entre_calles"
class="form-control"
value="<?= htmlspecialchars($trabajador['entre_calles']); ?>"
required>
</div>

<div class="col-md-6">
<label>correo
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el medio por el cual el trabajador recibe mensajes electrónicos">
    </i>
</label>
<input type="text" name="correo"
class="form-control"
value="<?= htmlspecialchars($trabajador['correo']); ?>"
required>
</div>

<div class="col-md-6">
<label>N&uacute;mero tel&eacute;fonico
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Escriba el número de contacto teléfonico del trabajador">
    </i>
</label>
<input type="text" name="numero_telefonico"
class="form-control"
value="<?= intval($trabajador['numero_telefonico']); ?>"
required>
</div>

<div class="col-md-6">
<label>Activo
    <i class="bi bi-question-circle text-primary" 
     style="cursor: pointer; margin-left: 5px;" 
     data-bs-toggle="tooltip" 
     data-bs-placement="top" 
     title="Seleccione si el trabajador seguira activo o no">
    </i>
</label>
<select name="activo" id="activoSelect" class="form-select">
<option value="1" <?= $trabajador['activo']=='1'?'selected':'' ?>>Activo</option>
<option value="0" <?= $trabajador['activo']=='0'?'selected':'' ?>>Dar de baja</option>
</select>
</div>

<div class="col-12 mt-3">
<button class="btn btn-warning">Actualizar</button>
<a href="listar.php" class="btn btn-secondary">Cancelar</a>
</div>
</form>

</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const rol = document.getElementById("rolSelect");
    const collapseElement = document.getElementById("collapseRol");
    const password = document.getElementById("passwordInput");
    const activo = document.getElementById("activoSelect");

    const collapse = new bootstrap.Collapse(collapseElement, { toggle: false });

    function toggleRol(){
        if(rol.value === "1" && activo.value === "1"){
            collapse.show();
            password.required = true;
        } else {
            collapse.hide();
            password.required = false;
        }
    }

    function toggleActivo(){
        if(activo.value === "0"){
            rol.value = "0";     // fuerza rol Trabajador
            rol.disabled = true; // desactiva select
            if(rol.value != "1") {
				password.value = ""; // borra password solo si no es admin
			}
        } else {
            rol.disabled = false; // se puede cambiar rol
        }
        toggleRol();
    }

    rol.addEventListener("change", toggleRol);
    activo.addEventListener("change", toggleActivo);

    toggleActivo(); // inicializa al cargar
});
</script>

<?php include '../includes/footer.php'; ?>
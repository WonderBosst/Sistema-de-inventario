<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include 'funciones.php';
include '../includes/header.php';
requireRole(['1']);

$id = intval($_GET['id']);

$cliente = $conn->query("
SELECT * FROM crm WHERE id_cliente=$id
")->fetch_assoc();

if(!$cliente){
    header("Location: listar.php?error=cliente no encontrado");
    exit;


}
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $direccion = trim($_POST['direccion']);
    $entre_calles = trim($_POST['entre_calles']);
    $correo = trim($_POST['correo']);
    $numero_telefonico = intval($_POST['numero_telefonico']);
	$activo = $_POST['activo'];

	$stmt = $conn->prepare("
        UPDATE crm 
        SET nombre=?, apellidos=?, direccion=?, entre_calles=?, correo=?, numero_telefonico=?, activo=?
        WHERE id_cliente=?
    ");

	$stmt->bind_param("sssssiii",$nombre,$apellidos,$direccion,$entre_calles,$correo,$numero_telefonico,$activo,$id);
    $stmt->execute();
	
    header("Location: listar.php?exito=Cliente actualizado");
    exit;
}
?>

<h3 class="mb-4">✏️ Editar cliente</h3>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger"><?= $_GET['error'] ?></div>
<?php endif; ?>

<div class="card shadow rounded-4">
<div class="card-body">

<form method="POST" class="row g-3">

<div class="col-md-6">
<label>Nombre</label>
<input type="text" name="nombre"
class="form-control"
value="<?= htmlspecialchars($cliente['nombre']); ?>"
required>
</div>

<div class="col-md-6">
<label>Apellidos</label>
<input type="text" name="apellidos"
class="form-control"
value="<?= htmlspecialchars($cliente['apellidos']); ?>"
required>
</div>

<div class="col-12">
<label>Direcci&oacute;n</label>
<input type="text" name="direccion"
class="form-control"
value="<?= htmlspecialchars($cliente['direccion']); ?>"
required>
</div>

<div class="col-12">
<label>Entre calles</label>
<input type="text" name="entre_calles"
class="form-control"
value="<?= htmlspecialchars($cliente['entre_calles']); ?>"
required>
</div>

<div class="col-md-6">
<label>Correo</label>
<input type="text" name="correo"
class="form-control"
value="<?= htmlspecialchars($cliente['correo']); ?>"
required>
</div>

<div class="col-md-6">
<label>N&uacute;mero tel&eacute;fonico</label>
<input type="text"
name="numero_telefonico"
class="form-control"
value="<?= $cliente['numero_telefonico']; ?>"
required>
</div>

<div class="col-md-6">
<label>Activo</label>
<select name="activo" id="rolSelect" class="form-select">
    <option value="1" <?= $cliente['activo']=='1'?'selected':'' ?>>Cliente activo</option>
    <option value="0" <?= $cliente['activo']=='0'?'selected':'' ?>>Cliente inactivo</option>
</select>
</div>

<div class="col-12 mt-3">
<button class="btn btn-warning">
💾 Actualizar
</button>

<a href="listar.php" class="btn btn-secondary">
Cancelar
</a>
</div>

</form>

</div>
</div>

<?php include '../includes/footer.php'; ?>
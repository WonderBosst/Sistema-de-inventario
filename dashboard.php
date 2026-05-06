<?php
header('Content-Type: text/html; charset=utf8mb4');
include 'includes/conexion.php';
include 'includes/auth.php';
include 'includes/header.php';

$rol_usuario = $_SESSION['rol'] ?? '1';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevo_limite'], $_POST['entidad_objetivo'])) {
    if ($rol_usuario == '1') {
        $nuevo_valor = (int)$_POST['nuevo_limite'];
        $entidad = $_POST['entidad_objetivo'];

        $stmt = $conn->prepare("UPDATE limitante SET limite = ? WHERE entidad = ?");
        $stmt->bind_param("is", $nuevo_valor, $entidad);
        
        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?actualizado=1");
            exit;
        }
    }
}

$res_limites = $conn->query("SELECT entidad, limite FROM limitante");
$limites_db = [];
while ($row = $res_limites->fetch_assoc()) {
    $limites_db[$row['entidad']] = $row['limite'];
}

$limite_productos = $limites_db['productos'] ?? 6;
$limite_materiales = $limites_db['materiales'] ?? 6;

$productos_bajos = [];
$materiales_bajos = [];

if ($rol_usuario == '1') {
    $res_stock = $conn->query("SELECT nombre, cantidad FROM productos WHERE cantidad < $limite_productos");
    while ($row_s = $res_stock->fetch_assoc()) {
        $productos_bajos[] = $row_s;
    }

    $sql_mat = "SELECT M.nombre, COUNT(*) AS total 
                FROM material AS M 
                WHERE M.estatus = true 
                GROUP BY M.nombre 
                HAVING COUNT(*) < $limite_materiales";
    $res_mat = $conn->query($sql_mat);
    while ($row_m = $res_mat->fetch_assoc()) {
        $materiales_bajos[] = $row_m;
    }
}
?>

<div class="row mb-4">
    <div class="col-md-6 col-lg-5 mb-3">
        <div class="card shadow-sm border-0 bg-light">
            <div class="card-body">
                <form method="POST" class="row g-2 align-items-center">
                    <input type="hidden" name="entidad_objetivo" value="productos">
                    
                    <div class="col-auto">
                        <label class="form-label small fw-bold mb-0">Límite Productos: 
                            <i class="bi bi-question-circle text-primary" data-bs-toggle="tooltip" title="Límite de stock para productos"></i>
                        </label>
                        <input type="number" name="nuevo_limite" class="form-control form-control-sm" placeholder="Ej. 10" min="1" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm mt-4">Actualizar</button>
                    </div>
                    <div class="col-auto ms-3 mt-4">
                        <span class="badge bg-info text-dark p-2">
                            Actual: <strong><?= $limite_productos ?></strong>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-5 mb-3">
        <div class="card shadow-sm border-0 bg-light">
            <div class="card-body">
                <form method="POST" class="row g-2 align-items-center">

                    <input type="hidden" name="entidad_objetivo" value="materiales">
                    
                    <div class="col-auto">
                        <label class="form-label small fw-bold mb-0">Límite Materiales: 
                            <i class="bi bi-question-circle text-primary" data-bs-toggle="tooltip" title="Límite de stock para materiales"></i>
                        </label>
                        <input type="number" name="nuevo_limite" class="form-control form-control-sm" placeholder="Ej. 10" min="1" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm mt-4">Actualizar</button>
                    </div>
                    <div class="col-auto ms-3 mt-4">
                        <span class="badge bg-info text-dark p-2">
                            Actual: <strong><?= $limite_materiales ?></strong>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        
        <?php if (!empty($productos_bajos)): ?>
            <div class="alert alert-danger shadow-sm rounded-4 mb-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                    <div>
                        <strong>¡Stock Crítico (Productos)!</strong> Hay productos agotándose.
                        <ul class="mb-0 mt-2">
                            <?php foreach ($productos_bajos as $p): ?>
                                <li>
                                    <strong><?= htmlspecialchars($p['nombre']); ?></strong>: 
                                    <span class="badge bg-danger"><?= $p['cantidad']; ?> unidades</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <hr>
                <a href="productos/listar.php" class="alert-link small">Gestionar Productos →</a>
            </div>
        <?php endif; ?>

         
        <?php if (!empty($materiales_bajos)): ?>
            <div class="alert alert-warning shadow-sm rounded-4 mb-4" role="alert" style="border-left: 5px solid #ffc107;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-box-seam-fill fs-4 me-3"></i>
                    <div>
                        <strong>¡Stock Bajo (Materiales)!</strong> Es necesario revisar los insumos.
                        <ul class="mb-0 mt-2">
                            <?php foreach ($materiales_bajos as $m): ?>
                                <li>
                                    <strong><?= htmlspecialchars($m['nombre']); ?></strong>: 
                                    <span class="badge bg-dark"><?= $m['total']; ?> disp.</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <hr>
                <a href="materiales/listar.php" class="alert-link small text-dark">Gestionar Materiales →</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<h5 class="mb-3 fw-bold">Panel de Control</h5>

<div class="row g-4">

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="productos/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-basket fs-1 text-primary"></i>
<h6 class="mt-3">Productos</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="materiales/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-box-seam fs-1 text-warning"></i>
<h6 class="mt-3">Material</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="crm/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-person-fill-add fs-1 text-success"></i>
<h6 class="mt-3">CRM</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="rh/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-people fs-1 text-success"></i>
<h6 class="mt-3">RH</h6>
</div>
</a>
</div>
<?php endif; ?>

<!-- NUEVO MODULO NOTAS -->
<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="notas/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-journal-check fs-1 text-info"></i>
<h6 class="mt-3">Notas</h6>
</div>
</a>
</div>
<?php endif; ?>


<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="operacion/listar.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-clipboard-check fs-1 text-secondary"></i>
<h6 class="mt-3">Operaci&oacute;n</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="reportes/vista.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-card-checklist fs-1 text-info"></i>
<h6 class="mt-3">Reportes</h6>
</div>
</a>
</div>
<?php endif; ?>

<?php if($rol_usuario == '1'): ?>
<div class="col-6 col-md-3">
<a href="estadisticas/vista.php" class="text-decoration-none">
<div class="card shadow rounded-4 p-4 text-center h-100 hover-scale">
<i class="bi bi-bar-chart fs-1 text-danger"></i>
<h6 class="mt-3">Estad&iacute;sticas</h6>
</div>
</a>
</div>
<?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
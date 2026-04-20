<?php
include 'conexion.php'; // Verifica que aquí la variable sea $conn o $conexion
include 'auth.php';

// Evitar que cualquier error previo ensucie el JSON
ob_start();

$mes = isset($_POST['mes']) ? intval($_POST['mes']) : date('n');
$anio = isset($_POST['anio']) ? intval($_POST['anio']) : date('Y');
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '1';

$labels = [];
$valores = [];
$sql = "";

switch ($tipo) {
    case '1':
        // Agregamos AS etiqueta para que coincida con el fetch
        $sql = "SELECT t.nombre AS etiqueta, COUNT(o.id_operacion) as total 
                FROM rh t
                JOIN grupo_trabajadores gt ON t.id_trabajador = gt.id_trabajador
                JOIN grupos_trabajadores gtr ON gtr.id_grupo_trabajadores = gt.id_grupo_trabajadores
                JOIN operacion o ON gtr.id_grupo_trabajadores = o.id_grupo_trabajadores
                WHERE MONTH(o.fecha_creacion) = ? AND YEAR(o.fecha_creacion) = ?
                GROUP BY t.id_trabajador, t.nombre";
        break;
    case '2':
        $sql = "SELECT p.nombre AS etiqueta, SUM(gp.cantidad) as total 
                FROM productos p
                JOIN grupo_productos gp ON p.id_producto = gp.id_producto
                JOIN grupos_productos gps ON gp.id_grupo_productos = gps.id_grupo_productos
                JOIN operacion o ON gp.id_grupo_productos = o.id_grupo_productos
                WHERE MONTH(o.fecha_creacion) = ? AND YEAR(o.fecha_creacion) = ?
                GROUP BY p.id_producto, p.nombre";
        break;
    case '3':
        $sql = "SELECT m.nombre AS etiqueta, SUM(gm.cantidad) as total 
                FROM material m
                JOIN grupo_materiales gm ON m.id_material = gm.id_material
                JOIN grupos_materiales grm ON gm.id_grupo_materiales = grm.id_grupo_materiales
                JOIN operacion o ON gm.id_grupo_materiales = o.id_grupo_materiales
                WHERE MONTH(o.fecha_creacion) = ? AND YEAR(o.fecha_creacion) = ?
                GROUP BY m.id_material, m.nombre";
        break;
    case '4':
        $sql = "SELECT estatus AS etiqueta, COUNT(*) as total 
                FROM operacion 
                WHERE MONTH(fecha_creacion) = ? AND YEAR(fecha_creacion) = ?
                GROUP BY estatus";
        break;
}

$stmt = $conn->prepare($sql); 
$stmt->bind_param("ii", $mes, $anio);
$stmt->execute();
$result = $stmt->get_result();

$labels = [];
$valores = [];

while ($row = $result->fetch_assoc()) {
    // Verificamos que no vengan nulos
    $labels[] = $row['etiqueta'] ?? 'Sin nombre';
    $valores[] = (float)$row['total'];
}

ob_end_clean();
header('Content-Type: application/json');
echo json_encode(['labels' => $labels, 'valores' => $valores]);
exit;
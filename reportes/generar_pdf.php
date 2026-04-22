<?php
error_reporting(0);
ini_set('display_errors', 0);

while (ob_get_level()) {
    ob_end_clean();
}

include '../includes/conexion.php';

$id_operacion = $_GET['operacion'] ?? 'Sin datos';
$id_cliente = $_GET['cliente'] ?? 'Sin datos';

$trabajadores_html = "";
$productos_html = "";
$material_html = "";

if (intval($id_operacion) > 0) { // Usa id_operacion para buscar
    $query = "SELECT C.nombre, 
                C.apellidos,
                C.direccion,
                C.entre_calles,
                C.correo, 
                C.numero_telefonico 
              FROM crm AS C 
              INNER JOIN operacion AS O ON O.id_cliente = C.id_cliente 
              WHERE O.id_operacion = " . intval($id_operacion);

    $result_cliente = $conn->query($query);

    if ($result_cliente && $result_cliente->num_rows > 0) {
       
        $datos_cliente = $result_cliente->fetch_assoc();
        
        $nombre            = $datos_cliente['nombre'];
        $apellidos         = $datos_cliente['apellidos'];
        $direccion         = $datos_cliente['direccion'];
        $entre_calles      = $datos_cliente['entre_calles'];
        $correo            = $datos_cliente['correo'];
        $numero_telefonico = $datos_cliente['numero_telefonico'];
        
    }
} 

if (intval($id_operacion) > 0) { // Usa id_operacion para buscar
    $query = "SELECT N.titulo, 
                N.escrito
              FROM notas AS N 
              INNER JOIN operacion AS O ON O.id_operacion = N.id_operacion
              WHERE O.id_operacion = " . intval($id_operacion);

    $result_notas = $conn->query($query);

    if ($result_notas && $result_notas->num_rows > 0) {
       
        $result_notas = $result_notas->fetch_assoc();
        
        $titulo            = $result_notas['titulo'];
        $escrito         = $result_notas['escrito'];
        
    } else {
        $notas_error_html = "<p style='color:red;'>No se encontraron notas para la operación </p>";
    }
} else {
    $notas_error_html = "<p>ID de operación no válido.</p>";
}

if (intval($id_operacion) > 0) {
    // 3. Consulta corregida (sin comillas extras al final)
    $query = "SELECT R.nombre, R.apellidos, R.correo, R.numero_telefonico
              FROM rh AS R 
              INNER JOIN grupo_trabajadores AS GT ON GT.id_trabajador = R.id_trabajador 
              INNER JOIN grupos_trabajadores AS GTR ON GTR.id_grupo_trabajadores = GT.id_grupo_trabajadores 
              INNER JOIN operacion AS O ON O.id_grupo_trabajadores = GTR.id_grupo_trabajadores 
              WHERE O.id_operacion = " . intval($id_operacion);

    $result_trabajadores = $conn->query($query);

    if ($result_trabajadores && $result_trabajadores->num_rows > 0) {
        $trabajadores_html = "<ul>";
        while ($t = $result_trabajadores->fetch_assoc()) {
            $nombre_completo = $t['nombre'] . " " . $t['apellidos'];
            $contacto = " | " . $t['correo'] . " | " . $t['numero_telefonico'];
            $trabajadores_html .= "<li>" . htmlspecialchars($nombre_completo . $contacto) . "</li>";
        }
        $trabajadores_html .= "</ul>";
    } else {
        $trabajadores_html = "<p style='color:red;'>No se encontraron trabajadores para la operación</p>";
    }
} else {
    $trabajadores_html = "<p>ID de operación no válido (Valor: $id_operacion).</p>";
}

if (intval($id_operacion) > 0) {
    $query = "SELECT P.nombre, GP.cantidad, GP.consumido, P.medida, P.conservado, P.tipo, P.marca 
              FROM productos AS P 
              INNER JOIN grupo_productos AS GP ON GP.id_producto = P.id_producto 
              INNER JOIN grupos_productos AS GSP ON GSP.id_grupo_productos = GP.id_grupo_productos 
              INNER JOIN operacion AS O ON O.id_grupo_productos = GSP.id_grupo_productos 
              WHERE O.id_operacion = " . intval($id_operacion);

    $result_productos = $conn->query($query);

    if ($result_productos && $result_productos->num_rows > 0) {
        // Iniciamos la tabla con encabezados
        $productos_html = "
        <table class='tabla-productos'>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Unidades usadas</th>
                    <th>Total usado</th>
                    <th>Medida</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Conservado</th>
                </tr>
            </thead>
            <tbody>";

        while ($t = $result_productos->fetch_assoc()) {
            $productos_html .= "
                <tr>
                    <td>" . htmlspecialchars($t['nombre']) . "</td>
                    <td style='text-align: center;'>" . htmlspecialchars($t['cantidad']) . "</td>
                    <td>" . htmlspecialchars($t['total']) . "</td>
                    <td>" . htmlspecialchars($t['medida']) . "</td>
                    <td>" . htmlspecialchars($t['tipo']) . "</td>
                    <td>" . htmlspecialchars($t['marca']) . "</td>
                    <td>" . htmlspecialchars($t['conservado']) . "</td>
                </tr>";
        }
        $productos_html .= "</tbody></table>";
    } else {
        $productos_html = "<p style='color:red;'>No se encontraron productos para esta operación.</p>";
    }
}

if (intval($id_operacion) > 0) {
    $query = "SELECT M.id_material, M.nombre, GM.cantidad,  M.marca, GM.id_grupo_materiales 
              FROM material AS M INNER JOIN grupo_materiales AS GM ON GM.id_material = M.id_material 
              INNER JOIN grupos_materiales AS GSM ON GSM.id_grupo_materiales = GM.id_grupo_materiales 
              INNER JOIN operacion AS O ON O.id_grupo_materiales = GSM.id_grupo_materiales WHERE O.id_operacion = " . intval($id_operacion);

    $result_materiales = $conn->query($query);

    if ($result_materiales && $result_materiales->num_rows > 0) {
        // Iniciamos la tabla con encabezados
        $materiales_html = "
        <table class='tabla-productos'>
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Cantidad</th>
                    <th>Marca</th>
                </tr>
            </thead>
            <tbody>";

        while ($t = $result_materiales->fetch_assoc()) {
            $materiales_html .= "
                <tr>
                    <td>" . htmlspecialchars($t['nombre']) . "</td>
                    <td style='text-align: center;'>" . htmlspecialchars($t['cantidad']) . "</td>
                    <td>" . htmlspecialchars($t['marca']) . "</td>
                </tr>";
        }
        $materiales_html .= "</tbody></table>";
    } else {
        $materiales_html = "<p style='color:red;'>No se encontraron materiales para esta operación.</p>";
    }
}

require_once __DIR__ . '/../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true); 
$dompdf = new Dompdf($options);

$trabajo   = $_GET['trabajo']   ?? 'Sin datos';

$html = "
<html>
<head>
    <style>
        body { font-family: sans-serif; 
            font-size: 12px; 
            line-height: 1.4; 
            color: #333;
            }
        h1 { color: #333; text-align: center; }
        .tabla-productos {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 11px;
        }
        .tabla-productos th {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        .tabla-productos td {
            border: 1px solid #ddd;
            padding: 6px;
        }
        .tabla-productos tr:nth-child(even) {
            background-color: #fafafa;
        }
    </style>
</head>
<body>
    <h1>Reporte de Trabajo</h1>
    <div class='seccion'>
        <h4 class='label' style='margin-bottom: 2px;'>Datos del cliente:</h4>
        <p><span class='label'>Cliente:</span> $nombre $apellidos<br>
        <span class='label'>Dirección:</span> $direccion<br>
        <span class='label'>Entre calles:</span> $entre_calles<br>
        <span class='label'>Correo:</span> $correo<br>
        <span class='label'>Número telefónico:</span> $numero_telefonico
        </p>
    </div>
    <hr>
    <div class='seccion'>
        <h4 class='label'>Descrición:</h4>
        <p>$trabajo</p>
    </div>
    <hr>
    <div class='seccion'>
        <h4 class='label' style='margin-bottom: 2px;'>Nota: $titulo</h4>
        <span class='label'>Descripción:</span> $escrito<br>
        </p>
    </div>
    <hr>
    <div class='seccion'>
        <h4 class='label'>Trabajadores participantes:</h4>
        $trabajadores_html
    </div>
    <hr>
    <div class='seccion'>
        <h4>Inventario / Productos utilizados</h4>
        $productos_html
    </div>
    <div class='seccion'>
        <h4>Inventario / materiales utilizados</h4>
        $materiales_html
    </div>
</body>
</html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf_content = $dompdf->output();

if (headers_sent($file, $line)) {
    die("Las cabeceras ya se enviaron en $file en la línea $line. Por eso el PDF falla.");
}

header('Content-Type: application/pdf');
header('Content-Transfer-Encoding: binary');
header('Content-Disposition: inline; filename="reporte.pdf"');

$base64 = base64_encode($pdf_content);
echo "data:application/pdf;base64," . $base64;
exit;

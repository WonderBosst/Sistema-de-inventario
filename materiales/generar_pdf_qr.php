<?php
// 1. Iniciamos el buffer para evitar que cualquier Warning de PHP corrompa el PDF
ob_start();

// Asegúrate de cambiar esta ruta a donde hayas guardado la librería FPDF
require('../assets/fpdf186/fpdf.php'); 

// Validar que el código haya sido enviado
if (!isset($_GET['codigo']) || empty($_GET['codigo'])) {
    ob_end_clean(); // Limpiamos por si acaso antes de morir
    die("Error: Código de material no proporcionado.");
}

// Sanitizar los datos recibidos
$codigo = strip_tags($_GET['codigo']);
$nombre = isset($_GET['nombre']) ? strip_tags($_GET['nombre']) : 'N/A';
$marca  = isset($_GET['marca']) ? strip_tags($_GET['marca']) : 'N/A';

// API Pública para generar el QR en formato PNG
$url_qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($codigo);

// --- Configuración del PDF ---
$pdf = new FPDF('L', 'mm', array(100, 60)); 
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

// Dibujar un borde elegante para la etiqueta
$pdf->SetLineWidth(0.5);
$pdf->Rect(3, 3, 94, 54);

// Título / Encabezado
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(5, 6);
$pdf->Cell(90, 5, utf8_decode("CONTROL DE INVENTARIO"), 0, 1, 'C');
$pdf->Line(5, 13, 95, 13); // Línea divisoria

// Insertar el Código QR desde la API externa
// Nota: Forzamos la descarga del QR usando cURL o file_get_contents si el hosting bloquea peticiones directas de imagen
$pdf->Image($url_qr, 6, 16, 33, 33, 'PNG');

// Información del Material (Alineada al lado derecho del QR)
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(42, 18);
$pdf->Cell(20, 4, utf8_decode("CÓDIGO:"));
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(35, 4, utf8_decode($codigo));

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(42, 25);
$pdf->Cell(20, 4, "NOMBRE:");
$pdf->SetFont('Arial', '', 8);
// MultiCell por si el nombre del material es muy largo y requiere salto de línea
$pdf->SetXY(42, 29);
$pdf->MultiCell(52, 3.5, utf8_decode($nombre));

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(42, 42);
$pdf->Cell(20, 4, "MARCA:");
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(35, 4, utf8_decode($marca));

// 2. Limpiamos CUALQUIER espacio en blanco, aviso o eco accidental previo
if (ob_get_length()) {
    ob_end_clean();
}

// 3. Forzamos los encabezados limpios del PDF
header('Content-Type: application/pdf');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// Salida del PDF directamente al navegador
$pdf->Output('D', 'QR_' . $codigo . '.pdf');
exit;
?>
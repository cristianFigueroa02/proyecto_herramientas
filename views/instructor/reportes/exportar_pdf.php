<?php
require_once("../../../bd/database.php");
require_once("../../../fpdf.php"); // Incluir el archivo fpdf.php de la biblioteca FPDF

// Establecer conexión a la base de datos
$db = new Database();
$conectar = $db->conectar();
session_start();

if (!isset($_SESSION['documento'])) {
    header("Location: ../../../login.php"); // Redirigir a la página de inicio si no está logueado
    exit();
}

// Verificar si el documento está definido en la sesión
if (isset($_SESSION['documento'])) {
    $documento = $_SESSION['documento'];

    // Consultar información del usuario
    $usuarioQuery = $conectar->prepare("SELECT * FROM usuario WHERE documento = :documento");
    $usuarioQuery->bindParam(':documento', $documento);
    $usuarioQuery->execute();
    $usuario = $usuarioQuery->fetch();

    // Consultar reportes del usuario
    $usua = $conectar->prepare("SELECT * FROM reportes 
    INNER JOIN prestamos ON reportes.id_prestamo = prestamos.id_prestamo
    INNER JOIN usuario ON prestamos.documento = usuario.documento");
    $usua->execute();
    $asigna = $usua->fetchAll(PDO::FETCH_ASSOC);

    // Crear un nuevo objeto FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Establecer el título del documento
    $pdf->SetTitle('Reporte de Reportes');

    // Definir la fuente y el tamaño del texto
    $pdf->SetFont('Arial', '', 12);

    // Agregar encabezados de columna
    $pdf->Cell(30, 10, 'Numero de Reporte', 1);
    $pdf->Cell(50, 10, 'Documento', 1);
    $pdf->Cell(40, 10, 'Fecha Reporte', 1);
    $pdf->Cell(40, 10, 'Estado', 1);
    $pdf->Ln();

    // Agregar datos de la tabla a la hoja de cálculo
    foreach ($asigna as $usua) {
        $pdf->Cell(30, 10, $usua["id_reporte"], 1);
        $pdf->Cell(50, 10, $usua["documento"], 1);
        $pdf->Cell(40, 10, $usua["fecha_reporte"], 1);
        $pdf->Cell(40, 10, $usua["estado_reporte"], 1);
        $pdf->Ln();
    }

    // Establecer el nombre del archivo PDF para descargar
    $filename = 'reporte_reportes.pdf';

    // Descargar el archivo PDF
    $pdf->Output($filename, 'D');

    // Salir del script
    exit();
} else {
    // Manejo de error si 'documento' no está definido en la sesión
    echo "Error: El documento no está definido en la sesión.";
    exit();
}
?>

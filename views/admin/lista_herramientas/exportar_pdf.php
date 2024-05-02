<?php
require_once("../../../bd/database.php");
require_once("../../../fpdf.php"); // Ruta correcta hacia el archivo fpdf.php

$db = new Database();
$conectar = $db->conectar();
session_start();

if (!isset($_SESSION['documento'])) {
    header("Location: ../../../login.php"); // Redirigir a la página de inicio si no está logueado
    exit();
}

// Verifica si la clave 'documento' está definida en la sesión antes de usarla
if (isset($_SESSION['documento'])) {
    $documento = $_SESSION['documento'];

    $usuarioQuery = $conectar->prepare("SELECT * FROM usuario WHERE documento = :documento");
    $usuarioQuery->bindParam(':documento', $documento);
    $usuarioQuery->execute();
    $usuario = $usuarioQuery->fetch();

    $usua = $conectar->prepare("SELECT * FROM herrramienta,categoria WHERE herrramienta.id_cate = categoria.id_cate");
    $usua->execute();
    $asigna = $usua->fetchAll(PDO::FETCH_ASSOC);

    // Crear un nuevo objeto FPDF
    $pdf = new FPDF();

    // Agregar una página
    $pdf->AddPage();

    // Establecer la fuente
    $pdf->SetFont('Arial', '', 12);

    // Agregar encabezados de columna
    $pdf->Cell(40, 10, 'Nombre');
    $pdf->Cell(40, 10, 'Tipo de herramienta');
    $pdf->Cell(40, 10, 'Estado');
    $pdf->Cell(40, 10, 'Codigo de barras');
    $pdf->Ln(); // Nueva línea

    // Agregar datos de la tabla a la hoja de cálculo
    foreach ($asigna as $usua) {
        $pdf->Cell(40, 10, $usua["nombre_he"]);
        $pdf->Cell(40, 10, $usua["categoria"]);
        $pdf->Cell(40, 10, $usua["estado"]);
        $pdf->Cell(40, 10, $usua["codigo_barras"]);
        $pdf->Ln(); // Nueva línea
    }

    // Establecer el nombre del archivo PDF para descargar
    $filename = 'reporte_herramientas.pdf';

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

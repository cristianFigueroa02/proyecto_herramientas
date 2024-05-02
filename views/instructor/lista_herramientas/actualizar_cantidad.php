<?php
require_once("../../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();

// Obtener el ID de la herramienta y la cantidad enviados por AJAX
$idHerramienta = $_POST['id_herramienta'];
$cantidad = $_POST['cantidad'];

try {
    // Primera consulta: actualizar el campo `cantidad`
    $sqlCantidad = "UPDATE herrramienta SET cantidad = cantidad + :cantidad WHERE id_herramienta = :id_herramienta";

    // Preparar la consulta para `cantidad`
    $stmtCantidad = $conectar->prepare($sqlCantidad);

    // Bind de parámetros
    $stmtCantidad->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    $stmtCantidad->bindParam(':id_herramienta', $idHerramienta, PDO::PARAM_INT);

    // Ejecutar la consulta para `cantidad`
    $stmtCantidad->execute();

    // Segunda consulta: actualizar el campo `stock`
    $sqlStock = "UPDATE herrramienta SET stock = stock + :cantidad WHERE id_herramienta = :id_herramienta";

    // Preparar la consulta para `stock`
    $stmtStock = $conectar->prepare($sqlStock);

    // Bind de parámetros
    $stmtStock->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    $stmtStock->bindParam(':id_herramienta', $idHerramienta, PDO::PARAM_INT);

    // Ejecutar la consulta para `stock`
    $stmtStock->execute();


    echo "Cantidad actualizada correctamente.";
} catch (PDOException $e) {
    echo "Error al actualizar la cantidad: " . $e->getMessage();
}

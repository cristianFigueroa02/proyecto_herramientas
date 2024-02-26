<?php
require_once("../../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();


if (isset($_GET["id"])) {

    $activar = $_GET["id"];

    $nitQuery = $conectar->prepare("SELECT licencia FROM licencia WHERE licencia=?");
    $nitQuery->execute([$activar]);
    $nit = $nitQuery->fetch(PDO::FETCH_ASSOC); // Cambiado a fetch


    if ($nit) {

        // Se actualiza el estado de la licencia
        $updateSql = $conectar->prepare("UPDATE licencia SET estado = 'inactivo' WHERE licencia = ?");
        $updateSql->execute([$activar]);
        echo '<script>alert ("licencia desactivada");</script>';
        echo '<script> window.location= "lista_licencia.php"</script>';
    }
}
?>

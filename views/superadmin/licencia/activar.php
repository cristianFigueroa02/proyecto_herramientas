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

    // Obtener la fecha y hora actual
    $fecha_inicio = date('Y-m-d H:i:s');

    // Calcular la fecha y hora de finalización (agregando un año)
    $fecha_fin = date('Y-m-d H:i:s', strtotime('+1 year'));

    $estadoQuery = $conectar->prepare("SELECT estado FROM licencia WHERE estado='activo'");
    $estadoQuery->execute();
    $estado = $estadoQuery->fetch(PDO::FETCH_ASSOC);

    if ($estado) {
        echo '<script>alert ("la licencia esta activa");</script>';
        echo '<script> window.location= "lista_licencia.php"</script>'; 
    
    }
    else{
        $updateSqlinicio = $conectar->prepare("UPDATE licencia SET fecha_inicio = '$fecha_inicio' WHERE licencia = ?");
        $updateSqlinicio->execute([$activar]);

        $updateSqlinicio = $conectar->prepare("UPDATE licencia SET fecha_fin = '$fecha_fin' WHERE licencia = ?");
        $updateSqlinicio->execute([$activar]);

        // Se actualiza el estado de la licencia
        $updateSql = $conectar->prepare("UPDATE licencia SET estado = 'activo' WHERE licencia = ?");
        $updateSql->execute([$activar]);
        echo '<script>alert ("licencia activa.");</script>';
        echo '<script> window.location= "lista_licencia.php"</script>';
    }
}
?>

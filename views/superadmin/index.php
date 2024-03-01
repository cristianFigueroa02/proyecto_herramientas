<?php
require_once("../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();

// Verifica si la clave 'documento' está definida en la sesión antes de usarla
if (isset($_SESSION['documento'])) {
    $documento = $_SESSION['documento'];


    $usuarioQuery = $conectar->prepare("SELECT * FROM usuario WHERE documento = '$documento'");
    $usuarioQuery->execute();
    $usuario = $usuarioQuery->fetch();
} else {
    // Manejo de error si 'documento' no está definido en la sesión
    echo "Error: El documento no está definido en la sesión.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>limelight</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../../css/responsive.css">
    <!-- styles usuario -->
    <link rel="stylesheet" href="../../css/styles_superadmin.css">
    <!-- fevicon -->
    <link rel="icon" href="../../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body class="main-layout in_page">
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.html"><img src="../../images/Sena_Colombia_logo.svg.png" alt="#" /></a>
                                </div>
                                <h2 class="titulo_principal" style="color:#000;">Bienvenido SuperAdministrador <?= $usuario['nombre']; ?> </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="contenedor sombra">
        <div class="servicios" style="display: flex; justify-content:center">
            <a href="licencia/lista_licencia.php" class="enlace-servicio">
                <section class="servicio">
                    <h3 style="text-transform: uppercase;">licencia</h3>
                    <div class="iconos">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-palette" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M12 21a9 9 0 1 1 0 -18a9 8 0 0 1 9 8a4.5 4 0 0 1 -4.5 4h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                            <circle cx="7.5" cy="10.5" r=".5" fill="currentColor" />
                            <circle cx="12" cy="7.5" r=".5" fill="currentColor" />
                            <circle cx="16.5" cy="10.5" r=".5" fill="currentColor" />
                        </svg>
                    </div>
                    <p> Crea,activa y desactiva las licencias para las empresas </p>
                </section>
            </a>
            <a href="empresas/lista_empresa.php" class="enlace-servicio">
                <section class="servicio">
                    <h3 style="text-transform: uppercase;">Empresas</h3>
                    <div class="iconos">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trademark" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4.5 9h5m-2.5 0v6" />
                            <path d="M13 15v-6l3 4l3 -4v6" />
                        </svg>
                    </div>
                    <p> lista,creacion,actualizacion y eliminacion de empresas </p>
                </section>
            </a>
        </div>
    </main>
    <a href="cerrar_sesion.php" style="display: flex; justify-content:flex-end;">Cerrar sesión</a>
    <!-- footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class=" col-md-3 col-sm-6">
                        <ul class="social_icon">
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                        <p class="variat pad_roght2">There are many variat
                            ions of passages of L
                            orem Ipsum available
                            , but the majority h
                            ave suffered altera
                            tion in some form, by
                        </p>
                    </div>
                    <div class=" col-md-3 col-sm-6">
                        <h3>LET US HELP YOU </h3>
                        <p class="variat pad_roght2">There are many variat
                            ions of passages of L
                            orem Ipsum available
                            , but the majority h
                            ave suffered altera
                            tion in some form, by
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h3>INFORMATION</h3>
                        <ul class="link_menu">
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h3>OUR Design</h3>
                        <p class="variat">There are many variat
                            ions of passages of L
                            orem Ipsum available
                            , but the majority h
                            ave suffered altera
                            tion in some form, by
                        </p>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <p>© 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
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
    <link rel="stylesheet" href="../../css/styles_admin.css">
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
                                <h2 class="titulo-principal" style="color:#000;">Bienvenido administrador <?= $usuario['nombre']; ?> </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="contenedor sombra">
        <div class="servicios">
            <a href="prestamos/prestamos.php" class="enlace-servicio">
                <section class="servicio">
                    <h3 style="text-transform: uppercase;">prestamos</h3>
                    <div class="iconos">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-bank" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21l18 0" />
                            <path d="M3 10l18 0" />
                            <path d="M5 6l7 -3l7 3" />
                            <path d="M4 10l0 11" />
                            <path d="M20 10l0 11" />
                            <path d="M8 14l0 3" />
                            <path d="M12 14l0 3" />
                            <path d="M16 14l0 3" />
                        </svg>
                    </div>
                    <p> lista de prestamos y seguimiento </p>
                </section>
            </a>
            <a href="lista_herramientas/lista.php" class="enlace-servicio">
                <section class="servicio">
                    <h3 style="text-transform: uppercase;">Lista de herramientas</h3>
                    <div class="iconos">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" />
                        </svg>
                    </div>
                    <p> lista,creacion,actualizacion y eliminacion de herramientas </p>
                </section>
            </a><!-- Añadido el cierre de la etiqueta a -->
            <a href="#" class="enlace-servicio">
                <section class="servicio">
                    <h3 style="text-transform: uppercase;">Devoluciones</h3>
                    <div class="iconos">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-refund" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                            <path d="M15 14v-2a2 2 0 0 0 -2 -2h-4l2 -2m0 4l-2 -2" />
                        </svg>
                    </div>
                    <p> lista de devoluciones y reportes </p>
                </section>
            </a>

            <a href="roles/lista_roles.php" class="enlace-servicio">
                <section class="servicio">
                    <h3 style="text-transform: uppercase;">Roles</h3>
                    <div class="iconos">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                            <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                        </svg>
                    </div>
                    <p>lista,creacion,actualizacion y eliminacion de roles </p>
                </section>
            </a>
            <a href="instructores/lista_instructores.php" class="enlace-servicio">
                <section class="servicio">
                    <h3 style="text-transform: uppercase;">Lista de instructores</h3>
                    <div class="iconos">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                            <path d="M14 19l2 2l4 -4" />
                            <path d="M9 8h4" />
                            <path d="M9 12h2" />
                        </svg>
                    </div>
                    <p>lista,creacion,actualizacion y eliminacion de instructores </p>
                </section>
            </a> <!-- Añadido el cierre de la etiqueta a -->
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
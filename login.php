

<?php
require_once("bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();

//superadmin: 
//documento: 1107975322
//contraseña: $2y$15$nmOJkdLlTBmKk7gxu3zg1OpdsI5ufU8GuNdDJiEv15c4sMzQdKxXO

//admin: 
//documento: 171717
//constraseña: $2y$15$6r4pE4IwUlrwuydtZgvXaOfyBrShteuyG8FIN5cj9jhFeKC/IqL8y
// Verificamos que la contraseña sea correcta utilizando password_verify

if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formreg") {
    // Obtener datos del formulario
    $documento = $_POST["documento"];
    $contrasena = $_POST["contrasena"];




    $usuarioQuery = $conectar->prepare("SELECT * FROM usuario, licencia WHERE licencia.nit = usuario.nit AND licencia.estado = 'activo' AND documento = ?");
    $usuarioQuery->execute([$documento]);
    $usuario = $usuarioQuery->fetch();



    if ($usuario) {
 

        if (password_verify($contrasena, $usuario['contraseña'])) {


            if ($usuario['estado'] == "activo") {
                $_SESSION['documento'] = $usuario['documento'];
                $_SESSION['rol'] = $usuario['id_rol'];
                $_SESSION['estado'] = $usuario['estado'];

                var_dump($_SESSION); 





                if ($_SESSION['rol'] == 1) {
                    header("Location: views/admin/index.php");
                    exit();
                } elseif ($_SESSION['rol'] == 2) {
                    header("Location: views/usuario/index.php");
                    exit();
                } elseif ($_SESSION['rol'] == 3) {
                    header("Location: views/superadmin/index.php");
                    exit();
                }
                elseif ($_SESSION['rol'] == 4) {
                    header("Location: views/instructor/index.php");
                    exit();
                } else {
                    echo "<script> alert ('Su usuario está bloqueado');</script>";
                    echo '<script>window.location="index.html"</script>';
                    exit();
                }
            } else {
                echo "<script> alert ('La contraseña es incorrecta o no esta activa tu licencia');</script>";
                echo '<script>window.location="index.html"</script>';
                exit();
            }
        } 
    }
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
    <title>SENA</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
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
                                    <a href="index.html"><img src="images/Sena_Colombia_logo.svg.png" alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.html">Principal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html">Contactanos</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="login.php">login</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="registro.php">Registro</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div style="margin-bottom:50px;" class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Iniciar Sesión</h4>
                            <!-- Formulario -->
                            <form name="formreg" method="POST">
                                <div class="form-group">
                                    <label for="documento">Documento</label>
                                    <input type="text" class="form-control" id="documento" name="documento" placeholder="Ingresa tu documento">
                                </div>
                                <div class="form-group">
                                    <label for="contrasena">Contraseña</label>
                                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña">
                                </div>
                                <input type="hidden" name="MM_insert" value="formreg">
                                <button type="submit" class="btn btn-success btn-block">Iniciar sesion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class=" col-md-3 col-sm-6">
                        <ul class="social_icon">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
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
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html"> About</a></li>
                            <li><a href="service.html">Services</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="testimonial.html">Testimonial</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
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
                    <div class="col-md-6 offset-md-6">
                        <form id="hkh" class="bottom_form">
                            <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                            <button class="sub_btn">subscribe</button>
                        </form>
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
    <script src="js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
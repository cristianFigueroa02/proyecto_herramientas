<?php
require_once("../../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();

$tip_docQuery = $conectar->prepare("SELECT id_tip_doc,tipo_doc FROM tip_doc");
$tip_docQuery->execute();
$tiposdoc = $tip_docQuery->fetchAll(PDO::FETCH_ASSOC);

$tip_jorQuery = $conectar->prepare("SELECT id_jornada,jornada FROM jornada");
$tip_jorQuery->execute();
$tiposjor = $tip_jorQuery->fetchAll(PDO::FETCH_ASSOC);

$tip_forQuery = $conectar->prepare("SELECT id_formacion,formacion FROM formacion");
$tip_forQuery->execute();
$tiposfor = $tip_forQuery->fetchAll(PDO::FETCH_ASSOC);

$empresaQuery = $conectar->prepare("SELECT nit,nombre_empre FROM empresa");
$empresaQuery->execute();
$empresa = $empresaQuery->fetchAll(PDO::FETCH_ASSOC);



if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formreg") {
    // Obtener datos del formulario
    $documento = $_POST["documento"];
    $contrasena = $_POST["contrasena"];
    $nombre = $_POST["nombre"];
    $id_tip_doc = $_POST["id_tip_doc"];
    $email = $_POST["email"];
    $nit = $_POST["nit"];
    $tyc = $_POST["tyc"];


    $validar = $conectar->prepare("SELECT * FROM `usuario` WHERE documento = '$documento'");
    $validar->execute();
    $fila1 = $validar->fetch();

    if ($documento == "" || $nombre == "" || $contrasena == ""|| $nit == "" ) {
        echo '<script>alert("EXISTEN CAMPOS VACÍOS");</script>';
        echo '<script>window location="regis.php"</script>';
    } else if ($tyc == "") {
        echo '<script>alert("Debes aceptar los terminos y condiciones");</script>';
        echo '<script>window location="regis.php"</script>';
    } elseif ($fila1) {
        echo '<script>alert("DOCUMENTO O NOMBRE YA EXISTEN, POR FAVOR, CAMBIELOS");</script>';
        echo '<script>window.location="regis.php"</script>';
    } else {
        $encriptar = password_hash($contrasena, PASSWORD_BCRYPT, ["cost" => 15]);

        // Ajusta la consulta para insertar en tu nueva tabla
        $insertsql = $conectar->prepare("INSERT INTO `usuario` (`documento`, `contraseña`, `nombre`, `id_tip_doc`, `email`, `id_rol`, `estado`, `nit`, `tyc`) 
    VALUES (:documento, :contrasena, :nombre, :id_tip_doc, :email, 4, 'activo',:nit,:tyc)");

        $insertsql->bindParam(':documento', $documento);
        $insertsql->bindParam(':contrasena', $encriptar);
        $insertsql->bindParam(':nombre', $nombre);
        $insertsql->bindParam(':id_tip_doc', $id_tip_doc);
        $insertsql->bindParam(':email', $email);
        $insertsql->bindParam(':nit', $nit);
        $insertsql->bindParam(':tyc', $tyc);

        $insertsql->execute();


        echo '<script>alert("Registro exitoso, gracias");</script>';
        echo '<script>window.location="lista_instructores.php"</script>';
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
    <title>limelight</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../../../css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../../../css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../../../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../../../css/jquery.mCustomScrollbar.min.css">
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
        <header>
            <!-- header inner -->
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <a href="index.html"><img src="../../../images/Sena_Colombia_logo.svg.png" alt="#" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container mt-5">
                <form method="post" action="" autocomplete="off">
                    <div class="form-group">
                        <label for="documento">Documento:</label>
                        <input type="text" class="form-control" id="documento" name="documento" required>
                    </div>
                    <div class="form-group">
                        <label for="id_tip_doc">Tipo de documento:</label>
                        <select class="form-control" id="id_tip_doc" name="id_tip_doc" required>
                            <option value="" disabled selected>Selecciona el tipo de documento</option> <!-- Placeholder -->
                            <?php foreach ($tiposdoc as $tipo) : ?>
                                <option value="<?php echo $tipo['id_tip_doc']; ?>"><?php echo $tipo['tipo_doc']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="nit">Empresa:</label>
                        <select class="form-control" id="nit" name="nit" required>
                            <option value="" disabled selected>seleccoiona la empresa</option> <!-- Placeholder -->
                            <?php foreach ($empresa as $empresas) : ?>
                                <option value="<?php echo $empresas['nit']; ?>"><?php echo $empresas['nombre_empre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="tyc" value="si">
                            <a href="#">Acepto los términos y condiciones</a>
                        </label>
                    </div>
                    <input type="hidden" name="MM_insert" value="formreg" >
                    <button type="submit" class="btn btn-success">Registrarme</button>
                </form>
                <a href="lista_instructores.php" class="btn btn-danger" style="margin:10px auto">Cancelar</a>
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
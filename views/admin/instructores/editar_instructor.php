<?php
require_once("../../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();


if (isset($_GET['id'])) {
    // Recupera el ID de la URL
    $id = $_GET['id'];

    $validar = $conectar->prepare("SELECT * FROM usuario,empresa WHERE usuario.nit=empresa.nit AND documento = ?");
    $validar->execute([$id]);
    $usuario = $validar->fetch();
    
    $tiposherrasQuery = $conectar->prepare("SELECT nit,nombre_empre FROM empresa");
    $tiposherrasQuery->execute();
    $tiposherra = $tiposherrasQuery->fetchAll(PDO::FETCH_ASSOC);


    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $empresa = $_POST['empresa'];
        $telefono = $_POST['telefono'];

        // Prepare and execute the update query
        $updateQuery = $conectar->prepare("UPDATE usuario SET nombre = ?,email = ?,nit = ? WHERE documento = ?");
        $updateQuery->execute([$nombre, $email, $empresa, $id]);
        // Redirect to the page displaying the updated data or any other desired location
        header("Location: lista_instructores.php");
        exit();
    }

    // Retrieve existing data for the selected record
    else {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../../../css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../../../css/responsive.css">
    <!-- styles usuario -->
    <link rel="stylesheet" href="../../../css/styles_usuario.css">
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
    </header> <!-- ... (your existing body content) ... -->

    <section class="section">
        <div class="container my-5">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h2>Actualizar Empresa</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="nombre">NIT de la empresa:</label>
                            <input type="text" class="form-control" value="<?php echo $usuario['documento']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de la empresa:</label>
                            <input type="text" class="form-control" value="<?php echo $usuario['nombre']; ?>" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Direccion:</label>
                            <input type="text" class="form-control" value="<?php echo $usuario['email']; ?>" id="direccion" name="email" required>
                        </div>
                        <label for="tipo">empresa:</label>
                        <select class="form-control" id="empresa" name="empresa">
                            <option value="" disabled>Selecciona empresa</option> <!-- Placeholder -->
                            <?php foreach ($tiposherra as $tipoherra) : ?>
                                <option value="<?php echo $tipoherra['nit']; ?>" <?php if ($tipoherra['nit'] == $usuario['nit']) echo 'selected'; ?>>
                                    <?php echo $tipoherra['nombre_empre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                </div>


                <button type="submit" class="btn btn-success" style="margin-top:1rem; margin-left:1.6em;">Actualizar</button>
                </form>
            </div>
        </div>
        </div>
    </section>
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

<!-- ... (your existing script imports) ... -->

<!-- ... (your existing script content) ... -->
</body>

</html>
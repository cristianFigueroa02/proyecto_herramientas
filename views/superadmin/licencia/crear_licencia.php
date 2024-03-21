<?php
require_once("../../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();

$empresaQuery = $conectar->prepare("SELECT nit, nombre_empre FROM empresa");
$empresaQuery->execute();
$empresas = $empresaQuery->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formreg") {
    $id_licencia = $_POST["id_licencia"];
    $nit = $_POST["nit"];
    $licencia = uniqid();
    $fecha_inicio = date('Y-m-d H:i:s');
    $fecha_fin = date('Y-m-d H:i:s', strtotime('+1 year'));

    if ($nit == "") {
        echo '<script>alert("EXISTEN CAMPOS VACÍOS");</script>';
        echo '<script>window location="crear_licencia.php"</script>';
    } else {
        // Verificar si la empresa asociada al NIT existe en la base de datos
        $empresaExists = false;
        $empresaQuery = $conectar->prepare("SELECT nit FROM empresa WHERE nit = ?");
        $empresaQuery->execute([$nit]);
        $empresa = $empresaQuery->fetch(PDO::FETCH_ASSOC);
        
        if ($empresa) {
            // Verificar si la empresa ya tiene una licencia activa
            $licenciaQuery = $conectar->prepare("SELECT COUNT(*) AS count FROM licencia WHERE nit = ? AND estado = 'activo'");
            $licenciaQuery->execute([$nit]);
            $licenciaCount = $licenciaQuery->fetch(PDO::FETCH_ASSOC)['count'];
            
            if ($licenciaCount > 0) {
                echo '<script>alert("La empresa ya tiene una licencia activa");</script>';
                echo '<script>window.location="crear_licencia.php"</script>';
            } else {
                $insertsql = $conectar->prepare("INSERT INTO licencia (id_licencia, licencia, estado, fecha_inicio, fecha_fin, nit) VALUES (?, ?, 'activo', ?, ?, ?)");
                $insertsql->execute([$id_licencia, $licencia, $fecha_inicio, $fecha_fin, $nit]);
                echo '<script>alert("Licencia activa con éxito");</script>';
                echo '<script>window.location="lista_licencia.php"</script>';
            }
        } else {
            echo '<script>alert("La empresa asociada al NIT ingresado no existe en la base de datos");</script>';
            echo '<script>window.location="crear_licencia.php"</script>';
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
    </header>
    <main>
        <div class="container mt-5">
            <form method="post" action="" autocomplete="off">
                <div class="form-group">
                    <div class="form-group">
                        <label for="nit">ID licencia</label>
                        <input type="number" id="id_licencia" name="id_licencia" class="form-control" required>
                    </div>
                    <label for="id_tip_doc">Empresa:</label>
                    <select class="form-control" id="nit" name="nit" required>
                        <option value="" disabled selected>Selecciona la empresa</option> <!-- Placeholder -->
                        <?php foreach ($empresas as $tipo) : ?>
                            <option value="<?php echo $tipo['nit']; ?>"><?php echo $tipo['nombre_empre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="MM_insert" value="formreg">
                    <button type="submit" class="btn btn-success" style="margin-top: 10px;">Registrarme</button>
            </form>
        </div>
    </main>
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
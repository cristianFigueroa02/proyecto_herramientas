<?php
require_once("../../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();

if (!isset($_SESSION['documento'])) {
    header("Location: ../../../login.php"); // Redirigir a la página de inicio si no está logueado
    exit();
}
$tip_forQuery = $conectar->prepare("SELECT id_formacion,formacion FROM formacion");
$tip_forQuery->execute();
$tiposfor = $tip_forQuery->fetchAll(PDO::FETCH_ASSOC);

$tip_docQuery = $conectar->prepare("SELECT * FROM usuario INNER JOIN rol ON usuario.id_rol = rol.id_rol WHERE rol.id_rol = 4");
$tip_docQuery->execute();
$tiposdoc = $tip_docQuery->fetchAll(PDO::FETCH_ASSOC);



if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formreg") {
    // Obtener datos del formulario
    $documento = $_POST["documento"];
    $ficha = $_POST["id_relacionados"];

    if ($documento == "" || $ficha == "") {
        echo '<script>alert("EXISTEN CAMPOS VACÍOS");</script>';
        echo '<script>window location="asignacion_instructor.php"</script>';
    } else {

        $insertdeta = $conectar->prepare("INSERT INTO detalle_usuarios(documento,ficha) VALUES (?, ?)");
        $insertdeta->execute([$documento, $ficha]);

        echo '<script>alert ("Registro Exitoso");</script>';
        echo '<script> window.location= "lista_instructores.php"</script>';
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
                        <label for="documento">Nombre instructor:</label>
                        <select class="form-control" id="documento" name="documento" required>
                            <option value="" disabled selected>Selecciona el instructor</option> <!-- Placeholder -->
                            <?php foreach ($tiposdoc as $tipo) : ?>
                                <option value="<?php echo $tipo['documento']; ?>"><?php echo $tipo['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formacion">Formación:</label>
                        <select class="form-control" id="formacion" name="formacion">
                            <option value="" disabled selected>Selecciona la formación</option>
                            <?php
                            // Obtener valores únicos de formación
                            $formaciones = array_unique(array_column($tiposfor, 'formacion'));

                            // Imprimir opciones
                            foreach ($formaciones as $formacion) {
                                echo "<option value='$formacion'>$formacion</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_relacionados">Ficha:</label>
                        <select class="form-control" id="id_relacionados" name="id_relacionados">
                            <!-- Aquí se cargarán los elementos filtrados dinámicamente -->
                        </select>
                    </div>


                    <script>
                        var formacionSelect = document.getElementById("formacion");
                        var relacionadosSelect = document.getElementById("id_relacionados");
                        var jornadaSelect = document.getElementById("jornada");
                        var datos = <?php echo json_encode($tiposfor); ?>;

                        formacionSelect.addEventListener("change", actualizarFichas);
                        relacionadosSelect.addEventListener("change", actualizarJornada);

                        function actualizarFichas() {
                            var selectedFormacion = formacionSelect.value;
                            relacionadosSelect.innerHTML = ''; // Limpiar las opciones existentes

                            // Filtrar las fichas correspondientes a la formación seleccionada
                            var fichas = datos.filter(function(item) {
                                return item.formacion === selectedFormacion;
                            });

                            // Llenar el campo de selección "Ficha" con las fichas correspondientes
                            fichas.forEach(function(item) {
                                var option = document.createElement("option");
                                option.text = item.id_formacion;
                                option.value = item.id_formacion;
                                relacionadosSelect.add(option);
                            });

                            // Actualizar la jornada al valor de la ficha seleccionada
                            actualizarJornada();
                        }

                        function actualizarJornada() {
                            var selectedIdFormacion = relacionadosSelect.value;

                            // Buscar la jornada correspondiente al id_formacion seleccionado
                            var jornada = datos.find(function(item) {
                                return item.id_formacion === selectedIdFormacion;
                            }).jornada;

                            // Mostrar la jornada en el campo de selección "Jornada"
                            jornadaSelect.value = jornada;
                        }
                    </script>

                    <input type="hidden" name="MM_insert" value="formreg">
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
                            <h3>variedad</h3>
                            <p class="variat pad_roght2">Ofrecemos una amplia variedad de herramientas
                                de alta calidad para satisfacer todas tus necesidades de
                                construcción.Tenemos todo lo que necesitas para completar
                                tus proyectos con éxito.
                            </p>
                        </div>
                        <div class=" col-md-3 col-sm-6">
                            <h3>dejanos ayudarte </h3>
                            <p class="variat pad_roght2">Nuestro objetivo es facilitarte el acceso a las herramientas
                                que necesitas para tus proyectos. Con nuestro proceso de préstamo simple y transparente,
                                puedes obtener las herramientas adecuadas sin complicaciones ni demoras.
                            </p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h3>NUESTRO DISEÑO</h3>
                            <p class="variat">En nuestra empresa, nos esforzamos por ofrecer un diseño intuitivo
                                y fácil de usar en todas nuestras plataformas. Nuestra interfaz está diseñada
                                pensando en la comodidad y la accesibilidad del usuario.
                            </p>
                        </div>
                        <div class="col-md-6 offset-md-6">
                            <form id="hkh" class="bottom_form">
                                <input class="enter" placeholder="" type="text" name="Enter your email">
                                <button class="sub_btn">Prestamos de herramientas</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <p>© 2019 All Rights Reserved. Design by <a href="https://html.design/"> Cristian Figueroa</a></p>
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
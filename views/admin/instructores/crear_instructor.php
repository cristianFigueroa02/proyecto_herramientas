<?php
require_once("../../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();


if (!isset($_SESSION['documento'])) {
    header("Location: ../../../login.php"); // Redirigir a la página de inicio si no está logueado
    exit();
}
$tip_docQuery = $conectar->prepare("SELECT id_tip_doc,tipo_doc FROM tip_doc");
$tip_docQuery->execute();
$tiposdoc = $tip_docQuery->fetchAll(PDO::FETCH_ASSOC);

$tip_forQuery = $conectar->prepare("SELECT id_formacion,formacion FROM formacion");
$tip_forQuery->execute();
$tiposfor = $tip_forQuery->fetchAll(PDO::FETCH_ASSOC);

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
<style>
    .formulario {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 400px;
    }

    .formulario__grupo {
        margin-bottom: 20px;
    }

    .formulario__label {
        display: block;
        margin-bottom: 5px;
    }

    .formulario__input {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .formulario__input:focus {
        outline: none;
        border-color: #66afe9;
    }

    .formulario__input-error {
        display: none;
        color: #d9534f;
        font-size: 12px;
        margin-top: 5px;
    }

    .formulario__grupo-incorrecto .formulario__input {
        border-color: #d9534f;
    }

    .formulario__grupo-incorrecto .formulario__input-error {
        display: block;
    }

    .formulario__grupo-correcto .formulario__input {
        border-color: #5cb85c;
    }

    .formulario__btn {
        background-color: #5cb85c;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .formulario__btn:hover {
        background-color: #4cae4c;
    }
</style>

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
            <div style="margin-bottom:50px;" class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Registro</h4>

                                <form id="formulario" method="post" autocomplete="off">
                                    <div class="formulario__grupo" id="grupo__documento">
                                        <label for="documento" class="formulario__label">Documento:</label>
                                        <input type="text" class="formulario__input" id="documento" name="documento" required>
                                        <p class="formulario__input-error">El documento debe contener de 6 a 11 digitos.</p>
                                    </div>

                                    <div class="formulario__grupo" id="grupo__contrasena">
                                        <label for="contrasena" class="formulario__label">Contraseña:</label>
                                        <input type="password" class="formulario__input" id="contrasena" name="contrasena" required>
                                        <p class="formulario__input-error">La contraseña debe tener entre 8 y 12 caracteres.</p>
                                    </div>

                                    <div class="formulario__grupo" id="grupo__nombre">
                                        <label for="nombre" class="formulario__label">Nombres y apellidos:</label>
                                        <input type="text" class="formulario__input" id="nombre" name="nombre" required>
                                        <p class="formulario__input-error">El nombre debe ser válido.</p>
                                    </div>

                                    <div class="formulario__grupo" id="grupo__email">
                                        <label for="email" class="formulario__label">Email:</label>
                                        <input type="email" class="formulario__input" id="email" name="email" required>
                                        <p class="formulario__input-error">El email debe ser válido.</p>
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
                                        <label for="formacion">Formación:</label>
                                        <select class="form-control" id="formacion" name="formacion">
                                            <option value="" disabled selected>Selecciona su formación</option>
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

                                    <div class="form-group">
                                        <label for="jornada">Jornada:</label>
                                        <select class="form-control" id="jornada" name="id_jornada" required>
                                            <option value="" disabled selected>Selecciona una jornada</option>
                                            <option value="mañana">Mañana</option>
                                            <option value="tarde">Tarde</option>
                                            <option value="noche">Noche</option>
                                        </select>
                                    </div>

                                    <div class="formulario__grupo">
                                        <label>
                                            <input type="checkbox" name="tyc" id="tyc" value="si" required>
                                            Acepto los términos y condiciones
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-success" style="margin-bottom: 10px;">Registrarme</button>
                                    <a href="lista_instructores.php" class="btn btn-danger">Regresar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
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
        <script src="validacion.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.0.0.min.js"></script>
        <!-- sidebar -->
        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/custom.js"></script>
</body>

</html>
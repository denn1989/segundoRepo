<?php
session_start();

if (isset($_SESSION['NOMBRE'])) {
    $nombre = $_SESSION['NOMBRE'];
} else {
    header('Location: ../index.php'); //Aqui lo redireccionas al lugar que quieras.
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&display=swap" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>

<body class="teal lighten-4">
    <div class="row">
        <?php
        include_once 'sideNav.php';
        include_once '../servidor/modulos/residencias.php';
        ?>
        <div class="row">
            <div class="col m2">

            </div>

            <div class="col m9 ">
                <div class="row">
                    <div class="TargetsResidentes">

                    </div>





                    <?php

                    // $elementos = new Residencia();

                    // $elementos->obtenerResidentes();

                    ?>


                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="RESIDENTES_VER" class="modal">

    </div>

    <div id="RESIDENTES_MOD" class="modal">


    </div>



    <div id="CONFIRMAR_DEL_RES" style="width:24rem !important" class="modal">

    </div>


    <div id="CONFIRMAR_MOD_RES" style="width:24rem" class="modal">

    </div>

    <?php
    include_once 'footer.php';
    ?>
    <!-- Compiled and minified JavaScript -->
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    </script>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/initialization.js"></script>
    <script type="text/javascript" src="js/tarjetaResidencia.js"></script>

   







</body>




</html>

<style>
    * {
        font-family: 'Atkinson Hyperlegible', sans-serif;
    }
</style>
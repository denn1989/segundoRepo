<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Document</title>
</head>

<body class="teal lighten-4">
    <div class="row">
        <?php
        include_once 'sideNav.php';
        ?>

        <div class="row">
            <div class="col m2">
                <a class="waves-effect waves-light btn modal-trigger teal darken-1" style="margin-top: 8px;" href="#ASESORES">
                    <div class="row">
                        <div class="col m2"><i class="material-icons" style="font-size: 2rem;">add</i></div>
                        <div class="col m10">
                            Asesor externo
                        </div>
                    </div>
                </a>

            </div>

            <div class="col m9">
                <div class="targetAsesores">

                </div>

                <div class="asesoresInt">

                </div>

            </div>
        </div>
    </div>

    <?php
    include_once 'footer.php';
    ?>


    <div id="ASESORES" class="modal" style="width: 400px">
        <div class="row">
            <form id="INSERTAR_ASESOR_EXT">
                <div class="row modal-content">
                    <h5 class="center-align">AÑADIR ASESOR</h5>

                    <div class="input-field col m12 ">
                        <input name="NOMBRE" type="text" class="validate">
                        <label for="NOMBRE"> Nombre</label>
                    </div>


                    <div class="input-field col m6">
                        <input name="APELLIDO_PATERNO" type="text" class="validate">
                        <label for="APELLIDO_PATERNO"> Apellido paterno</label>
                    </div>

                    <div class="input-field col m6">
                        <input name="APELLIDO_MATERNO" type="text" class="validate">
                        <label for="APELLIDO_MATERNO"> Apellido materno</label>

                    </div>

                    <div class="input-field col m12">
                        <input name="ESPECIALIDAD" type="text" class="validate">
                        <label for="ESPECIALIDAD"> Especialidad </label>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" href="" class="modal-close waves-effect waves-green btn-flat">Añadir</button>
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                </div>
        </div>
        </form>
    </div>
    </div>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="js/initialization.js"></script>
    <script type="text/javascript" src="js/insertarAsesorExt.js"></script>
    <script type="text/javascript" src="js/tarjetaAsesor.js"></script>
    <script type="text/javascript" src="js/eliminarAsesores.js"></script>
</body>

</html>

<style>
    * {
        font-family: 'Atkinson Hyperlegible', sans-serif;
    }
</style>
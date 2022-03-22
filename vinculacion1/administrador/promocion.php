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
    <?php
    include_once 'sideNav.php';
    ?>
    <div class="row">
        <div class="col m2">
            <a class="waves-effect waves-light btn modal-trigger" href="#estudiantePromocion" style="width: 12rem">Añadir promocion</a>

        </div>

        <div class="col m9 ">
            <div class="row">
                <div class="TargetsPromocion">

                </div>
            
                </div>


                <?php
                include_once 'footer.php';

                ?>
                <div id="estudiantePromocion" class="modal">
                    <div class="row">
                        <form class="col m12" id="INSERTAR_PROMOCION">
                            <div class="row modal-content">
                                <h5>Estudiante Bachiller</h5>

                                <div class="input-field col m4">
                                    <input name="NOMBRE" type="text" class="validate">
                                    <label for="NOMBRE">Nombre (s)</label>
                                </div>

                                <div class="input-field col m4">
                                    <input name="APELLIDO" type="text" class="validate">
                                    <label for="APELLIDO">Apellido</label>
                                </div>

                                <div class="input-field col m4">
                                    <input name="LENGUA" type="text" class="validate">
                                    <label for="LENGUA">Lengua</label>
                                </div>

                                <div class="input-field col m4">
                                    <input name="LUGAR_NACIMIENTO" type="text" class="validate">
                                    <label for="LUGAR_NACIMIENTO">Lugar de nacimiento</label>
                                </div>

                                <div class="input-field col m4">
                                    <input name="LUGAR_RESIDENCIA" type="text" class="validate">
                                    <label for="LUGAR_RESIDENCIA">Lugar de residencia</label>
                                </div>

                                <div class="input-field col m4">
                                    <select name="CICLO_ESCOLAR">
                                        <option value="0" disabled selected>Ciclo Escolar</option>
                                        <option value="2020-2021">2020-2021</option>
                                        <option value="2021-2O22">2021-2O22</option>
                                        <option value="2022-2O23">2022-2O23</option>
                                    </select>
                                    <label for="CICLO_ESCOLAR">Ciclo Escolar</label>
                                </div>

                                <div class="input-field col m6">
                                    <input name="CARRERA_PROP" type="text" class="validate">
                                    <label for="CARRERA_PROP">Carrera propuesta de interés</label>
                                </div>


                                <div class="input-field col m6">
                                    <select name="ESCUELA_BACHILLER">
                                        <option value="0" disabled selected>Escuela Bachiller</option>
                                        <?php
                                        include_once '../servidor/modulos/escuelaBachiller.php';

                                        $ESCUELA = new EscuelaBachiller();

                                        $ESCUELA->selectEscuela();
                                        ?>

                                    </select>
                                    <label for="ESCUELA_BACHILLER">Seleccione la escuela</label>
                                </div>

                                <div class="input-field col m6">
                                    <select name="CARRERA">
                                        <option value="0" disabled selected>Carrera</option>
                                        <?php
                                        include_once '../servidor/modulos/promocion.php';

                                        $promocion = new Promocion();

                                        $prom = $promocion->selectCarrera();
                                        ?>

                                    </select>
                                    <label for="CARRERA">Seleccione carrera de interés</label>
                                </div>

                            </div>
                    

                    <div class="modal-footer" style="margin: 0px">

                        <button type="submit" class="modal-close waves-effect waves-green btn-flat">Añadir</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div id="CONFIRMAR_ELIMINAR_PROMOCION" style="width:24rem" class="modal">

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="js/initialization.js"></script>
        <script type="text/javascript" src="js/insertarPromocion.js"> </script>
        <script type="text/javascript" src="js/tarjetaPromocion.js"></script>
</body>

</html>




<style>
    .btn {
        margin-top: 20px;
    }

    * {
        font-family: 'Atkinson Hyperlegible', sans-serif;
    }
</style>
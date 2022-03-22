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
            <div class="col m2 center-align">
                <a class="waves-effect waves-light btn modal-trigger teal darken-1" style="margin-top: 1rem" href="#empresas">Añadir empresa</a>
            </div>

            <div class="col m9">
                <div class="row">
                    <div class="targetEmpresas">

                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php
    include_once 'footer.php';
    ?>

    <div id="empresas" class="modal" style="width: 500px">
        <div class="row">
            <form id="INSERTAR_EMPRESA">
                <div class="row modal-content">
                    <h5 class="center-align">Empresa</h5>

                    <div class="input-field col m12 ">
                        <input name="EMPRESA" type="text" class="validate">
                        <label for="EMPRESA"> Empresa </label>
                    </div>


                    <div class="input-field col m6">
                        <input name="ENCARGADO" type="text" class="validate">
                        <label for="ENCARGADO"> Encargado </label>
                    </div>

                    <div class="input-field col m6">
                        <input name="TELEFONO" type="text" class="validate">
                        <label for="TELEFONO"> Telefono</label>

                    </div>

                    <div class="input-field col m12">
                        <input name="DIRECCION" type="text" class="validate">
                        <label for="DIRECCION"> Dirección </label>

                    </div>

                    <div class="input-field col m6">
                        <input name="CORREO" type="email" class="validate">
                        <label for="CORREO"> Correo electrónico </label>

                    </div>

                    <div class="input-field col m3">
                        <select name="SECTOR">

                            <option value="0" disabled selected>SECTOR</option>

                            <option value="Público">Público</option>
                            <option value="Social">Social</option>
                            <option value="Privado">Privado</option>
                        </select>

                    </div>

                    <div class="input-field col m3">
                        <select name="TIPO">

                            <option value="0" disabled selected>TIPO</option>

                            <option value="Nacional">Nacional</option>
                            <option value="Internacional">Internacional</option>
                        </select>

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



    <div id="CONFIRMAR_ELIMINAR_EMPRESA" style="width:24rem !important" class="modal">
        
    </div>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="js/initialization.js"></script>
    <script type="text/javascript" src="js/insertarEmpresa.js"></script>
    <script type="text/javascript" src="js/tarjetaEmpresa.js"></script>
    <script type="text/javascript" src="js/eliminarEmpresa.js"></script>
</body>

</html>

<style>
    * {
        font-family: 'Atkinson Hyperlegible', sans-serif;
    }
</style>
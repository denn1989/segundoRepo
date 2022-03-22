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

            </div>

            <div class="col m9">
                <div class="row">
                    <div class="targetsConvenios">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
    include_once 'footer.php';
    ?>

    <div id="CONFIRMAR_ELIMINAR_CONVENIO" style="width:24rem" class="modal">
        
    </div>



    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="js/initialization.js"></script>
    <script type="text/javascript" src="js/tarjetaConvenio.js"></script>
    <script type="text/javascript" src="js/eliminarConvenio.js"></script>
</body>

</html>

<style>
    * {
        font-family: 'Atkinson Hyperlegible', sans-serif;
    }
</style>
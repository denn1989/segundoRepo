<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Document</title>
</head>

<body class="teal lighten-4">

    <?php
    include_once 'sideNav.php';
    ?>
    <div class="row">
        <div class="col m1">

        </div>

        <div class="col m10">
            <div class="row">
                <div class="col m6">
                    <canvas id="LUGAR_NACIMIENTO" width="300" height="200"></canvas>
                </div>

                <div class="col m6">
                    <canvas id="LUGAR_RESIDENCIA" width="300" height="200"></canvas>
                </div>

                <div class="col m6">
                    <canvas id="LENGUA" width="300" height="200"></canvas>
                </div>

                <div class="col m6">
                    <canvas id="CARRERA_PROPUESTA" width="300" height="200"></canvas>
                </div>
                <div class="col m1">
                    <canvas id="CARRERA_PROPUESTA" width="300" height="200"></canvas>
                </div>


                <div class="col m10">
                    <canvas id="CARRERA_VIGENTE" width="500" height="200"></canvas>
                </div>




            </div>
        </div>

        <div class="col m1">

        </div>
    </div>


    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="js/initialization.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="js/graficas.js"></script>

</body>

</html>
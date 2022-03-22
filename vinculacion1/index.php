<?php
session_start();

if (isset($_SESSION['NOMBRE']) || !empty($_SESSION['NOMBRE'])) {
    header('location: /vinculacion1/administrador');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <title>Document</title>
</head>

<body class="teal lighten-4">

    <div class="row">
        <div class="col m4"></div>
        <div class="col m4">

            <div class="card teal lighten-5 " style="margin-top: 120px">
                <div class="card-content ">
                    <div class="container">

                        <div class="row">
                            <div class="col m12">
                                <img src="./administrador/img/logo.png" alt="" class="responsive-img" style="width: 60%; margin-left:45px; margin-bottom: 10px;">
                            </div>

                            <div class="col m12 center-align">
                                <form action="" id="LOG_USUARIO">
                                    <input type="text" placeholder="usuario" name="USERNAME" style="margin-bottom: 20px;" class="teal-text text-darken-4">
                                    <input type="password" placeholder="password" name="PASSWORD" style="margin-bottom: 20px;" class="teal-text text-darken-4">

                                    <button class="btn teal darken-4" type="submit">ingresar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col m4"></div>
    </div>




    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="js/acceso.js"></script>
</body>

</html>
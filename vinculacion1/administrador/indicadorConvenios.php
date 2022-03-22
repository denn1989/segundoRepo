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
    require_once '../servidor/modulos/indicadores.php';
    $estadistica = new Estadistica();
    $estadistica = $estadistica->obtenerDatosConvenios();
    $estadistica = $estadistica['data']['convenios'];
    ?>

    <div class="row">

        <!---select ciclo escolar-->
        <div class="col m2 s8 offset-s2">

        </div>

        <div class="col m8 s10" style="margin-left:60px">
            <div class="row">
                <div class="col m12">
                    <div class="card teal lighten-5 ">
                        <div class="card-content">
                            <span class="card-title center-align">CONVENIOS VIGENTES <br>
                                <h6>Instituto Tecnológico Superior de Hopelchén <br><br>Tipo de pantel: Descentralizado</nbr>
                                </h6>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col m6">
                    <div class="card teal lighten-5 ">
                        <div class="card-content">
                            <div class="row">
                                <div class="col m12">
                                    <span class="card-title center-align">
                                        <h6>Convenios de uso compartido de instalaciones para las actividades científicas, tecnológicas y de innovación (Vigentes) </h6>
                                    </span>
                                </div>
                                <div class="col m6 center-align">
                                    <p>Número de convenios: <?php
                                                            echo ($estadistica['tipo_1']);
                                                            ?>
                                    </p>

                                </div>


                                <div class="col m6 center-align">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col m6">
                    <div class="card teal lighten-5 ">
                        <div class="card-content">
                            <div class="row">
                                <div class="col m12">
                                    <span class="card-title center-align">
                                        <h6>Convenios de vinculación entre institutos tecnológicos y centros (Vigentes) <br><br></h6>
                                    </span>
                                </div>

                                <div class="col m6 left-align">
                                    <p>Número de convenios:
                                        <?php
                                        echo ($estadistica['tipo_2']);
                                        ?> </p>

                                </div>
                                <div class="col m6 center-align">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col m6">
                    <div class="card teal lighten-5 ">
                        <div class="card-content">
                            <div class="row">
                                <div class="col m12">
                                    <span class="card-title center-align" style="height: 4rem">
                                        <h6>Número de convenios de vinculación con otras instituciones de educación superior (Vigentes)</h6>
                                    </span>
                                </div>

                                <div class="col m6 center-align">
                                    <p>Nacionales: <?php
                                                    echo ($estadistica['tipo_3']['nacional'])
                                                    ?><br><br>internacionales:
                                        <?php
                                        echo ($estadistica['tipo_3']['internacional'])
                                        ?>

                                        <br><br>Total:
                                        <?php
                                        echo ($estadistica['tipo_3']['total'])
                                        ?>
                                        <br><br>
                                    </p>

                                </div>
                                <div class="col m6 center-align">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col m6">
                    <div class="card teal lighten-5 ">
                        <div class="card-content">
                            <div class="row">
                                <div class="col m12">
                                    <span class="card-title center-align" style="height: 4rem">
                                        <h6>Número de convenios o contratos de vinculación con los sectores público, social y privado (Vigentes) </h6>
                                    </span>
                                </div>

                                <div class=" col m6 center-align">
                                    <p>Mujeres: <br><br>Hombres: <br><br>Total: <br><br></p>

                                </div>
                                <div class="col m6 center-align">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="js/initialization.js"></script>
</body>

</html>
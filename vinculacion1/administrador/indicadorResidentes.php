<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
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
    $estadisticas = new Estadistica();
    $estadisticas = $estadisticas->obtenerDatosResidencias();
    $estadisticas = $estadisticas['data']['sectores'];
   // print_r($estadisticas);
    ?>


    <div class="row">

        <!---select ciclo escolar-->
        <div class="col m2 s8 offset-s2">
            <select>
                <option value="0" disabled selected>Período</option>
                <option value="1">2020-2021</option>
                <option value="2">2021-2022</option>
                <option value="1">2022-2023</option>
                <option value="2">2024-2025</option>
            </select>
        </div>

        <div class="col m8 s10" style="margin-left:60px">
            <div class="row">
                <div class="col m12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title center-align">ESTUDIANTES QUE PARTICIPAN EN PROYECTOS DE VINCULACIÓN CON LOS SECTORES PÚBLICO, SOCIAL Y PRIVADO <br>
                                <h5>Instituto Tecnológico Superior de Hopelchén</h5>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col m4">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col m12">
                                    <span class="card-title center-align">PÚBLICO</span>
                                </div>
                                <div class="col m6 center-align">
                                    <p>
                                        Mujeres:<?php
                                                echo ($estadisticas['publico']['mujeres']);

                                                ?>

                                        <br><br>
                                        Hombres:<?php
                                                echo ($estadisticas['publico']['hombres']);

                                                ?>
                                   
                                        <br><br>Total:
                                        <?php
                                        echo ($estadisticas['publico']['total']);
                                        ?>

                                        <br><br>
                                    </p>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col m4">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col m12">
                                    <span class="card-title center-align">SOCIAL</h5>
                                    </span>
                                </div>

                                <div class="col m6 center-align">
                                    <p>
                                        Mujeres:<?php
                                                echo ($estadisticas['social']['mujeres']);

                                                ?>

                                        <br><br>
                                        Hombres:<?php
                                                echo ($estadisticas['social']['hombres']);

                                                ?>
                                        <?php

                                        // $HOMBRE = $INDICADOR->obtenerhPublico();

                                        ?>
                                        <br><br>Total:
                                        <?php
                                        echo ($estadisticas['social']['total']);
                                        ?>

                                        <br><br>
                                    </p>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col m4">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col m12">
                                    <span class="card-title center-align">PRIVADO</h5>
                                    </span>
                                </div>

                                <div class="col m6 center-align">
                                    <p>
                                        Mujeres:<?php
                                                echo ($estadisticas['privado']['mujeres']);

                                                ?>

                                        <br><br>
                                        Hombres:<?php
                                                echo ($estadisticas['privado']['hombres']);

                                                ?>
                                        <?php

                                        // $HOMBRE = $INDICADOR->obtenerhPublico();

                                        ?>
                                        <br><br>Total:
                                        <?php
                                        echo ($estadisticas['privado']['total']);
                                        ?>

                                        <br><br>
                                    </p>

                                </div>
                                <div class="col m6 center-align">

                                    <?php
                                    // $SQL = new SQL();

                                    // try {
                                    //     $query_privM = "SELECT
                                    //                         COUNT(`residencia`.`MATRICULA`) AS totalM
                                    //                         , `empresa`.`SECTOR`
                                    //                         , `residente`.`GENERO` 
                                    //                     FROM
                                    //                         `viculacion`.`residencia`
                                    //                         INNER JOIN `viculacion`.`empresa` 
                                    //                             ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`)
                                    //                         INNER JOIN `viculacion`.`residente` 
                                    //                             ON (`residencia`.`MATRICULA` = `residente`.`MATRICULA`)
                                    //                     WHERE (`empresa`.`SECTOR` = 'privado' 
                                    //                         AND `residente`.`GENERO` ='femenino');
                                    //                         ";

                                    //     $result = $SQL->consultar($query_privM);

                                    //     if ($result !== false) {
                                    //         while ($row_users = $result->fetch_assoc()) {
                                    //             $TotalM = $row_users['totalM'];
                                    //             echo $TotalM . ' <br><br>';
                                    //         }
                                    //     }
                                    // } catch (Exception $e) {
                                    // }

                                    // try {
                                    //     $query_privH = "SELECT
                                    //                         COUNT(`residencia`.`MATRICULA`) AS totalH
                                    //                         , `empresa`.`SECTOR`
                                    //                         , `residente`.`GENERO` 
                                    //                     FROM
                                    //                         `viculacion`.`residencia`
                                    //                         INNER JOIN `viculacion`.`empresa` 
                                    //                             ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`)
                                    //                         INNER JOIN `viculacion`.`residente` 
                                    //                             ON (`residencia`.`MATRICULA` = `residente`.`MATRICULA`)
                                    //                     WHERE (`empresa`.`SECTOR` = 'privado' 
                                    //                         AND `residente`.`GENERO` ='masculino');";

                                    //     $result = $SQL->consultar($query_privH);

                                    //     if ($result !== false) {
                                    //         while ($row_users = $result->fetch_assoc()) {
                                    //             $TotalH = $row_users['totalH'];
                                    //             echo $TotalH . ' <br><br>';
                                    //         }
                                    //         $total = $TotalM + $TotalH;
                                    //         echo $total;
                                    //     }
                                    // } catch (Exception $e) {
                                    // }

                                    // 
                                    ?>
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
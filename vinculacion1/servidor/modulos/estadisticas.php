<?php

require_once "conexion.php";

$conexion = new Conexion();

$CONSULTAR_LUGAR_NACIMIENTO = "SELECT LUGAR_NACIMIENTO, COUNT(ID_ESTUDIANTE) AS CUANTOS FROM `estudiante_bachiller` GROUP BY LUGAR_NACIMIENTO ORDER BY CUANTOS DESC ";

$CONSULTAR_LUGAR_NACIMIENTO = $conexion->ejecutor($CONSULTAR_LUGAR_NACIMIENTO);

while ($row = $CONSULTAR_LUGAR_NACIMIENTO->fetch_assoc()) {
    $LUGAR_NACIMIENTO[$row['LUGAR_NACIMIENTO']] = $row['CUANTOS'];
}

$CONSULTA_LUGAR_RESIDENCIA = "SELECT LUGAR_RESIDENCIA, COUNT(ID_ESTUDIANTE) AS CUANTOS FROM `estudiante_bachiller` GROUP BY LUGAR_RESIDENCIA ORDER BY CUANTOS DESC";

$CONSULTA_LUGAR_RESIDENCIA = $conexion->ejecutor($CONSULTA_LUGAR_RESIDENCIA);

while ($row = $CONSULTA_LUGAR_RESIDENCIA->fetch_assoc()) {
    $LUGAR_RESIDENCIA[$row['LUGAR_RESIDENCIA']] = $row['CUANTOS'];
}

$CONSULTA_LENGUA = "SELECT LENGUA, COUNT(ID_ESTUDIANTE) AS CUANTOS FROM `estudiante_bachiller` GROUP BY LENGUA ORDER BY CUANTOS DESC";

$CONSULTA_LENGUA = $conexion->ejecutor($CONSULTA_LENGUA);

while ($row = $CONSULTA_LENGUA->fetch_assoc()) {
    $LENGUA[$row['LENGUA']] = $row['CUANTOS'];
}

$CONSULTA_CARRERA_PROPUESTA = "SELECT CARRERA_PROPUESTA, COUNT(ID_ESTUDIANTE) AS CUANTOS FROM `estudiante_bachiller` GROUP BY CARRERA_PROPUESTA ORDER BY CUANTOS DESC ";

$CONSULTA_CARRERA_PROPUESTA = $conexion->ejecutor($CONSULTA_CARRERA_PROPUESTA);

while ($row = $CONSULTA_CARRERA_PROPUESTA->fetch_assoc()) {
    $CARRERA_PROPUESTA[$row['CARRERA_PROPUESTA']] = $row['CUANTOS'];
}

$CONSULTA_CARRERA_VIGENTE = "SELECT carrera.NOMBRE, COUNT(ID_ESTUDIANTE) AS CUANTOS FROM estudiante_bachiller INNER JOIN carrera ON (estudiante_bachiller.CARRERA_ID= carrera.ID_CARRERA) GROUP BY carrera.NOMBRE order by CUANTOS DESC";

$CONSULTA_CARRERA_VIGENTE = $conexion->ejecutor($CONSULTA_CARRERA_VIGENTE);

while ($row =  $CONSULTA_CARRERA_VIGENTE->fetch_assoc()) {
    $CARRERA_VIGENTE[$row['NOMBRE']] = $row['CUANTOS'];
}


$respuesta['status'] = 'OK';
$respuesta['mensaje'] = 'exito';
$respuesta['data'] = array(
    'LUGAR_NACIMIENTO' => $LUGAR_NACIMIENTO,
    'LUGAR_RESIDENCIA' => $LUGAR_RESIDENCIA,
    'LENGUA'=> $LENGUA, 
    'CARRERA_PROPUESTA'=> $CARRERA_PROPUESTA,
    'CARRERA_VIGENTE' => $CARRERA_VIGENTE
);

header("Content-type: application/json");

echo(json_encode($respuesta));

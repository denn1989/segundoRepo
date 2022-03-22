<?php
require_once "modulos/estudianteBachiller.php";
$ESTUDIANTE_B= new EstudianteBachiller();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");

    $DATOS_ESTUDIANTEB= json_decode($postBody, true);

    $escuela_id = $DATOS_ESTUDIANTEB['ESCUELA_ID'];
    $nombre= $DATOS_ESTUDIANTEB['NOMBRE'];
    $apellido = $DATOS_ESTUDIANTEB['APELLIDO'];
    $lugar_nacimiento = $DATOS_ESTUDIANTEB['LUGAR_NACIMIENTO'];
    $lugar_residencia = $DATOS_ESTUDIANTEB['LUGAR_RESIDENCIA'];
    $lengua= $DATOS_ESTUDIANTEB['LENGUA'];
    
    $respuesta = $ESTUDIANTE_B->post($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $ESTUDIANTE_B->put($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") { // preparar al navegador para recibir el método;
    if (isset($_GET['condicion'])) {
        $respuesta = $ESTUDIANTE_B->obtenerEstudiantesB($_GET['condicion']);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
}

<?php
require_once "modulos/residencias.php";
$RESIDENCIA = new Residencia();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $DATOS_RESIDENCIA = json_decode($postBody, true);

    $respuesta = $RESIDENCIA->postDatos($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $RESIDENCIA->put($postBody);

    $respuesta = $RESIDENCIA->EliminarResidentePut($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") { // preparar al navegador para recibir el método;
    if (isset($_GET['condicion'])) {

        $respuesta = $RESIDENCIA->obtenerResidente($_GET['condicion']);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");

    $respuesta = $RESIDENCIA->EliminarResidentePut($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

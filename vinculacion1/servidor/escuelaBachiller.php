<?php
require_once "modulos/escuelaBachiller.php";
$ESCUELA = new EscuelaBachiller();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $ESCUELA->post($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $ESCUELA->put($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") { // preparar al navegador para recibir el método;
    if (isset($_GET['condicion'])) {
        $respuesta = $ESCUELA->obtenerBachiller($_GET['condicion']);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
}
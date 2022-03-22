<?php
require_once "modulos/asesoresInternos.php";
$ASESOR_INTERNO = new AsesorInterno();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $ASESOR_INTERNO->post($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $ASESOR_INTERNO->put($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") { // preparar al navegador para recibir el método;
    if (isset($_GET['condicion'])) {
        $respuesta = $ASESOR_INTERNO->obtenerAsesoresInt($_GET['condicion']);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
}


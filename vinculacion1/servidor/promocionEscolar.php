<?php

require_once "modulos/promocion.php";

$PROMOCION_ESCOLAR = new Promocion();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");

    $respuesta = $PROMOCION_ESCOLAR->post($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    // $respuesta = $PROMOCION_ESCOLAR->put($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['condicion'])) {
        $respuesta = $PROMOCION_ESCOLAR->obtenerPromocion($_GET['condicion']);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $PROMOCION_ESCOLAR->deletePromocion($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

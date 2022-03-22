<?php
require_once "modulos/empresas.php";
$EMPRESA = new Empresa();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");

    $DATOS_EMPRESA= json_decode($postBody,true);
    $respuesta = $EMPRESA->post($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $EMPRESA->put($postBody);
    $respuesta= $EMPRESA->delete($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}


if ($_SERVER['REQUEST_METHOD'] == "GET") { // preparar al navegador para recibir el método;
    if (isset($_GET['condicion'])) {
        $respuesta = $EMPRESA->obtenerEmpresas($_GET['condicion']);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
}

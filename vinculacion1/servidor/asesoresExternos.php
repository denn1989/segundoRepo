<?php
require_once "modulos/asesoresExternos.php";
$ASESOR_EXTERNO = new AsesorExterno();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    
    
    $respuesta = $ASESOR_EXTERNO->post($postBody);

    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $ASESOR_EXTERNO->put($postBody);
    $respuesta= $ASESOR_EXTERNO->delete($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") { // preparar al navegador para recibir el método;
    if (isset($_GET['condicion'])) {
        $respuesta = $ASESOR_EXTERNO->obtenerAsesoresExt($_GET['condicion']);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
}

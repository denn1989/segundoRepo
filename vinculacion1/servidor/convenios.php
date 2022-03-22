<?php
require_once "modulos/convenios.php";
$CONVENIO = new Convenio();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $DATOS_CONVENIO= json_decode($postBody,true);

    $empresa_id =$DATOS_CONVENIO['EMPRESA_ID'];
    $tipoConvenio_id= $DATOS_CONVENIO['TIPOCONVENIO_ID'];
    $inicio_convenio= $DATOS_CONVENIO['INICIO_CONVENIO'];
    $fin_convenio= $DATOS_CONVENIO['FIN_CONVENIO'];
    
    $respuesta = $CONVENIO->post($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $CONVENIO->put($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") { // preparar al navegador para recibir el método;
    if (isset($_GET['condicion'])) {
        $respuesta = $CONVENIO->obtenerConvenios($_GET['condicion']);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $CONVENIO->delete($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}


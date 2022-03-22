<?php
require_once "modulos/estudiantes.php";
$ESTUDIANTE = new Estudiante();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $ESTUDIANTE->post($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT") { // preparar al navegador para recibir el método;
    $postBody = file_get_contents("php://input");
    $respuesta = $ESTUDIANTE->put($postBody);
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}




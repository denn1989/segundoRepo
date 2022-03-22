<?php
session_start();
require_once "modulos/conexion.php";

$conexion = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postBody = file_get_contents("php://input");

    $datosUser = json_decode($postBody, true);

    $USERNAME = $datosUser['username'];
    $PASSWORD = md5($datosUser['password']);

   if(empty($USERNAME) || empty($PASSWORD)){
        $result['status'] = "ERROR";
        $result['mensaje'] = "Ingrese usuario y contraseña";
        header('Content-Type: application/json');
        echo json_encode($result);
         

   }else{
        $CONSULTA_USUARIO = "SELECT count(*) AS existencia FROM usuario_vinculacion WHERE usuario= '$USERNAME'";

        $CONSULTA_USUARIO = $conexion->ejecutor($CONSULTA_USUARIO);

        $CONSULTA_USUARIO = $CONSULTA_USUARIO->fetch_assoc();

        if ($CONSULTA_USUARIO['existencia']) {


            $VALIDAR_CONTRASENIA = "SELECT CONTRASENIA FROM usuario_vinculacion 
						WHERE 
							USUARIO = '$USERNAME' ";

            $VALIDAR_CONTRASENIA = $conexion->ejecutor($VALIDAR_CONTRASENIA);
            $VALIDAR_CONTRASENIA = $VALIDAR_CONTRASENIA->fetch_assoc();

            if ($VALIDAR_CONTRASENIA['CONTRASENIA'] == $PASSWORD) {

                $DATOS_SESION = "SELECT * FROM usuario_vinculacion where USUARIO        = '$USERNAME'";
                $DATOS_SESION = $conexion->ejecutor($DATOS_SESION);

                $DATOS_SESION = $DATOS_SESION->fetch_assoc();


                $_SESSION['NOMBRE'] = $DATOS_SESION['NOMBRE'];
                $_SESSION['AP_PAT'] = $DATOS_SESION['AP_PAT'];
                $_SESSION['AP_MAT'] = $DATOS_SESION['AP_MAT'];
                $_SESSION['CARGO'] = $DATOS_SESION['CARGO'];

                $result['status'] = "OK";
                $result['mensaje'] = "inicio exitoso";
                header('Content-Type: application/json');
                echo json_encode($result);
            } else {


                $result['status'] = "ERROR";
                $result['mensaje'] = "Contraseña incorrecta";
                header('Content-Type: application/json');
                echo json_encode($result);
            }
        } else {
            $result['status'] = "ERROR";
            $result['mensaje'] = "El usuario no existe";
            header('Content-Type: application/json');
            echo json_encode($result);
        }
   }
}


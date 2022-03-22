<?php

require_once "conexion.php";

class Promocion
{
    private $ID_ESTUDIANTE;
    private $ESCUELA_ID;
    private $CARRERA_ID;
    private $NOMBRE;
    private $APELLIDO;
    private $LUGAR_NACIMIENTO;
    private $LUGAR_RESIDENCIA;
    private $LENGUA;
    private $CICLO_ESCOLAR;
    private $CARRERA_PROPUESTA;
    private $CARRERA;   

    private $CONEXION;

    public function __construct()
    {
        $this->CONEXION = new Conexion();
    }

    public function post($json)
    {
        $DATOS_PROMOCION = json_decode($json, true);

        if ((!isset($DATOS_PROMOCION['ESCUELA_ID']) || !isset($DATOS_PROMOCION['CARRERA_ID']) || !isset($DATOS_PROMOCION['NOMBRE']) || !isset($DATOS_PROMOCION['APELLIDO']) || !isset($DATOS_PROMOCION['LUGAR_NACIMIENTO']) || !isset($DATOS_PROMOCION['LUGAR_RESIDENCIA']) || !isset($DATOS_PROMOCION['LENGUA']) || !isset($DATOS_PROMOCION['CICLO_ESCOLAR']) || !isset($DATOS_PROMOCION['CARRERA_PROPUESTA']))
            ||
            ($DATOS_PROMOCION['ESCUELA_ID'] == ' ' || $DATOS_PROMOCION['CARRERA_ID'] == ' ' || $DATOS_PROMOCION['NOMBRE'] == ' ' || $DATOS_PROMOCION['APELLIDO'] == ' ' || $DATOS_PROMOCION['LUGAR_NACIMIENTO'] == ' ' || $DATOS_PROMOCION['LUGAR_RESIDENCIA'] == ' ' || $DATOS_PROMOCION['LENGUA'] == ' ' || $DATOS_PROMOCION['CICLO_ESCOLAR'] == ' ' || $DATOS_PROMOCION['CARRERA_PROPUESTA'] == ' ')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->ESCUELA_ID = $DATOS_PROMOCION['ESCUELA_ID'];
            $this->CARRERA_ID = $DATOS_PROMOCION['CARRERA_ID'];
            $this->NOMBRE = $DATOS_PROMOCION['NOMBRE'];
            $this->APELLIDO = $DATOS_PROMOCION['APELLIDO'];
            $this->LUGAR_NACIMIENTO = $DATOS_PROMOCION['LUGAR_NACIMIENTO'];
            $this->LUGAR_RESIDENCIA = $DATOS_PROMOCION['LUGAR_RESIDENCIA'];
            $this->LENGUA = $DATOS_PROMOCION['LENGUA'];
            $this->CICLO_ESCOLAR = $DATOS_PROMOCION['CICLO_ESCOLAR'];
            $this->CARRERA_PROPUESTA = $DATOS_PROMOCION['CARRERA_PROPUESTA'];

            if ($this->insertarPromocion()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Promoción añadida correctamente';

                return $result;
            } else {

                $result['status'] = 'ERROR';
                $result['mensaje'] = 'fallo al añadir Promoción';

                return $result;
            }
        }
    }

    public function deletePromocion($json)
    {
        $ELIMINAR = json_decode($json, true);

        if (
            (!isset($ELIMINAR['ID_ESTUDIANTE']))
            ||
            ($ELIMINAR['ID_ESTUDIANTE'] == '')

        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {

            $this->ID_ESTUDIANTE = $ELIMINAR['ID_ESTUDIANTE'];

            if ($this->eliminarPromocion()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Residencia eliminada';

                return $result;
            } else {

                $result['status'] = 'ERROR';
                $result['mensaje'] = 'fallo al eliminar residencia';

                return $result;
            }
        }
    }

    public function obtenerPromocion($condicion)
    {
        $CONSULTA_TOTAL = "SELECT COUNT(*) AS TOTAL FROM estudiante_bachiller WHERE `estudiante_bachiller`.`LUGAR_NACIMIENTO` LIKE ' %$condicion% ' OR`estudiante_bachiller`.`LUGAR_RESIDENCIA` LIKE '%$condicion%' OR `estudiante_bachiller`.`NOMBRE` LIKE '%$condicion%' OR `estudiante_bachiller`.`APELLIDO` LIKE '%$condicion%' ;";

        $CONSULTA_TOTAL = $this->CONEXION->ejecutor($CONSULTA_TOTAL);

        if ($CONSULTA_TOTAL) {
            $CONSULTA_TOTAL = $CONSULTA_TOTAL->fetch_assoc();

            if ($CONSULTA_TOTAL['TOTAL'] > 0) {

                $OBTENER_PROMOCIONES = "SELECT
            `estudiante_bachiller`.`ID_ESTUDIANTE`
            , `escuela_bachiller`.`NOMBRE_ESCUELA`
            , `carrera`.`NOMBRE` AS `CARRERA`
            , `estudiante_bachiller`.`NOMBRE`
            , `estudiante_bachiller`.`APELLIDO`
            , `estudiante_bachiller`.`LUGAR_NACIMIENTO`
            , `estudiante_bachiller`.`LUGAR_RESIDENCIA`
            , `estudiante_bachiller`.`LENGUA`
            , `estudiante_bachiller`.`CICLO_ESCOLAR`
            , `estudiante_bachiller`.`CARRERA_PROPUESTA`
        FROM
            `viculacion`.`estudiante_bachiller`
            INNER JOIN `viculacion`.`escuela_bachiller` 
                ON (`estudiante_bachiller`.`ESCUELA_ID` = `escuela_bachiller`.`ID_ESCUELA`)
            INNER JOIN `viculacion`.`carrera` 
                ON (`estudiante_bachiller`.`CARRERA_ID` = `carrera`.`ID_CARRERA`)
                WHERE `estudiante_bachiller`.`LUGAR_NACIMIENTO` LIKE '%$condicion%' OR `estudiante_bachiller`.`LUGAR_RESIDENCIA` LIKE '%$condicion%' OR `estudiante_bachiller`.`NOMBRE` LIKE '%$condicion%' OR `estudiante_bachiller`.`` LIKE '%$condicion%'  ;";

                $result = $this->CONEXION->ejecutor($OBTENER_PROMOCIONES);

                if ($result) {
                    $paginas = intval($CONSULTA_TOTAL['TOTAL']);
                    $modulo = $CONSULTA_TOTAL['TOTAL'] % 15;

                    if ($modulo) {
                        $paginas = $paginas + 1;
                    }

                    $respuesta['status'] = 'OK';
                    $respuesta['mensaje'] = 'consulta exitosa';
                    $respuesta['datos'] = $this->enlistarDatos($result);

                    return $respuesta;
                } else {

                    $respuesta['status'] = 'ERROR';
                    $respuesta['mensaje'] = 'ERROR al consultar 1';

                    return $respuesta;
                }
            } else {
                $respuesta['status'] = 'ERROR';
                $respuesta['mensaje'] = 'Sin registros';

                return $respuesta;
            }
        } else {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'ERROR al consultar 2';

            return $respuesta;
        }
    }

        public function selectCarrera()
    {
        $CONSULTA_TOTAL = "SELECT ID_CARRERA, NOMBRE FROM carrera;";
        $CONSULTA_TOTAL = $this->CONEXION->ejecutor($CONSULTA_TOTAL);
        if ($CONSULTA_TOTAL !== false) {
            while ($row_ae = mysqli_fetch_array($CONSULTA_TOTAL)) {
                $this->ID_CARRERA = $row_ae['ID_CARRERA'];
                $this->CARRERA = $row_ae['NOMBRE'];

                echo '<option value="' . $this->ID_CARRERA . '">' . $this->CARRERA . '</option>';
            }
        }
    }


    private function insertarPromocion()
    {
        $INSERTAR_PROMOCION = "INSERT INTO estudiante_bachiller (ESCUELA_ID, CARRERA_ID, NOMBRE, APELLIDO, LUGAR_NACIMIENTO, LUGAR_RESIDENCIA, LENGUA, CICLO_ESCOLAR, CARRERA_PROPUESTA) VALUES ($this->ESCUELA_ID, $this->CARRERA_ID, '$this->NOMBRE', '$this->APELLIDO', '$this->LUGAR_NACIMIENTO', '$this->LUGAR_RESIDENCIA', '$this->LENGUA', '$this->CICLO_ESCOLAR', '$this->CARRERA_PROPUESTA')";

        $result = $this->CONEXION->ejecutor($INSERTAR_PROMOCION);

        return $result;
    }

    private function eliminarPromocion()
    {
        $ELIMINAR_PROMOCION = "DELETE FROM estudiante_bachiller WHERE ID_ESTUDIANTE= $this->ID_ESTUDIANTE";

        $result = $this->CONEXION->ejecutor($ELIMINAR_PROMOCION);

        return $result;
    }

    private function enlistarDatos($result)
    {
        $respuesta = array();
        $elementos = array();


        while ($promocion = $result->fetch_assoc()) {


            $elementos[$promocion['ID_ESTUDIANTE']] = array('nombre' => $promocion['NOMBRE'] . ' ' . $promocion['APELLIDO'], 'lugar_nacimiento' => $promocion['LUGAR_NACIMIENTO'], 'lugar_residencia' => $promocion['LUGAR_RESIDENCIA'], 'lengua' => $promocion['LENGUA'], 'ciclo_escolar' => $promocion['CICLO_ESCOLAR'], 'carrera_prop' => $promocion['CARRERA_PROPUESTA'], 'carrera' => $promocion['CARRERA'], 'escuela' => $promocion['NOMBRE_ESCUELA']);



            $respuesta = $elementos;
        }
        return $respuesta;
    }
}



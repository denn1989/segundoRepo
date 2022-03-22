<?php
require_once "conexion.php";

class Estudiante
{

    private $matricula;
    private $carrera_id;
    private $nombre;
    private $apellidoMat;
    private $apellidoPat;
    private $semestre;
    private $periodo;

    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function post($json)
    {
        $DATOS_ESTUDIANTES = json_decode($json, true);
        if (
            (!isset($DATOS_ESTUDIANTES['MATRICULA']) || !isset($DATOS_ESTUDIANTES['CARRERA_ID']) || !isset($DATOS_ESTUDIANTES['NOMBRE']) || !isset($DATOS_ESTUDIANTES['AP_MAT']) || !isset($DATOS_ESTUDIANTES['AP_PAT']) || !isset($DATOS_ESTUDIANTES['SEMESTRE']) || !isset($DATOS_ESTUDIANTES['PERIODO']))
            ||
            ($DATOS_ESTUDIANTES['MATRICULA'] == '' || $DATOS_ESTUDIANTES['CARRERA_ID'] == '' || $DATOS_ESTUDIANTES['NOMBRE'] == '' || $DATOS_ESTUDIANTES['AP_MAT'] == '' || $DATOS_ESTUDIANTES['AP_PAT'] == '' || $DATOS_ESTUDIANTES['SEMESTRE'] == '' || $DATOS_ESTUDIANTES['PERIODO'] == '')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->matricula = $DATOS_ESTUDIANTES['MATRICULA'];
            $this->carrera_id = $DATOS_ESTUDIANTES['CARRERA_ID'];
            $this->nombre = $DATOS_ESTUDIANTES['NOMBRE'];
            $this->apellidoMat = $DATOS_ESTUDIANTES['AP_MAT'];
            $this->apellidoPat = $DATOS_ESTUDIANTES['AP_PAT'];
            $this->semestre = $DATOS_ESTUDIANTES['SEMESTRE'];
            $this->periodo = $DATOS_ESTUDIANTES['PERIODO'];

            if ($this->insertarEstudiante()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'añadido correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'fallo al añadir';
                return $result;
            }
        }
    }

    public function put($json)
    {
        $DATOS_ESTUDIANTES = json_decode($json, true);
        if (
            (!isset($DATOS_ESTUDIANTES['MATRICULA']) || !isset($DATOS_ESTUDIANTES['CARRERA_ID']) || !isset($DATOS_ESTUDIANTES['NOMBRE']) || !isset($DATOS_ESTUDIANTES['AP_MAT']) || !isset($DATOS_ESTUDIANTES['AP_PAT']) || !isset($DATOS_ESTUDIANTES['SEMESTRE']) || !isset($DATOS_ESTUDIANTES['PERIODO']))
            ||
            ($DATOS_ESTUDIANTES['MATRICULA'] == '' || $DATOS_ESTUDIANTES['CARRERA_ID'] == '' || $DATOS_ESTUDIANTES['NOMBRE'] == '' || $DATOS_ESTUDIANTES['AP_MAT'] == '' || $DATOS_ESTUDIANTES['AP_PAT'] == '' || $DATOS_ESTUDIANTES['SEMESTRE'] == '' || $DATOS_ESTUDIANTES['PERIODO'] == '')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->matricula = $DATOS_ESTUDIANTES['MATRICULA'];
            $this->carrera_id = $DATOS_ESTUDIANTES['CARRERA_ID'];
            $this->nombre = $DATOS_ESTUDIANTES['NOMBRE'];
            $this->apellidoMat = $DATOS_ESTUDIANTES['AP_MAT'];
            $this->apellidoPat = $DATOS_ESTUDIANTES['AP_PAT'];
            $this->semestre = $DATOS_ESTUDIANTES['SEMESTRE'];
            $this->periodo = $DATOS_ESTUDIANTES['PERIODO'];

            if ($this->actualizarEstudiante()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'actualizado correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'fallo al actualizar';
                return $result;
            }
        }
    }

    private function insertarEstudiante()
    {

        $INSERTAR_ESTUDIANTE = " INSERT INTO estudiante (MATRICULA,CARRERA_ID, NOMBRE, AP_MAT, AP_PAT, SEMESTRE, PERIODO ) VALUES ( $this->matricula, $this->carrera_id, '$this->nombre', '$this->apellidoMat', '$this->apellidoPat', $this->semestre, '$this->periodo' ) ";

        $result = $this->conexion->ejecutor($INSERTAR_ESTUDIANTE);

        return $result;
    }

    private function actualizarEstudiante()
    {

        $ACTUALIZAR_ESTUDIANTE = "UPDATE estudiante SET CARRERA_ID=$this->carrera_id, NOMBRE='$this->nombre', AP_MAT='$this->apellidoMat', AP_PAT='$this->apellidoPat', SEMESTRE=$this->semestre, PERIODO='$this->periodo' WHERE MATRICULA= $this->matricula";

        $result = $this->conexion->ejecutor($ACTUALIZAR_ESTUDIANTE);

        return $result;
    }

    private function eliminarEstudiante($matricula)
    {

        $ELIMINAR_ESTUDIANTE = "DELETE FROM estudiante WHERE MATRICULA= '$matricula'";

        $result = $this->conexion->ejecutor($ELIMINAR_ESTUDIANTE);

        return $result;
    }
}

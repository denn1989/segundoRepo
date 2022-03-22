<?php
require_once "conexion.php";

class AsesorInterno
{

    private $idAsesorInt;
    private $claveDocente;
    private $nombre;
    private $apellidoPat;
    private $apellidoMat;
    private $especialidad;
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function post($json)
    {
        $DATOS_ASESOR_INT = json_decode($json, true);
        if (
            (!isset($DATOS_ASESOR_INT['CLAVE_DOCENTE']) || !isset($DATOS_ASESOR_INT['NOMBRE']) || !isset($DATOS_ASESOR_INT['AP_PAT']) || !isset($DATOS_ASESOR_INT['AP_MAT']) || !isset($DATOS_ASESOR_INT['ESPECIALIDAD']))
            ||
            ($DATOS_ASESOR_INT['CLAVE_DOCENTE'] == '' || $DATOS_ASESOR_INT['NOMBRE'] == '' || $DATOS_ASESOR_INT['AP_PAT'] == '' || $DATOS_ASESOR_INT['AP_MAT'] == '' || $DATOS_ASESOR_INT['ESPECIALIDAD'] == '')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->claveDocente = $DATOS_ASESOR_INT['CLAVE_DOCENTE'];
            $this->nombre = $DATOS_ASESOR_INT['NOMBRE'];
            $this->apellidoPat = $DATOS_ASESOR_INT['AP_PAT'];
            $this->apellidoMat = $DATOS_ASESOR_INT['AP_MAT'];
            $this->especialidad = $DATOS_ASESOR_INT['ESPECIALIDAD'];

            if ($this->insertarAsesorInterno()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Asesor interno añadido correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al añadir asesor interno';

                return $result;
            }
        }
    }

    public function put($json)
    {
        $DATOS_ASESOR_INT = json_decode($json, true);
        if (
            (!isset($DATOS_ASESOR_INT['ID_ASESORINT']) || !isset($DATOS_ASESOR_INT['CLAVE_DOCENTE']) || !isset($DATOS_ASESOR_INT['NOMBRE']) || !isset($DATOS_ASESOR_INT['AP_PAT']) || !isset($DATOS_ASESOR_INT['AP_MAT']) || !isset($DATOS_ASESOR_INT['ESPECIALIDAD']))
            ||
            ($DATOS_ASESOR_INT['ID_ASESORINT'] == '' || $DATOS_ASESOR_INT['CLAVE_DOCENTE'] == '' || $DATOS_ASESOR_INT['NOMBRE'] == '' || $DATOS_ASESOR_INT['AP_PAT'] == '' || $DATOS_ASESOR_INT['AP_MAT'] == '' || $DATOS_ASESOR_INT['ESPECIALIDAD'] == '')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->idAsesorInt = $DATOS_ASESOR_INT['ID_ASESORINT'];
            $this->claveDocente = $DATOS_ASESOR_INT['CLAVE_DOCENTE'];
            $this->nombre = $DATOS_ASESOR_INT['NOMBRE'];
            $this->apellidoPat = $DATOS_ASESOR_INT['AP_PAT'];
            $this->apellidoMat = $DATOS_ASESOR_INT['AP_MAT'];
            $this->especialidad = $DATOS_ASESOR_INT['ESPECIALIDAD'];

            if ($this->actualizarAsesorInterno()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Asesor interno actualizado correctamente';
                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al actualizar asesor interno ';
                return $result;
            }
        }
    }

    private function insertarAsesorInterno()
    {

        $INSERTAR_ASESOR_INT = " INSERT INTO asesor_interno (CLAVE_DOCENTE, NOMBRE, AP_PAT, AP_MAT, ESPECIALIDAD) VALUES ( '$this->claveDocente', '$this->nombre', '$this->apellidoPat', '$this->apellidoMat', '$this->especialidad')";

        $result = $this->conexion->ejecutor($INSERTAR_ASESOR_INT);

        return $result;
    }

    private function actualizarAsesorInterno()
    {

        $ACTUALIZAR_ASESOR_INT = "UPDATE asesor_interno SET CLAVE_DOCENTE='$this->claveDocente', NOMBRE='$this->nombre', AP_PAT='$this->apellidoPat', AP_MAT='$this->apellidoMat', ESPECIALIDAD='$this->especialidad' WHERE ID_ASESORINT = '$this->idAsesorInt' ";

        $result = $this->conexion->ejecutor($ACTUALIZAR_ASESOR_INT);

        return $result;
    }

    private function eliminarAsesorInt($idAsesorInt)
    {

        $ELIMINAR_ASESOR_INT = "DELETE FROM asesor_interno WHERE ID_ASESORINT= '$idAsesorInt'";

        $result = $this->conexion->ejecutor($ELIMINAR_ASESOR_INT);

        if ($result) {
            return "Asesor interno eliminado";
        } else {
            return "ERROR al eliminar asesor interno";
        }
    }

    public function selectAsesoresInt(){
        $CONSULTA_ASESORES_INT = "SELECT * FROM asesor_interno;";
        $CONSULTA_ASESORES_INT = $this->conexion->ejecutor($CONSULTA_ASESORES_INT);
        if ($CONSULTA_ASESORES_INT) {
            while ($row_ae = mysqli_fetch_array($CONSULTA_ASESORES_INT)) {
                $id = $row_ae['ID_ASESORINT'];
                $nombre = $row_ae['NOMBRE'];
                $ap_pat = $row_ae['AP_PAT'];
                $ap_mat = $row_ae['AP_MAT'];
                $nombre_completo = $nombre . ' ' . $ap_pat . ' ' . $ap_mat;
                echo '<option value=' . $id . '>' . $nombre_completo . '</option>';
            }
        }
    }

    public function obtenerAsesoresInt($condicion)
    {
        $CONSULTA_TOTAL =
            "SELECT  COUNT(*) AS total
            FROM `viculacion`.`asesor_interno`
WHERE `NOMBRE` LIKE '%$condicion%' OR `AP_PAT` LIKE '%$condicion%' OR `AP_MAT` LIKE '%$condicion%'";


        $CONSULTA_TOTAL = $this->conexion->ejecutor($CONSULTA_TOTAL);

        if ($CONSULTA_TOTAL) {
            $CONSULTA_TOTAL = $CONSULTA_TOTAL->fetch_assoc();
            if ($CONSULTA_TOTAL['total'] > 0) {
                $OBTENER_ASESORES = "SELECT `CLAVE_DOCENTE`, `NOMBRE`,`AP_PAT`,`AP_MAT`
FROM `viculacion`.`asesor_interno`
WHERE `NOMBRE` LIKE '%$condicion%' OR `AP_PAT` LIKE '%$condicion%' OR `AP_MAT` LIKE '%$condicion%'";

                $result = $this->conexion->ejecutor($OBTENER_ASESORES);

                if ($result) {

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

    private function enlistarDatos($result)
    {
        $respuesta = array();

        while ($asesor = $result->fetch_assoc()) {

            $respuesta[$asesor['CLAVE_DOCENTE']] = array(
                'nombre' => $asesor['NOMBRE'] . ' ' . $asesor['AP_PAT'] . ' ' . $asesor['AP_MAT']
            );
        }

        return $respuesta;
    }
}

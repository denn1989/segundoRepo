<?php
require_once "conexion.php";

class AsesorExterno
{
    private $idAsesorext;
    private $nombre;
    private $apellidoPat;
    private $apellidoMat;
    private $especialidad;
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();   
    }

    public function delete($json){
        $ELIMINAR =json_decode($json, true);

        if(!isset($ELIMINAR['ID_ASESOREXT']) || $ELIMINAR['ID_ASESOREXT']==''){

            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'No se encontró el ID';

            return $respuesta;

        }else{

            $this->idAsesorext = $ELIMINAR['ID_ASESOREXT'];

            if($this->eliminarAsesorExterno()){
                $respuesta['status'] = 'OK';
                $respuesta['mensaje'] = 'Asesor eliminado';

                return $respuesta;
            }else{
                $respuesta['status'] = 'ERROR';
                $respuesta['mensaje'] = 'Falló al eliminar';

                return $respuesta;

            }

        }
    }


    public function post($json)
    {
        $DATOS_ASESOR_EXT = json_decode($json, true);
        if (
            (!isset($DATOS_ASESOR_EXT['NOMBRE']) || !isset($DATOS_ASESOR_EXT['AP_PAT']) || !isset($DATOS_ASESOR_EXT['AP_MAT']) || !isset($DATOS_ASESOR_EXT['ESPECIALIDAD']))
            ||
            ($DATOS_ASESOR_EXT['NOMBRE'] == '' || $DATOS_ASESOR_EXT['AP_PAT'] == '' || $DATOS_ASESOR_EXT['AP_MAT'] == '' || $DATOS_ASESOR_EXT['ESPECIALIDAD']=='')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->nombre = $DATOS_ASESOR_EXT['NOMBRE'];
            $this->apellidoPat = $DATOS_ASESOR_EXT['AP_PAT'];
            $this->apellidoMat = $DATOS_ASESOR_EXT['AP_MAT'];
            $this->especialidad = $DATOS_ASESOR_EXT['ESPECIALIDAD'];

            if ($this->insertarAsesorExterno()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Asesor externo añadido correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al añadir asesor externo';
                return $result;
            }
        }
    }

    public function put($json)
    {
        $DATOS_ASESOR_EXT = json_decode($json, true);
        if (
            (!isset($DATOS_ASESOR_EXT['ID_ASESOREXT']) ||!isset($DATOS_ASESOR_EXT['NOMBRE']) || !isset($DATOS_ASESOR_EXT['AP_PAT']) || !isset($DATOS_ASESOR_EXT['AP_MAT']) || !isset($DATOS_ASESOR_EXT['ESPECIALIDAD']))
            ||
            ($DATOS_ASESOR_EXT['ID_ASESOREXT']== '' || $DATOS_ASESOR_EXT['NOMBRE'] == '' || $DATOS_ASESOR_EXT['AP_PAT'] == '' || $DATOS_ASESOR_EXT['AP_MAT'] == '' || $DATOS_ASESOR_EXT['ESPECIALIDAD']=='')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->idAsesorext = $DATOS_ASESOR_EXT['ID_ASESOREXT'];
            $this->nombre = $DATOS_ASESOR_EXT['NOMBRE'];
            $this->apellidoPat = $DATOS_ASESOR_EXT['AP_PAT'];
            $this->apellidoMat = $DATOS_ASESOR_EXT['AP_MAT'];
            $this->especialidad = $DATOS_ASESOR_EXT['ESPECIALIDAD'];

            if ($this->actualizarAsesorExterno()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Asesor externo actualizado correctamente';
                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al actualizar asesor externo';
                return $result;
            }
        }
    }


    private function insertarAsesorExterno()
    {

        $INSERTAR_ASESOR_EXT = " INSERT INTO asesor_externo (NOMBRE, AP_PAT, AP_MAT, ESPECIALIDAD) VALUES ('$this->nombre', '$this->apellidoPat', '$this->apellidoMat', '$this->especialidad')";

        $result = $this->conexion->ejecutor($INSERTAR_ASESOR_EXT);

        return $result;
    }

    private function actualizarAsesorExterno()
    {

        $ACTUALIZAR_ASESOR_EXT = "UPDATE asesor_externo SET NOMBRE= '$this->nombre', AP_PAT='$this->apellidoPat', AP_MAT='$this->apellidoMat', ESPECIALIDAD='$this->especialidad' WHERE ID_ASESOREXT=$this->idAsesorext ";

        $result = $this->conexion->ejecutor($ACTUALIZAR_ASESOR_EXT);

        return $result;
    }

    private function eliminarAsesorExterno()
    {

        $ELIMINAR_ASESOR_EXT = "UPDATE asesor_externo SET ESTADO= 'BAJA' WHERE ID_ASESOREXT= '$this->idAsesorext'";

        $result = $this->conexion->ejecutor($ELIMINAR_ASESOR_EXT);

        return $result;
    }

    public function selectAsesoresExt(){
        $CONSULTAR_ASESORES_EXT = "SELECT * FROM asesor_externo;";
        $CONSULTAR_ASESORES_EXT = $this->conexion->ejecutor($CONSULTAR_ASESORES_EXT);
        if ($CONSULTAR_ASESORES_EXT) {
            while ($row_ae = mysqli_fetch_array($CONSULTAR_ASESORES_EXT)) {
                $id = $row_ae['ID_ASESOREXT'];
                $nombre = $row_ae['NOMBRE'];
                $ap_pat = $row_ae['AP_PAT'];
                $ap_mat = $row_ae['AP_MAT'];
                $nombre_completo = $nombre . ' ' . $ap_pat . ' ' . $ap_mat;
                echo '<option value=' . $id . '>' . $nombre_completo . '</option>';
            }
        }

    }

    public function obtenerAsesoresExt($condicion)
    {
        $CONSULTA_TOTAL = "SELECT
            COUNT(*) AS total
            FROM `viculacion`.`asesor_externo`
            WHERE `NOMBRE` LIKE '%$condicion%' OR `AP_PAT` LIKE '%$condicion%' OR `AP_MAT` LIKE '%$condicion%'";

        $CONSULTA_TOTAL = $this->conexion->ejecutor($CONSULTA_TOTAL);

        if ($CONSULTA_TOTAL) {
            $CONSULTA_TOTAL = $CONSULTA_TOTAL->fetch_assoc();
            if ($CONSULTA_TOTAL['total'] > 0) {
                $OBTENER_ASESORES = "SELECT `ID_ASESOREXT`,`NOMBRE` , `AP_PAT`, `AP_MAT` FROM `viculacion`.`asesor_externo`
                                    WHERE `ESTADO`='ALTA' AND (`NOMBRE` LIKE '%$condicion%' OR `AP_PAT` LIKE '%$condicion%' OR `AP_MAT` LIKE '%$condicion%')";

                $result = $this->conexion->ejecutor($OBTENER_ASESORES);

                if ($result ) {

                    $respuesta['status'] = 'OK';
                    $respuesta['mensaje'] = 'consulta exitosa';
                    $respuesta['datos'] = $this->enlistarDatos($result);
                    return $respuesta;
                    
                } else {
                    $respuesta['status'] = 'ERROR';
                    $respuesta['mensaje'] = 'Error al consultar 1';

                    return $respuesta;
                }
            } else {

                $respuesta['status'] = 'ERROR';
                $respuesta['mensaje'] = 'Sin registros';

                return $respuesta;
            }
        } else {

            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Error al consultar 2';

            return $respuesta;
        }
    }


    private function enlistarDatos($result)
    {

        $respuesta = array();

        while ($asesor = $result->fetch_assoc()) {
            $respuesta[$asesor['ID_ASESOREXT']] = array(
                'nombre' => $asesor['NOMBRE'] . ' ' . $asesor['AP_PAT'] . ' ' . $asesor['AP_MAT']
            );
        }

        return $respuesta;
    }

     

}


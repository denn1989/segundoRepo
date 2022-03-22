<?php
require_once "conexion.php";

class Empresa
{

    private $idEmpresa;
    private $nombre;
    private $encargado;
    private $telefono;
    private $correo;
    private $direccion;
    private $sector;
    private $tipo;
    private $estado;
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function post($json)
    {
        $DATOS_EMPRESAS = json_decode($json, true);
        if (
            (!isset($DATOS_EMPRESAS['NOMBRE']) || !isset($DATOS_EMPRESAS['ENCARGADO']) || !isset($DATOS_EMPRESAS['TELEFONO']) || !isset($DATOS_EMPRESAS['TELEFONO']) || !isset($DATOS_EMPRESAS['CORREO']) || !isset($DATOS_EMPRESAS['DIRECCION']) || !isset($DATOS_EMPRESAS['SECTOR']) || !isset($DATOS_EMPRESAS['TIPO']))
            ||
            ($DATOS_EMPRESAS['NOMBRE'] == '' || $DATOS_EMPRESAS['ENCARGADO'] == '' || $DATOS_EMPRESAS['TELEFONO'] == '' || $DATOS_EMPRESAS['CORREO'] == '' || $DATOS_EMPRESAS['DIRECCION'] == '' || $DATOS_EMPRESAS['SECTOR'] == '' || $DATOS_EMPRESAS['TIPO'] == '')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->nombre = strtoupper($DATOS_EMPRESAS['NOMBRE']);
            $this->encargado = $DATOS_EMPRESAS['ENCARGADO'];
            $this->telefono = $DATOS_EMPRESAS['TELEFONO'];
            $this->correo = $DATOS_EMPRESAS['CORREO'];
            $this->direccion = strtoupper($DATOS_EMPRESAS['DIRECCION']);
            $this->sector = $DATOS_EMPRESAS['SECTOR'];
            $this->tipo = $DATOS_EMPRESAS['TIPO'];

            if ($this->insertarEmpresa()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Empresa añadida correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al añadir empresa';

                return $result;
            }
        }
    }

    public function put($json)
    {
        $DATOS_EMPRESAS = json_decode($json, true);
        if (
            (!isset($DATOS_EMPRESAS['ID_EMPRESA']) || !isset($DATOS_EMPRESAS['NOMBRE']) || !isset($DATOS_EMPRESAS['ENCARGADO']) || !isset($DATOS_EMPRESAS['TELEFONO']) || !isset($DATOS_EMPRESAS['TELEFONO']) || !isset($DATOS_EMPRESAS['CORREO']) || !isset($DATOS_EMPRESAS['DIRECCION']) || !isset($DATOS_EMPRESAS['SECTOR']) || !isset($DATOS_EMPRESAS['TIPO']))
            ||
            ($DATOS_EMPRESAS['ID_EMPRESA'] == '' || $DATOS_EMPRESAS['NOMBRE'] == '' || $DATOS_EMPRESAS['ENCARGADO'] == '' || $DATOS_EMPRESAS['TELEFONO'] == '' || $DATOS_EMPRESAS['CORREO'] == '' || $DATOS_EMPRESAS['DIRECCION'] == '' || $DATOS_EMPRESAS['SECTOR'] == '' || $DATOS_EMPRESAS['TIPO'] == '')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->idEmpresa = $DATOS_EMPRESAS['ID_EMPRESA'];
            $this->nombre = $DATOS_EMPRESAS['NOMBRE'];
            $this->encargado = $DATOS_EMPRESAS['ENCARGADO'];
            $this->telefono = $DATOS_EMPRESAS['TELEFONO'];
            $this->correo = $DATOS_EMPRESAS['CORREO'];
            $this->direccion = $DATOS_EMPRESAS['DIRECCION'];
            $this->sector = $DATOS_EMPRESAS['SECTOR'];
            $this->tipo = $DATOS_EMPRESAS['TIPO'];

            if ($this->actualizarEmpresa()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Empresa actualizada correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al actualizar empresa';

                return $result;
            }
        }
    }

    public function delete($json){
        $ELIMINAR= json_decode($json, true);

        if(!isset($ELIMINAR['ID_EMPRESA']) || $ELIMINAR['ID_EMPRESA']==''){

            $result['status'] = 'ERROR';
            $result['mensaje'] = 'NO SE ENCONTRO EL ID';

            return $result;

        }else{
            $this->idEmpresa = $ELIMINAR['ID_EMPRESA'];

            if($this->eliminarEmpresa()){
                $result['status'] = 'OK';
                $result['mensaje'] = 'Empresa Eliminada';

                return $result;
            }else{

                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al eliminar';

                return $result;

            }
        }
    }



    private function insertarEmpresa()
    {

        $INSERTAR_EMPRESA = " INSERT INTO empresa (NOMBRE, ENCARGADO, TELEFONO, CORREO, DIRECCION, SECTOR, TIPO) VALUES ('$this->nombre', '$this->encargado', '$this->telefono', '$this->correo', '$this->direccion', '$this->sector', '$this->tipo') ";

        $result = $this->conexion->ejecutor($INSERTAR_EMPRESA);

        return $result;
    }

    private function actualizarEmpresa()
    {

        $ACTUALIZAR_EMPRESA = " UPDATE empresa SET NOMBRE= '$this->nombre',ENCARGADO='$this->encargado', TELEFONO='$this->telefono', CORREO='$this->correo', DIRECCION='$this->direccion', SECTOR='$this->sector', TIPO='$this->tipo' WHERE ID_EMPRESA='$this->idEmpresa'";

        $result = $this->conexion->ejecutor($ACTUALIZAR_EMPRESA);

        return $result;
    }

    private function eliminarEmpresa()
    {

        $ELIMINAR_EMPRESA = "UPDATE empresa SET ESTADO='BAJA' WHERE ID_EMPRESA='$this->idEmpresa'";

        $result = $this->conexion->ejecutor($ELIMINAR_EMPRESA);

        return $result;
    }

    public function selectEmpresa(){
        $CONSULTA_EMPRESAS = "SELECT ID_EMPRESA, NOMBRE FROM empresa;";
        $CONSULTA_EMPRESAS = $this->conexion->ejecutor($CONSULTA_EMPRESAS);
        if ($CONSULTA_EMPRESAS) {
            while ($row_ae = mysqli_fetch_array($CONSULTA_EMPRESAS)) {
                $id = $row_ae['ID_EMPRESA'];
                $nombre = $row_ae['NOMBRE'];

                echo '<option value=' . $id . '>' . $nombre . '</option>';
            }
        }
    }

    public function obtenerEmpresas($condicion)
    {
        $CONSULTA_TOTAL = "SELECT
   COUNT(*) AS TOTAL
FROM
    `viculacion`.`empresa`
     WHERE `ESTADO`= 'activo' and `NOMBRE` LIKE '%$condicion%' OR `SECTOR` LIKE '%$condicion%' OR `ENCARGADO` LIKE '%$condicion%'";

        $CONSULTA_TOTAL = $this->conexion->ejecutor($CONSULTA_TOTAL);

        if ($CONSULTA_TOTAL) {
            $CONSULTA_TOTAL = $CONSULTA_TOTAL->fetch_assoc();

            if ($CONSULTA_TOTAL['TOTAL'] > 0) {
                $OBTENER_EMPRESAS = "SELECT
   `ID_EMPRESA`
    , `NOMBRE`
    , `SECTOR`
    , `CORREO`
    , `TELEFONO`
    ,`ENCARGADO`
    ,`DIRECCION`
FROM
    `viculacion`.`empresa`
    WHERE `ESTADO`= 'activo' AND (`NOMBRE` LIKE '%$condicion%' OR `SECTOR` LIKE '%$condicion%' OR `ENCARGADO` LIKE '%$condicion%')";

                $result = $this->conexion->ejecutor($OBTENER_EMPRESAS);

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

        while ($empresa = $result->fetch_assoc()) {
            $respuesta[$empresa['ID_EMPRESA']] = array(
                'nombre' => $empresa['NOMBRE'], 'sector' => $empresa['SECTOR'], 'correo' => $empresa['CORREO'], 'telefono' => $empresa['TELEFONO'], 'encargado' => $empresa['ENCARGADO'], 'direccion'=> $empresa['DIRECCION']
            );
        }

        return $respuesta;
    }
}

<?php

require_once "conexion.php";

class Convenio
{
    private $id_convenio;
    private $empresa_id;
    private $tipoconvenio_id;
    private $inicio_convenio;
    private $fin_convenio;
    private $nombreCategoria;

    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function delete($json)
    {

        $ELIMINAR = json_decode($json, true);

        if (!isset($ELIMINAR['ID_CONVENIO']) || $ELIMINAR['ID_CONVENIO'] == '') {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'No se encontro el id';

            return $respuesta;
        } else {
            $this->id_convenio = $ELIMINAR['ID_CONVENIO'];

            if ($this->eliminarConvenio()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Convenio eliminado';

                return $result;
            } else {

                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al eliminar el convenio';

                return $result;
            }
        }
    }

    public function post($json)
    {
        $DATOS_CONVENIO = json_decode($json, true);

        if ((!isset($DATOS_CONVENIO['EMPRESA_ID']) || !isset($DATOS_CONVENIO['TIPOCONVENIO_ID']) || !isset($DATOS_CONVENIO['INICIO_CONVENIO']) || !isset($DATOS_CONVENIO['FIN_CONVENIO']))
            ||
            ($DATOS_CONVENIO['EMPRESA_ID'] == '' || $DATOS_CONVENIO['TIPOCONVENIO_ID'] == '' || $DATOS_CONVENIO['INICIO_CONVENIO'] == '' || $DATOS_CONVENIO['FIN_CONVENIO'] == '')
        ) {

            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'datos incompletos';

            return $respuesta;
        } else {

            $this->empresa_id = $DATOS_CONVENIO['EMPRESA_ID'];
            $this->tipoconvenio_id = $DATOS_CONVENIO['TIPOCONVENIO_ID'];
            $this->inicio_convenio = $DATOS_CONVENIO['INICIO_CONVENIO'];
            $this->fin_convenio = $DATOS_CONVENIO['FIN_CONVENIO'];

            if ($this->insertarConvenio()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Convenio añadido correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al añadir convenio';

                return $result;
            }
        }
    }

    public function put($json)
    {
        $DATOS_CONVENIO = json_decode($json, true);

        if ((!isset($DATOS_CONVENIO['ID_CONVENIO']) || !isset($DATOS_CONVENIO['EMPRESA_ID']) || !isset($DATOS_CONVENIO['TIPOCONVENIO_ID']) || !isset($DATOS_CONVENIO['INICIO_CONVENIO']) || !isset($DATOS_CONVENIO['FIN_CONVENIO']))
            ||
            ($DATOS_CONVENIO['ID_CONVENIO'] == '' || $DATOS_CONVENIO['EMPRESA_ID'] == '' || $DATOS_CONVENIO['TIPOCONVENIO_ID'] == '' || $DATOS_CONVENIO['INICIO_CONVENIO'] == '' || $DATOS_CONVENIO['FIN_CONVENIO'] == '')
        ) {

            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'datos incompletos';

            return $respuesta;
        } else {

            $this->id_convenio = $DATOS_CONVENIO['ID_CONVENIO'];
            $this->empresa_id = $DATOS_CONVENIO['EMPRESA_ID'];
            $this->tipoconvenio_id = $DATOS_CONVENIO['TIPOCONVENIO_ID'];
            $this->inicio_convenio = $DATOS_CONVENIO['INICIO_CONVENIO'];
            $this->fin_convenio = $DATOS_CONVENIO['FIN_CONVENIO'];


            if ($this->actualizarConvenio()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'Convenio actualizado correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'Falló al actualizar convenio';

                return $result;
            }
        }
    }

    private function insertarConvenio()
    {

        $INSERTAR_CONVENIO = "INSERT INTO convenio (EMPRESA_ID, TIPOCONVENIO_ID, INICIO_CONVENIO, FIN_CONVENIO) VALUES ($this->empresa_id, $this->tipoconvenio_id, '$this->inicio_convenio', '$this->fin_convenio')";

        $result = $this->conexion->ejecutor($INSERTAR_CONVENIO);

        return $result;
    }

    private function actualizarConvenio()
    {

        $ACTUALIZAR_CONVENIO = "UPDATE convenio SET EMPRESA_ID= $this->empresa_id, TIPOCONVENIO_ID= $this->tipoconvenio_id, INICIO_CONVENIO= '$this->inicio_convenio', FIN_CONVENIO='$this->fin_convenio' WHERE ID_CONVENIO= $this->id_convenio";

        $result = $this->conexion->ejecutor($ACTUALIZAR_CONVENIO);

        return $result;
    }

    private function eliminarConvenio()
    {

        $ELIMINAR_CONVENIO = "DELETE FROM convenio WHERE ID_CONVENIO= $this->id_convenio";

        $result = $this->conexion->ejecutor($ELIMINAR_CONVENIO);

        return $result;
    }


    public function selectCategoria()
    {
        $OBTENER_CATEGORIA = "SELECT ID_TIPOCONVENIO, NOMBRE_CATEGORIA FROM cat_convenio;";
        $OBTENER_CATEGORIA = $this->conexion->ejecutor($OBTENER_CATEGORIA);
        if ($OBTENER_CATEGORIA) {
            while ($row_ae = mysqli_fetch_array($OBTENER_CATEGORIA)) {
                $this->id_convenio = $row_ae['ID_TIPOCONVENIO'];
                $this->nombreCategoria = $row_ae['NOMBRE_CATEGORIA'];

                echo '<option value="' . $this->id_convenio . '">' . $this->nombreCategoria . '</option>';
            }
        }
    }

    public function obtenerConvenios($condicion)
    {
        $CONSULTA_TOTAL = "SELECT
    COUNT(*) AS TOTAL
FROM
    `viculacion`.`convenio`
    INNER JOIN `viculacion`.`empresa` 
        ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`)
    WHERE `empresa`.`NOMBRE` LIKE '%$condicion%' OR `empresa`.`SECTOR` LIKE '%$condicion%'";

        $CONSULTA_TOTAL = $this->conexion->ejecutor($CONSULTA_TOTAL);

        if ($CONSULTA_TOTAL) {
            $CONSULTA_TOTAL = $CONSULTA_TOTAL->fetch_assoc();

            if ($CONSULTA_TOTAL['TOTAL'] > 0) {
                $OBTENER_CONVENIOS = "SELECT
    `convenio`.`ID_CONVENIO`
    , `empresa`.`NOMBRE`
    , `empresa`.`SECTOR`
    , `convenio`.`INICIO_CONVENIO`
    , `convenio`.`FIN_CONVENIO`
FROM
    `viculacion`.`convenio`
    INNER JOIN `viculacion`.`empresa` 
        ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`)
    WHERE `empresa`.`NOMBRE` LIKE  '%$condicion%'  OR `empresa`.`SECTOR` LIKE '%$condicion%'";

                $result = $this->conexion->ejecutor($OBTENER_CONVENIOS);

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

        while ($convenio = $result->fetch_assoc()) {

            $respuesta[$convenio['ID_CONVENIO']] = array(
                'empresa' => $convenio['NOMBRE'], 'sector' => $convenio['SECTOR'], 'duracion' => $convenio['INICIO_CONVENIO'] . ' - ' . $convenio['FIN_CONVENIO']
            );
        }

        return $respuesta;
    }
}

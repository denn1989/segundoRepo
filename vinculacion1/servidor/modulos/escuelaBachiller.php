<?php
require_once "conexion.php";

class EscuelaBachiller
{

    private $id_escuela;
    private $nombre_escuela;
    private $ubicacion;

    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function post($json)
    {
        $DATOS_ESCUELA = json_decode($json, true);

        if ((!isset($DATOS_ESCUELA['NOMBRE_ESCUELA']) || !isset($DATOS_ESCUELA['UBICACION']))
            ||
            ($DATOS_ESCUELA['NOMBRE_ESCUELA'] == '' || $DATOS_ESCUELA['UBICACION'] == '')
        ) {

            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'datos incompletos';

            return $respuesta;
        } else {

            $this->nombre_escuela = $DATOS_ESCUELA['NOMBRE_ESCUELA'];
            $this->ubicacion = $DATOS_ESCUELA['UBICACION'];

            if ($this->insertarEscuela()) {
                $respuesta['status'] = 'OK';
                $respuesta['mensaje'] = 'Escuela añadida correctamente';

                return $respuesta;
            } else {
                $respuesta['status'] = 'ERROR';
                $respuesta['mensaje'] = 'Falló al añadir escuela';

                return $respuesta;
            }
        }
    }

    public function put($json)
    {
        $DATOS_ESCUELA = json_decode($json, true);

        if ((!isset($DATOS_ESCUELA['ID_ESCUELA']) || !isset($DATOS_ESCUELA['NOMBRE_ESCUELA']) || !isset($DATOS_ESCUELA['UBICACION']))
            ||
            ($DATOS_ESCUELA['ID_ESCUELA'] == '' ||  $DATOS_ESCUELA['NOMBRE_ESCUELA'] == '' || $DATOS_ESCUELA['UBICACION'] == '')
        ) {

            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'datos incompletos';

            return $respuesta;
        } else {
            $this->id_escuela = $DATOS_ESCUELA['ID_ESCUELA'];
            $this->nombre_escuela = $DATOS_ESCUELA['NOMBRE_ESCUELA'];
            $this->ubicacion = $DATOS_ESCUELA['UBICACION'];

            if ($this->actualizarEscuela()) {
                $respuesta['status'] = 'OK';
                $respuesta['mensaje'] = 'Escuela actualizada correctamente';

                return $respuesta;
            } else {
                $respuesta['status'] = 'ERROR';
                $respuesta['mensaje'] = 'Falló al actualizar escuela';

                return $respuesta;
            }
        }
    }

    public function selectEscuela(){
        $CONSULTA_TOTAL = "SELECT ID_ESCUELA, NOMBRE_ESCUELA FROM escuela_bachiller;";
        $CONSULTA_TOTAL = $this->conexion->ejecutor($CONSULTA_TOTAL);
        if ($CONSULTA_TOTAL !== false) {
            while ($row_ae = mysqli_fetch_array($CONSULTA_TOTAL)) {
                $id = $row_ae['ID_ESCUELA'];
                $nombre = $row_ae['NOMBRE_ESCUELA'];

                echo '<option value="' . $id . '">' . $nombre . '</option>';
            }
        }
    }

    private function insertarEscuela()
    {
        $INSERTAR_ESCUELA = "INSERT INTO escuela_bachiller (NOMBRE_ESCUELA, UBICACION) VALUES ('$this->nombre_escuela', '$this->ubicacion')";

        $result = $this->conexion->ejecutor($INSERTAR_ESCUELA);

        return $result;
    }

    private function actualizarEscuela()
    {
        $ACTUALIZAR_ESCUELA = "UPDATE escuela_bachiller SET NOMBRE_ESCUELA='$this->nombre_escuela', UBICACION='$this->ubicacion' WHERE ID_ESCUELA=$this->id_escuela";

        $result = $this->conexion->ejecutor($ACTUALIZAR_ESCUELA);

        return $result;
    }

    private function eliminarEscuela()
    {
        $ELIMINAR_ESCUELA = "DELETE FROM escuela_bachiller WHERE ID_ESCUELA= $this->id_escuela";

        $result = $this->conexion->ejecutor($ELIMINAR_ESCUELA);

        return $result;
    }

    public function obtenerBachiller($condicion)
    {
        $CONSULTA_TOTAL = "SELECT COUNT(*) AS TOTAL 
FROM escuela_bachiller
WHERE NOMBRE_ESCUELA LIKE '%$condicion%'OR UBICACION LIKE '%$condicion%'";

        $CONSULTA_TOTAL = $this->conexion->ejecutor($CONSULTA_TOTAL);

        if ($CONSULTA_TOTAL) {
            $CONSULTA_TOTAL = $CONSULTA_TOTAL->fetch_assoc();

            if ($CONSULTA_TOTAL['TOTAL'] > 0) {
                $OBTENER_BACHILLER = "SELECT ID_ESCUELA, NOMBRE_ESCUELA, UBICACION
FROM escuela_bachiller
WHERE NOMBRE_ESCUELA LIKE '%$condicion%'OR UBICACION LIKE '%$condicion%'";

                $result = $this->conexion->ejecutor($OBTENER_BACHILLER);

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
                $respuesta['mensaje'] = 'Sin resultados';

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
        $respuesta= array();

        while ($bachiller= $result->fetch_assoc()) {
           $respuesta[$bachiller['ID_ESCUELA']]= array(
            'escuela'=>$bachiller['NOMBRE_ESCUELA'], 'ubicacion'=> $bachiller['UBICACION']
           );
        }

        return $respuesta;
    }
}

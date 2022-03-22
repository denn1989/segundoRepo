<?php
require_once "conexion.php";

class Residencia
{

    private $id_residencia;
    private $matricula;
    private $empresa_id;
    private $asesorext_id;
    private $asesorint_id;
    private $calificacion;
    private $fecha_inicio;
    private $fecha_fin;
    private $nombre_proyecto;
    private $estado;

    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function postDatos($json)
    {

        $DATOS_RESIDENCIA = json_decode($json, true);

        if (
            (!isset($DATOS_RESIDENCIA['MATRICULA']) || !isset($DATOS_RESIDENCIA['EMPRESA_ID']) || !isset($DATOS_RESIDENCIA['ASESOREXT_ID']) || !isset($DATOS_RESIDENCIA['ASESORINT_ID']) || !isset($DATOS_RESIDENCIA['CALIFICACION']) || !isset($DATOS_RESIDENCIA['FECHA_INICIO']) || !isset($DATOS_RESIDENCIA['FECHA_FIN']) || !isset($DATOS_RESIDENCIA['NOMBRE_PROYECTO']))
            ||
            ($DATOS_RESIDENCIA['MATRICULA'] == '' || $DATOS_RESIDENCIA['EMPRESA_ID'] == '' || $DATOS_RESIDENCIA['ASESOREXT_ID'] == '' || $DATOS_RESIDENCIA['ASESORINT_ID'] == '' || $DATOS_RESIDENCIA['CALIFICACION'] == '' || $DATOS_RESIDENCIA['FECHA_INICIO'] == '' || $DATOS_RESIDENCIA['FECHA_FIN'] == '' || $DATOS_RESIDENCIA['NOMBRE_PROYECTO'] == '')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {
            $this->matricula = $DATOS_RESIDENCIA['MATRICULA'];
            $this->empresa_id = $DATOS_RESIDENCIA['EMPRESA_ID'];
            $this->asesorext_id = $DATOS_RESIDENCIA['ASESOREXT_ID'];
            $this->asesorint_id = $DATOS_RESIDENCIA['ASESORINT_ID'];
            $this->calificacion = $DATOS_RESIDENCIA['CALIFICACION'];
            $this->fecha_inicio = $DATOS_RESIDENCIA['FECHA_INICIO'];
            $this->fecha_fin = $DATOS_RESIDENCIA['FECHA_FIN'];
            $this->nombre_proyecto = $DATOS_RESIDENCIA['NOMBRE_PROYECTO'];
          

            $CONSULTA_EXISTE = "SELECT COUNT(*) AS TOTAL FROM `residencia` WHERE `MATRICULA` = $this->matricula";

            $CONSULTA_EXISTE = $this->conexion->ejecutor($CONSULTA_EXISTE);

            if ($CONSULTA_EXISTE) {
                $CONSULTA_EXISTE = $CONSULTA_EXISTE->fetch_assoc();
                if ($CONSULTA_EXISTE['TOTAL'] > 0) {

                    $result['status'] = 'ERROR';
                    $result['mensaje'] = 'La residencia ya existe';

                    return $result;
                } else {
                    if ($this->insertarResidencia()) {
                        $result['status'] = 'OK';
                        $result['mensaje'] = 'Residencia añadido correctamente';

                        return $result;
                    } else {
                        $result['status'] = 'ERROR';
                        $result['mensaje'] = 'fallo al añadir recidencia';

                        return $result;
                    }
                }
            } else {

                $result['status'] = 'ERROR';
                $result['mensaje'] = 'fallo al consultar existencia';

                return $result;
            }
        }
    }

    public function put($json)
    {

        $DATOS_RESIDENCIA = json_decode($json, true);

        if (
            (!isset($DATOS_RESIDENCIA['ID_RESIDENCIA']) || !isset($DATOS_RESIDENCIA['EMPRESA_ID']) || !isset($DATOS_RESIDENCIA['ASESOREXT_ID']) || !isset($DATOS_RESIDENCIA['ASESORINT_ID']) || !isset($DATOS_RESIDENCIA['CALIFICACION']) || !isset($DATOS_RESIDENCIA['FECHA_INICIO']) || !isset($DATOS_RESIDENCIA['FECHA_FIN']) || !isset($DATOS_RESIDENCIA['NOMBRE_PROYECTO']) || !isset($DATOS_RESIDENCIA['ESTADO']))
            ||
            ($DATOS_RESIDENCIA['ID_RESIDENCIA'] == '' || $DATOS_RESIDENCIA['EMPRESA_ID'] == '' || $DATOS_RESIDENCIA['ASESOREXT_ID'] == '' || $DATOS_RESIDENCIA['ASESORINT_ID'] == '' || $DATOS_RESIDENCIA['CALIFICACION'] == '' || $DATOS_RESIDENCIA['FECHA_INICIO'] == '' || $DATOS_RESIDENCIA['FECHA_FIN'] == '' || $DATOS_RESIDENCIA['NOMBRE_PROYECTO'] == '' || $DATOS_RESIDENCIA['ESTADO'] == '')
        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {

            $this->id_residencia = $DATOS_RESIDENCIA['ID_RESIDENCIA'];
            $this->matricula = $DATOS_RESIDENCIA['MATRICULA'];
            $this->empresa_id = $DATOS_RESIDENCIA['EMPRESA_ID'];
            $this->asesorext_id = $DATOS_RESIDENCIA['ASESOREXT_ID'];
            $this->asesorint_id = $DATOS_RESIDENCIA['ASESORINT_ID'];
            $this->calificacion = $DATOS_RESIDENCIA['CALIFICACION'];
            $this->fecha_inicio = $DATOS_RESIDENCIA['FECHA_INICIO'];
            $this->fecha_fin = $DATOS_RESIDENCIA['FECHA_FIN'];
            $this->nombre_proyecto = $DATOS_RESIDENCIA['NOMBRE_PROYECTO'];
            $this->estado = $DATOS_RESIDENCIA['ESTADO'];


            if ($this->actualizarResidencia()) {
                $result['status'] = 'OK';
                $result['mensaje'] = 'residencia actualizada correctamente';

                return $result;
            } else {
                $result['status'] = 'ERROR';
                $result['mensaje'] = 'fallo al actualizar residencia';

                return $result;
            }
        }
    }

    public function EliminarResidentePut($json)
    {
        $ELIMINAR = json_decode($json, true);

        if (
            (!isset($ELIMINAR['ID_RESIDENCIA']))
            ||
            ($ELIMINAR['ID_RESIDENCIA'] == '')

        ) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'Datos incompletos';

            return $respuesta;
        } else {

            $this->id_residencia = $ELIMINAR['ID_RESIDENCIA'];

            if ($this->eliminarResidencia()) {
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


    private function insertarResidencia()
    {
        $INSERTAR_RESIDENCIA = " INSERT INTO residencia (MATRICULA,EMPRESA_ID, ASESOREXT_ID, ASESORINT_ID, CALIFICACION, FECHA_INICIO, FECHA_FIN, NOMBRE_PROYECTO) VALUES ($this->matricula, $this->empresa_id, $this->asesorext_id, $this->asesorint_id, $this->calificacion, '$this->fecha_inicio', '$this->fecha_fin', '$this->nombre_proyecto' )";

        $result = $this->conexion->ejecutor($INSERTAR_RESIDENCIA);

        return $result;
    }

    private function actualizarResidencia()
    {

        $ACTUALIZAR_RESIDENCIA = "UPDATE residencia SET MATRICULA=$this->matricula, EMPRESA_ID=$this->empresa_id,
        ASESOREXT_ID=$this->asesorext_id, ASESORINT_ID=$this->asesorint_id, CALIFICACION=$this->calificacion, FECHA_INICIO='$this->fecha_inicio', FECHA_FIN='$this->fecha_fin', NOMBRE_PROYECTO='$this->nombre_proyecto', ESTADO='$this->estado' WHERE ID_RESIDENCIA= $this->id_residencia;";

        $result = $this->conexion->ejecutor($ACTUALIZAR_RESIDENCIA);

        return $result;
    }

    private function eliminarResidencia()
    {

        $ELIMINAR_RESIDENCIA = "DELETE FROM residencia WHERE MATRICULA= $this->id_residencia";

        $result = $this->conexion->ejecutor($ELIMINAR_RESIDENCIA);

        return $result;
    }

    public function obtenerResidente($condicion)
    {
        $CONSULTA_TOTAL = "SELECT
 COUNT(*) AS total
FROM
    `viculacion`.`residencia`
    INNER JOIN `viculacion`.`estudiante` 
        ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`)
    INNER JOIN `viculacion`.`carrera`  
        ON (`estudiante`.`CARRERA_ID` = `carrera`.`ID_CARRERA`)
        WHERE `residencia`.`ESTADO` = 'ACTIVO'
        AND 
        (`estudiante`.`MATRICULA` LIKE '%$condicion%' OR `estudiante`.`NOMBRE` LIKE '%$condicion%' 
        OR `estudiante`.`AP_MAT` LIKE '%$condicion%' OR `estudiante`.`AP_PAT` LIKE '%$condicion%' )";

        $CONSULTA_TOTAL = $this->conexion->ejecutor($CONSULTA_TOTAL);

        if ($CONSULTA_TOTAL) {
            $CONSULTA_TOTAL = $CONSULTA_TOTAL->fetch_assoc();
            if ($CONSULTA_TOTAL['total'] > 0) {
                $OBTENER_RESIDENTES = "SELECT
                                        `estudiante`.`MATRICULA`
                                            ,`estudiante`.`NOMBRE`
                                            , `estudiante`.`AP_MAT`
                                            , `estudiante`.`AP_PAT`
                                            , `carrera`.`NOMBRE` AS CARRERA
                                            , `estudiante`.`PERIODO`
                                            ,`estudiante`.`GENERO`
                                            , `residencia`.`NOMBRE_PROYECTO`
                                            ,`residencia`.`FECHA_INICIO`
                                            ,`residencia`.`FECHA_FIN`
                                            ,`residencia`.`CALIFICACION`
                                            ,`empresa`.`NOMBRE` as EMPRESA
                                            ,`empresa`.`SECTOR`
                                            ,`asesor_externo`.`NOMBRE` AS ASESOR_EXTERNO 
                                            ,`asesor_externo`.`AP_PAT` AS APELLIDO_P_EXTERNO
                                            ,`asesor_externo`.`AP_MAT` AS APELLIDO_M_EXTERNO
                                            ,`asesor_interno`.`NOMBRE` AS ASESOR_INTERNO
                                            ,`asesor_interno`.`AP_PAT` AS APELLIDO_P_INTERNO
                                            ,`asesor_interno`.`AP_MAT` AS APELLIDO_M_INTERNO

                                        FROM
                                            `viculacion`.`residencia`
                                            INNER JOIN `viculacion`.`estudiante` 
                                                ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`)
                                            INNER JOIN `viculacion`.`carrera` 
                                                ON (`estudiante`.`CARRERA_ID` = `carrera`.`ID_CARRERA`) 
                                            INNER JOIN `viculacion`.`empresa`
                                                ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`)
                                            INNER JOIN `viculacion`.`asesor_externo`
                                                ON (`residencia`.`ASESOREXT_ID` = `asesor_externo`.`ID_ASESOREXT`)
                                            INNER JOIN `viculacion`.`asesor_interno`
                                                ON (`residencia`.`ASESORINT_ID` = `asesor_interno`.`ID_ASESORINT`)
                                                WHERE `residencia`.`ESTADO` = 'ACTIVO' AND (`estudiante`.`MATRICULA` LIKE '%$condicion%' OR `estudiante`.`NOMBRE` LIKE '%$condicion%' 
                                                OR `estudiante`.`AP_MAT` LIKE '%$condicion%' OR `estudiante`.`AP_PAT` LIKE '%$condicion%' )";

                $result = $this->conexion->ejecutor($OBTENER_RESIDENTES);

                if ($result) {


                    $paginas = intval($CONSULTA_TOTAL['total'] / 15);
                    $modulo =  $CONSULTA_TOTAL['total'] % 15;

                    if ($modulo > 0) {
                        $paginas = $paginas + 1;
                    }

                    $respuesta['status'] = 'OK';
                    $respuesta['mensaje'] = 'consulta exitosa';
                    $respuesta['paginas'] = $paginas;
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

        //para paginacion
        //elementos maximos 15


        $respuesta = array();
        $elementos = array();
        $contador_elementos = 0;
        $contador_pagina = 1;

        while ($residente = $result->fetch_assoc()) {
            $contador_elementos++;
             
            $elementos[$contador_pagina][$residente['MATRICULA']] = array(
                'nombre' => $residente['NOMBRE'] . ' ' . $residente['AP_PAT'] . ' ' . $residente['AP_MAT'],
                'carrera' => $residente['CARRERA'],
                'periodo' => $residente['PERIODO'],
                'nombre_proyecto' => $residente['NOMBRE_PROYECTO'],
                'fecha_inicio' => $residente['FECHA_INICIO'],
                'fecha_fin' => $residente['FECHA_FIN'],
                'calificacion' => $residente['CALIFICACION'],
                'empresa' => $residente['EMPRESA'],
                'sector' => $residente['SECTOR'],
                'asesor_externo' => $residente['ASESOR_EXTERNO'] . ' ' . $residente['APELLIDO_P_EXTERNO'] . ' ' . $residente['APELLIDO_M_EXTERNO'],
                'asesor_interno' => $residente['ASESOR_INTERNO'] . ' ' . $residente['APELLIDO_P_INTERNO'] . ' ' . $residente['APELLIDO_M_INTERNO'],
                'genero' => $residente['GENERO'] == '' ? 'No selecciono' : $residente['GENERO']
            );



            if ($contador_elementos == 15) {
                // $respuesta[$contador_pagina] = $elementos;
                // $contador_elementos = 0;
                // $elementos = array();
                $contador_pagina++;
            }


            // $contador++;

            //   if($contador==15){

            //   }
            // $respuesta[$contador] = array( 'matricula'=>$residente['MATRICULA'],
            //     'nombre' => $residente['NOMBRE'] . ' ' . $residente['AP_PAT'] . ' ' . $residente['AP_MAT'],
            //     'carrera' => $residente['CARRERA'],
            //     'periodo' => $residente['PERIODO'],
            //     'nombre_proyecto' => $residente['NOMBRE_PROYECTO'],
            //     'fecha_inicio' => $residente['FECHA_INICIO'],
            //     'fecha_fin' => $residente['FECHA_FIN'],
            //     'calificacion' => $residente['CALIFICACION'],
            //     'empresa' => $residente['EMPRESA'],
            //     'sector' => $residente['SECTOR'],
            //     'asesor_externo' => $residente['ASESOR_EXTERNO'] . ' ' . $residente['APELLIDO_P_EXTERNO'] . ' ' . $residente['APELLIDO_M_EXTERNO'],
            //     'asesor_interno' => $residente['ASESOR_INTERNO'] . ' ' . $residente['APELLIDO_P_INTERNO'] . ' ' . $residente['APELLIDO_M_INTERNO'],
            //     'genero' => $residente['GENERO'] == '' ? 'No selecciono' : $residente['GENERO'],
            //     'paginas'=>$paginas

            // );
        }
        $respuesta = $elementos;
        return $respuesta;
    }
}

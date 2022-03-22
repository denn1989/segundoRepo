<?php
require_once "conexion.php";

class Estadistica
{


    private $CONEXION;



    public function __construct()
    {
        $this->CONEXION = new Conexion();
    }

    public function obtenerDatosResidencias()
    {

        $CONSULTA_MUJERES_PUBLICO = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalMP  FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'publico' AND `estudiante`.`GENERO` ='femenino')";
        $CONSULTA_MUJERES_PUBLICO = $this->CONEXION->ejecutor($CONSULTA_MUJERES_PUBLICO);
        $CONSULTA_MUJERES_PUBLICO = $CONSULTA_MUJERES_PUBLICO->fetch_assoc();


        $CONSULTA_HOMBRES_PUBLICO = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalHP FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'publico' AND `estudiante`.`GENERO` ='masculino')";
        $CONSULTA_HOMBRES_PUBLICO = $this->CONEXION->ejecutor($CONSULTA_HOMBRES_PUBLICO);
        $CONSULTA_HOMBRES_PUBLICO = $CONSULTA_HOMBRES_PUBLICO->fetch_assoc();

        $CONSULTA_TOTAL_PUBLICO = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalP FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'publico')";
        $CONSULTA_TOTAL_PUBLICO = $this->CONEXION->ejecutor($CONSULTA_TOTAL_PUBLICO);
        $CONSULTA_TOTAL_PUBLICO = $CONSULTA_TOTAL_PUBLICO->fetch_assoc();

        $CONSULTA_MUJERES_SOCIAL = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalMS FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'social' AND `estudiante`.`GENERO` ='femenino')";
        $CONSULTA_MUJERES_SOCIAL = $this->CONEXION->ejecutor($CONSULTA_MUJERES_SOCIAL);
        $CONSULTA_MUJERES_SOCIAL = $CONSULTA_MUJERES_SOCIAL->fetch_assoc();


        $CONSULTA_HOMBRES_SOCIAL = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalHS  FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'social' AND `estudiante`.`GENERO` ='masculino')";
        $CONSULTA_HOMBRES_SOCIAL = $this->CONEXION->ejecutor($CONSULTA_HOMBRES_SOCIAL);
        $CONSULTA_HOMBRES_SOCIAL = $CONSULTA_HOMBRES_SOCIAL->fetch_assoc();

        $CONSULTA_TOTAL_SOCIAL = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalS FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'social')";
        $CONSULTA_TOTAL_SOCIAL = $this->CONEXION->ejecutor($CONSULTA_TOTAL_SOCIAL);
        $CONSULTA_TOTAL_SOCIAL = $CONSULTA_TOTAL_SOCIAL->fetch_assoc();

        $CONSULTA_MUJERES_PRIVADO = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalMPR FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'privado' AND `estudiante`.`GENERO` ='femenino')";
        $CONSULTA_MUJERES_PRIVADO = $this->CONEXION->ejecutor($CONSULTA_MUJERES_PRIVADO);
        $CONSULTA_MUJERES_PRIVADO = $CONSULTA_MUJERES_PRIVADO->fetch_assoc();

        $CONSULTA_HOMBRES_PRIVADO = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalHPR FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'privado' AND `estudiante`.`GENERO` ='masculino')";
        $CONSULTA_HOMBRES_PRIVADO = $this->CONEXION->ejecutor($CONSULTA_HOMBRES_PRIVADO);
        $CONSULTA_HOMBRES_PRIVADO = $CONSULTA_HOMBRES_PRIVADO->fetch_assoc();

        $CONSULTA_TOTAL_PRIVADO = "SELECT COUNT(`residencia`.`MATRICULA`) AS totalPR FROM `viculacion`.`residencia` INNER JOIN `viculacion`.`empresa` ON (`residencia`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) INNER JOIN `viculacion`.`estudiante` ON (`residencia`.`MATRICULA` = `estudiante`.`MATRICULA`) WHERE (`empresa`.`SECTOR` = 'privado')";
        $CONSULTA_TOTAL_PRIVADO = $this->CONEXION->ejecutor($CONSULTA_TOTAL_PRIVADO);
        $CONSULTA_TOTAL_PRIVADO = $CONSULTA_TOTAL_PRIVADO->fetch_assoc();



        if (empty($CONSULTA_MUJERES_PUBLICO) || empty($CONSULTA_HOMBRES_PUBLICO) || empty($CONSULTA_MUJERES_SOCIAL) || empty($CONSULTA_HOMBRES_SOCIAL) || empty($CONSULTA_MUJERES_PRIVADO) || empty($CONSULTA_HOMBRES_PRIVADO)) {
            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'no hay elementos';

            return $respuesta;
        } else {
            $respuesta['status'] = 'OK';
            $respuesta['mensaje'] = 'exito';
            $respuesta['data'] = array(
                'sectores' => array(
                    'publico' => array(
                        'mujeres' => $CONSULTA_MUJERES_PUBLICO['totalMP'],
                        'hombres' => $CONSULTA_HOMBRES_PUBLICO['totalHP'],
                        'total' => $CONSULTA_TOTAL_PUBLICO['totalP']
                    ),
                    'social' => array(
                        'mujeres' => $CONSULTA_MUJERES_SOCIAL['totalMS'],
                        'hombres' => $CONSULTA_HOMBRES_SOCIAL['totalHS'],
                        'total' => $CONSULTA_TOTAL_SOCIAL['totalS']
                    ),
                    'privado' => array(
                        'mujeres' => $CONSULTA_MUJERES_PRIVADO['totalMPR'],
                        'hombres' => $CONSULTA_HOMBRES_PRIVADO['totalHPR'],
                        'total' => $CONSULTA_TOTAL_PRIVADO['totalPR']
                    )
                )
            );
            return $respuesta;
        }
    }

    public function obtenerDatosConvenios()
    {
        $CONSULTA_TIPO1 = "SELECT COUNT(*) AS TOTALT1 FROM convenio WHERE TIPOCONVENIO_ID='1'";
        $CONSULTA_TIPO1 = $this->CONEXION->ejecutor($CONSULTA_TIPO1);
        $CONSULTA_TIPO1 = $CONSULTA_TIPO1->fetch_assoc();

        $CONSULTA_TIPO2 = "SELECT COUNT(*) AS TOTALT2 FROM convenio WHERE TIPOCONVENIO_ID='2'";
        $CONSULTA_TIPO2 = $this->CONEXION->ejecutor($CONSULTA_TIPO2);
        $CONSULTA_TIPO2 = $CONSULTA_TIPO2->fetch_assoc();

        $CONSULTA_TIPO3_NACIONAL = "SELECT COUNT(*) AS TOTALT3N FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa`  ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `convenio`.`TIPOCONVENIO_ID`='3' AND `empresa`.`TIPO`='NACIONAL'";
        $CONSULTA_TIPO3_NACIONAL = $this->CONEXION->ejecutor($CONSULTA_TIPO3_NACIONAL);
        $CONSULTA_TIPO3_NACIONAL = $CONSULTA_TIPO3_NACIONAL->fetch_assoc();

        $CONSULTA_TIPO3_INTERNACIONAL = "SELECT COUNT(*) AS TOTALT3I FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa`  ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `convenio`.`TIPOCONVENIO_ID`='3' AND `empresa`.`TIPO`='INTERNACIONAL'";
        $CONSULTA_TIPO3_INTERNACIONAL = $this->CONEXION->ejecutor($CONSULTA_TIPO3_INTERNACIONAL);
        $CONSULTA_TIPO3_INTERNACIONAL = $CONSULTA_TIPO3_INTERNACIONAL->fetch_assoc();

        $CONSULTA_TIPO3_TOTAL = "SELECT COUNT(*) AS TOTALT3T FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa`  ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `convenio`.`TIPOCONVENIO_ID`='3'";
        $CONSULTA_TIPO3_TOTAL = $this->CONEXION->ejecutor($CONSULTA_TIPO3_TOTAL);
        $CONSULTA_TIPO3_TOTAL = $CONSULTA_TIPO3_TOTAL->fetch_assoc();

        $CONSULTA_TIPO4_PUBLICO_NACIONAL = "SELECT COUNT(*) AS TOTAL_PUB_NACIONAL FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='PUBLICO' AND `empresa`.`TIPO`='NACIONAL';";
        $CONSULTA_TIPO4_PUBLICO_NACIONAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_PUBLICO_NACIONAL);
        $CONSULTA_TIPO4_PUBLICO_NACIONAL = $CONSULTA_TIPO4_PUBLICO_NACIONAL->fetch_assoc();

        $CONSULTA_TIPO4_SOCIAL_NACIONAL = "SELECT COUNT(*) AS TOTAL_SOC_NACIONAL FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='SOCIAL' AND `empresa`.`TIPO`='NACIONAL';";
        $CONSULTA_TIPO4_SOCIAL_NACIONAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_SOCIAL_NACIONAL);
        $CONSULTA_TIPO4_SOCIAL_NACIONAL = $CONSULTA_TIPO4_SOCIAL_NACIONAL->fetch_assoc();

        $CONSULTA_TIPO4_PRIVADO_NACIONAL = "SELECT COUNT(*) AS TOTAL_PRIV_NACIONAL FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='PRIVADO' AND `empresa`.`TIPO`='NACIONAL';";
        $CONSULTA_TIPO4_PRIVADO_NACIONAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_PRIVADO_NACIONAL);
        $CONSULTA_TIPO4_PRIVADO_NACIONAL = $CONSULTA_TIPO4_PRIVADO_NACIONAL->fetch_assoc();

        $CONSULTA_TIPO4_PUBLICO_INTERNACIONAL = "SELECT COUNT(*) AS TOTAL_PUB_INTERNACIONAL FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='PUBLICO' AND `empresa`.`TIPO`='INTERNACIONAL';";
        $CONSULTA_TIPO4_PUBLICO_INTERNACIONAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_PUBLICO_INTERNACIONAL);
        $CONSULTA_TIPO4_PUBLICO_INTERNACIONAL = $CONSULTA_TIPO4_PUBLICO_INTERNACIONAL->fetch_assoc();

        $CONSULTA_TIPO4_SOCIAL_INTERNACIONAL = "SELECT COUNT(*) AS TOTAL_SOC_INTERNACIONAL FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='SOCIAL' AND `empresa`.`TIPO`='INTERNACIONAL';";
        $CONSULTA_TIPO4_SOCIAL_INTERNACIONAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_SOCIAL_INTERNACIONAL);
        $CONSULTA_TIPO4_SOCIAL_INTERNACIONAL = $CONSULTA_TIPO4_SOCIAL_INTERNACIONAL->fetch_assoc();

        $CONSULTA_TIPO4_PRIVADO_INTERNACIONAL = "SELECT COUNT(*) AS TOTAL_PRIV_INTERNACIONAL FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='PRIVADO' AND `empresa`.`TIPO`='INTERNACIONAL';";
        $CONSULTA_TIPO4_PRIVADO_INTERNACIONAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_PRIVADO_INTERNACIONAL);
        $CONSULTA_TIPO4_PRIVADO_INTERNACIONAL = $CONSULTA_TIPO4_PRIVADO_INTERNACIONAL->fetch_assoc();

        $CONSULTA_TIPO4_PUBLICO_TOTAL = "SELECT COUNT(*) AS TOTAL_PUBLICO FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='PUBLICO'";
        $CONSULTA_TIPO4_PUBLICO_TOTAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_PUBLICO_TOTAL);
        $CONSULTA_TIPO4_PUBLICO_TOTAL = $CONSULTA_TIPO4_PUBLICO_TOTAL->fetch_assoc();

        $CONSULTA_TIPO4_SOCIAL_TOTAL = "SELECT COUNT(*) AS TOTAL_SOCIAL FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='SOCIAL'";
        $CONSULTA_TIPO4_SOCIAL_TOTAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_SOCIAL_TOTAL);
        $CONSULTA_TIPO4_SOCIAL_TOTAL = $CONSULTA_TIPO4_SOCIAL_TOTAL->fetch_assoc();


        $CONSULTA_TIPO4_PRIVADO_TOTAL = "SELECT COUNT(*) AS TOTAL_PRIVADO FROM `viculacion`.`convenio` INNER JOIN `viculacion`.`empresa` ON (`convenio`.`EMPRESA_ID` = `empresa`.`ID_EMPRESA`) WHERE `empresa`.`SECTOR`='PRIVADO'";
        $CONSULTA_TIPO4_PRIVADO_TOTAL = $this->CONEXION->ejecutor($CONSULTA_TIPO4_PRIVADO_TOTAL);
        $CONSULTA_TIPO4_PRIVADO_TOTAL = $CONSULTA_TIPO4_PRIVADO_TOTAL->fetch_assoc();





        if (empty($CONSULTA_TIPO1) || empty($CONSULTA_TIPO2) || empty($CONSULTA_TIPO3_NACIONAL) || empty($CONSULTA_TIPO3_INTERNACIONAL) || empty($CONSULTA_TIPO3_TOTAL) || empty($CONSULTA_TIPO4_PUBLICO_NACIONAL) || empty($CONSULTA_TIPO4_SOCIAL_NACIONAL) || empty($CONSULTA_TIPO4_PRIVADO_NACIONAL) || empty($CONSULTA_TIPO4_PUBLICO_INTERNACIONAL) || empty($CONSULTA_TIPO4_SOCIAL_INTERNACIONAL) || empty($CONSULTA_TIPO4_PRIVADO_INTERNACIONAL) || empty($CONSULTA_TIPO4_PUBLICO_TOTAL) || empty($CONSULTA_TIPO4_SOCIAL_TOTAL) || empty($CONSULTA_TIPO4_PRIVADO_TOTAL)) {

            $respuesta['status'] = 'ERROR';
            $respuesta['mensaje'] = 'NO HAY ELEMENTOS';
       
            return $respuesta;
        }else{

            $respuesta['status'] = 'OK';
            $respuesta['mensaje'] = 'EXITO';
            $respuesta['data'] = array(
                'convenios' => array(
                    'tipo_1' => $CONSULTA_TIPO1['TOTALT1'],
                    'tipo_2' => $CONSULTA_TIPO2['TOTALT2'],
                    'tipo_3' => array(
                        'nacional' => $CONSULTA_TIPO3_NACIONAL['TOTALT3N'],
                        'internacional' => $CONSULTA_TIPO3_INTERNACIONAL['TOTALT3I'],
                        'total' => $CONSULTA_TIPO3_TOTAL['TOTALT3T']
                    ),
                    'tipo_4' => array(
                        'nacional' => array(
                            'publico' => $CONSULTA_TIPO4_PUBLICO_NACIONAL['TOTAL_PUB_NACIONAL'],
                            'social' => $CONSULTA_TIPO4_SOCIAL_NACIONAL['TOTAL_SOC_NACIONAL'],
                            'privado' => $CONSULTA_TIPO4_PRIVADO_NACIONAL['TOTAL_PRIV_NACIONAL']
                        ),
                        'internacional' => array(
                            'publico' => $CONSULTA_TIPO4_PUBLICO_INTERNACIONAL['TOTAL_PUB_INTERNACIONAL'],
                            'social' => $CONSULTA_TIPO4_SOCIAL_INTERNACIONAL['TOTAL_SOC_INTERNACIONAL'],
                            'privado' => $CONSULTA_TIPO4_PRIVADO_INTERNACIONAL['TOTAL_PRIV_INTERNACIONAL']
                        ),

                        'total' => array(
                            'publico' => $CONSULTA_TIPO4_PUBLICO_TOTAL['TOTAL_PUBLICO'],
                            'social' => $CONSULTA_TIPO4_SOCIAL_TOTAL['TOTAL_SOCIAL'],
                            'privado' => $CONSULTA_TIPO4_PRIVADO_TOTAL['TOTAL_PRIVADO']

                        )
                    )

                )
            );

            return $respuesta;
        }
    }
}


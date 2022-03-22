<?php 
    if($_POST){
        include('../../servidor/modulos/conexion.php');
        $SQL = new Conexion();

        $matricula = $_POST['matricula'];
        $query = "SELECT A.CARRERA_ID, CONCAT(A.NOMBRE, ' ', A.AP_PAT, ' ', A.AP_MAT) AS 'NOMBRE_COMPLETO' 
                FROM estudiante A 
                WHERE MATRICULA = '$matricula';";

        $result = $SQL->ejecutor($query);
        if($result !== false){
            if($result->num_rows > 0){
                if($row = mysqli_fetch_array($result)){
                    echo $row['NOMBRE_COMPLETO'];
                }else{
                    echo 'La matrícula no es válida';    
                }
            }else{
                echo 'La matrícula no es válida';
            }
        }
    }
?>
<?php

class Conexion{
    public $host;
    public $user;
    public $pass;
    public $dbName;
    public $con;

    public function __construct(){
        $this->host="localhost";
        $this->user="root";
        $this->pass="";
        $this->dbName="viculacion";

        $this->con= new mysqli($this->host, $this->user, $this->pass, $this->dbName);

         
   
        
    } 

    public function ejecutor($sql){
        $result= $this->con->query($sql);

        if($result){
            return $result;
        }else{
            return 0;
        }
    }
}

?>
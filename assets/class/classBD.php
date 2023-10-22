<?php
class BaseDate{

    var $conexion;
    var $bloque;
    var $numRegistros;
    var $error;

    function abrirConexion(){
        
        $this->conexion = mysqli_connect("localhost","AdminZoo","12345","Zoobd");

    }

    function CierreBD(){
        mysqli_close($this->conexion);
    }

    function consulta($p_query){
        $this->abrirConexion();
        
        $this -> bloque = mysqli_query($this -> conexion,$p_query);

        $this-> error = mysqli_error($this -> conexion);

        if ( strpos(strtoupper($p_query),"SELECT") !== false ) {
            //esta condicion solo es para los select
            $this -> numRegistros = mysqli_num_rows($this -> bloque);
        } 

        if (!$this -> bloque) {
            die('Error en la consulta: ' . mysqli_error($this->conexion));
        }

        
        $this->CierreBD();
    }

    function getTupla($p_query){
        $this -> consulta($p_query);
        return mysqli_fetch_object ($this -> bloque);
    }
}

$objBD = new BaseDate();
?>
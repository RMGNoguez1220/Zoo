<?php 
session_start();
include "assets/class/classBD.php";

if ( isset($_POST['Correo']) and isset($_POST['Clave']) ) {

    $regi = $objBD -> getTupla ("SELECT * FROM usuario WHERE Correo = '".$_POST['Correo']."' and Clave = MD5('".$_POST['Clave']."')");

    if ($objBD -> numRegistros) {
        $_SESSION['Nombre'] = $regi -> Nombre." ".$regi -> Apellidos;

        $_SESSION['isAdmin'] = ($regi -> idtipousuario == 2)? true : false;
        
        $_SESSION['Correo'] = $regi -> Email;
        
        $_SESSION['Id'] = $regi -> IdUsuario;
        
        if ($regi -> idtipousuario == 1) {
            header("location: users/home.php");
        } else {
            header("location: admin/home.php");
        }
    } else {
        header( "location: index.php?e=2");
    }

} else {
    header("location: index.php?e=1");
}

?>
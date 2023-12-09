<?php
session_start();

include 'cabecera.php';
include '../class/classUsuario.php';

if (!isset($_SESSION['Nombre'])) {

    header("location: ../index.php?e=11");
    exit;
}

?>

<div class="container-categoria">
    <?php
        if (isset($_REQUEST['accion'])) {

            echo $oUsuario -> ejecuta($_REQUEST['accion']);

        } else {
            
            echo $oUsuario -> ejecuta("Perfil");
        }
    ?>
</div>
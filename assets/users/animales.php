<?php
session_start();

include 'cabecera.php';
include '../class/classanimales.php';

if (isset($_SESSION['Nombre'])){
    
} else {
    header("location: ../index.php?e=11");
}
?>

<div class = "vistaAnimales">
    <?php
        if (isset($_REQUEST['accion'])) {
            echo $oAnimales -> ejecuta($_REQUEST['accion']);
        } else {
            echo $oAnimales -> ejecuta("list");
        }

    ?>
</div>

</body>
</html>
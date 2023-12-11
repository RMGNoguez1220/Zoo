<?php
session_start();

include 'cabecera.php';
include '../class/classrecorridos.php';

if (isset($_SESSION['Nombre'])){
    
} else {
    header("location: ../index.php?e=11");
}
?>

<div class = "vistaAnimales">
    <?php
        if (isset($_REQUEST['accion'])) {
            echo $oRecorridos -> ejecuta($_REQUEST['accion']);
        } else {
            echo $oRecorridos -> ejecuta("list");
        }

    ?>
</div>

</body>
</html>
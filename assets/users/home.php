<?php
session_start();

include 'cabecera.php';

if (isset($_SESSION['Nombre'])){
    
} else {
    header("location: ../index.php?e=11");
}
?>

</body>
</html>
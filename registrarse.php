<?php
include "assets/class/classBD.php";

session_start();

var_dump($_SESSION);
var_dump($_POST);


if($_POST['Captcha'] != $_SESSION['captcha']){

   header("location: index.php?e=102");

} else {

   $cadena = "abcdefghijkmnpqrstvwxyzABCDEFGHJKLMNPQRSTUVWXYZ2345678923456789_#";
   $numeC = strlen($cadena);
   $nuevPWD = "";

   for ( $i = 0; $i < 8; $i++ )
   $nuevPWD.=$cadena[rand()%$numeC]; 

   include("assets/recursos/class.phpmailer.php");
   include("assets/recursos/class.smtp.php");

   $mail = new PHPMailer();

   $mail -> IsSMTP();

   $mail -> Host = "smtp.gmail.com"; //mail.google
   $mail -> SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
   $mail -> Port = 465;     // set the SMTP port for the GMAIL server
   $mail -> SMTPDebug  = 0;  // enables SMTP debug information (for testing)
   $mail -> SMTPAuth = true;   //enable SMTP authentication

   $mail -> Username = "webluisgabriel@gmail.com"; // SMTP account username
   $mail -> Password = "rkbqitkbxnlzmvpw";  // SMTP account password
      
   $mail -> From = "";
   $mail -> FromName = "";
   $mail -> Subject = "Registro completo";
   $mail -> MsgHTML("<h1>BIENVENIDO ".$_POST['Nombre']." ".$_POST['Apellidos']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
   $mail -> AddAddress($_POST['Correo']);

   $cad = "INSERT INTO usuario SET 
         Nombre = '".$_POST['Nombre']."', 
         Apellidos = '".$_POST['Apellidos']."', 
         Correo = '".$_POST['Correo']."',
         Genero = '".$_POST['Sexo']."',
         FechaUltiAcceso = NOW(),  
         Clave = MD5('".$nuevPWD."'),
         CatUsuario_id = 1;";    

   if ( !$mail -> Send()) 

         echo  "Error: ".$mail->ErrorInfo;

   else {  
      
      $objBD -> consulta($cad);
      
      if($objBD -> error > "")
         echo $objBD -> error;
      else

      // Inicia sesión automáticamente
      session_start();
      $_SESSION['Nombre'] = $_POST['Nombre'] . " " . $_POST['Apellidos'];
      $_SESSION['isAdmin'] = false;
      $_SESSION['Correo'] = $_POST['Correo'];
      $_SESSION['Id'] = $idUsuario;
      
      header("location: index.php"); 
   }
}

?>
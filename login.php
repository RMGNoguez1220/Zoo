<?php
    session_start();
    include "assets/class/classTools.php";
    include "cabecera.php"
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="containers">
    <div class="Login-box" id="LoginMenu" >

        <h2>Login</h2>

        <form method = "post" action = "validar.php">

            <div class="user-box">
                <input type="email" name="Correo" required="">
                <label>Correo</label>
            </div>

            <div class="user-box">
                <input ID="txtPassword" type="password" name="Clave" required="">
                <label>Clave</label>
                <div class="input-group-append">
                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="bx bx-low-vision icon"></span> </button>
                </div>
            </div>

            <label class="label-form" style="margin-bottom: 10px;">Captcha</label>
            <div class="user-box">
                <input type="text" name="Captcha" required pattern="-?[0-9]+" title="Ingresa solo números" maxlength="5">
                <label>Cuanto es: <?php echo $oTools -> geneCaptcha()?></label>
            </div>

            <input type="hidden" name="form_type" value="Login">

            <input class="btn-form" id="button" type="submit" value="Login">
            
        </form>
    </div></div>
</body>
</html>
<script src="assets/js/validarcampo.js"></script>

<!-- Script para mostrar la contraseña -->
<script type="text/javascript">

    function mostrarPassword(){
        var cambio = document.getElementById("txtPassword");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('.icon').removeClass('bx bx-low-vision').addClass('bx bx-show');
        }else{
            cambio.type = "password";
            $('.icon').removeClass('bx bx-show').addClass('bx bx-low-vision');
        }
    } 
        
        $(document).ready(function () {
        //CheckBox mostrar contraseña
        $('#ShowPassword').click(function () {
            $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });
    });
</script>
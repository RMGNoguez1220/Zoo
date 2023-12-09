<?php
    session_start();
    include "assets/class/classTools.php";
    include "cabecera.php"
?>
    <div class="containers" >
    <div class="Login-box" id="LoginMenu" >

        <h2>Registro</h2>

        <form method = "post" action = "registrarse.php">

            <div class="user-box">
                <input type="text" name="Nombre" required="">
                <label>Nombre</label>
            </div>

            <div class="user-box">
                <input type="text" name="Apellidos" required="">
                <label>Apellidos</label>
            </div>

            <div class="user-box">
                <input type="email" name="Correo" required="">
                <label>Correo</label>
            </div>

            <label class="label-form">Genero</label>
            <div class="genero">
                <label class="opcion">
                    <input type="radio" name="Sexo" value="hombre"> <span> Hombre </span>
                </label>
                <label class="opcion">
                    <input type="radio" name="Sexo" value="mujer"> <span> Mujer </span>
                </label>
                <label class="opcion">
                    <input type="radio" name="Sexo" value="indefinido"> <span> Indefinido </span>
                </label>
            </div>

            <label class="label-form" style="margin-bottom: 10px;">Captcha</label>
            <div class="user-box">
                <input type="text" name="Captcha" required pattern="-?[0-9]+" title="Ingresa solo números" maxlength="5">
                <label>Cuanto es: <?php echo $oTools -> geneCaptcha()?></label>
            </div>

            <input type="hidden" name="form_type" value="registro">

            <input class="btn-form" id="button" type="submit" value="Registrarse">
        </form>
    </div></div>
</body>
</html>
<script src="assets/js/validarcampo.js"></script>

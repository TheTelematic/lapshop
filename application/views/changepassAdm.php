<div class="contenidoSection">
    <h2 class="tituloSection">Cambiar contraseña</h2>
     <?php if(isset($mensaje)){
            echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
        }else{
            echo validation_errors();
        }?>
   
    <form action="<?php echo base_url();?>index.php/Admins/changePass/<?php echo $id?>" method="post">


        <label id="cambiarPass">Cambiar contraseña</label><br>
        <div class="dato"><span for="perfil_new_pass">Nueva contraseña:</span><input type="password" name="perfil_new_pass" id="perfil_new_pass" size="30" title="Nueva contraseña" disabled><span id="error_new_pass" hidden>La contraseña debe tener al menos 6 caracteres, incluyendo un signo de puntuación, un numero y mayusculas</span>
        <span for="perfil_new_pass2">Repita nueva contraseña:</span><input type="password" id="perfil_new_pass2" size="30" title="Repetir nueva contraseña" disabled><span id="pass_not_matched" hidden>No coincide</span></div><br>
        
        <div id="dato"><span for="perfil_pass">Su contraseña:</span><input type="password" name="perfil_pass" id="perfil_pass" size="30" title="Su contraseña"></div>
        <input type="submit" value="Cambiar contraseña">
    </form>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/perfil.js"></script>
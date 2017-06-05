<?php
$email = $usuario->usr_email;
$id = $usuario->usr_id; 
?>
<div class="contenidoSectionAdmin">
    <h2 class="tituloSection">Elevar a <?php echo $email; ?></h2>    
    <form action="<?php echo base_url();?>index.php/Admins/doAdmUser/0" method="post">
        <div id="dato"><span for="perfil_pass">Su contraseña:</span><input type="password" name="pass" id="perfil_pass" size="30" title="Su contraseña"></div>
        <span for="_email_">Hacer administrador a :</span><input type="submit" id="_email_" name="_email_" value="<?php echo $email;?>">
        
    </form>
</div>
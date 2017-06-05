<?php
$email = $usuario->usr_email;
$id = $usuario->usr_id; 
?>
<div class="contenidoSectionAdmin">
    <h2 class="tituloSection">Borrar a <?php echo $email; ?></h2>    

    <form action="<?php echo base_url();?>index.php/Admins/removeUser/0" method="post">
        <div id="dato"><span for="perfil_pass">Su contraseña:</span><input type="password" name="pass" id="perfil_pass" size="30" title="Su contraseña"  ></div>
        <span for="_email_" style="color: red;">Eliminar usuario :</span><input type="submit" id="_email_2" name="_email_" value="<?php echo $email;?>" >
    </form>
</div>
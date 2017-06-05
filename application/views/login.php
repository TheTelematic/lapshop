<div class="contenidoSection">
    <h2 class="tituloSection">
        Login
    </h2>
    <?php if(isset($respuesta)){
            echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$respuesta</div>";
        }
        ?>
    <div class="login">
        <form action="<?php echo base_url();?>index.php/Login" method="post">
            <?php 
            if(!isset($mensaje_error)){
                echo validation_errors();
            }else{
                echo '<div style="color: red; font-size: 6em; border: 3px red solid;">FATAL_ERROR: '.$mensaje_error.'</div>';
            }
            ?>
            <input type="email" id="email" name="usr_email" placeholder="Email" style="padding: 5px; margin: 5px;" <?php if(isset($email)){ echo "value=\"".$email."\"";}else{echo "autofocus";}?>><br>
            <input type="password" id="pass" name="pass" placeholder="Contraseña" <?php if(isset($email)){echo "autofocus";}?>><br>
            <input type="submit" id="contactar" value="Enviar" style="padding: 5px; margin: 5px;">
            <a href="<?php echo base_url();?>index.php/Login/registro">Registro -></a>
            
        </form>
        <form action="<?php echo base_url();?>index.php/Login/rememberPass" method="post">
            <input type="email" name="email" placeholder="Ponga su email si olvido la contraseña">
            <input type="submit" value="Recordar contraseña">
        </form>
    </div>
</div>
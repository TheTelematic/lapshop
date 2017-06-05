<?php 

$nombre = $usuario->usr_nombre; 
$apellido = $usuario->usr_apellido;
$direccion = $usuario->usr_direccion; 
$ciudad = $usuario->usr_ciudad; 
$cp = $usuario->usr_cp; 
$email = $usuario->usr_email; 
//$pass = $this->session->userdata('usr_pass'); 
//$nivel = $this->session->userdata('usr_nivel');
$id = $usuario->usr_id; 
?>
<div class="contenidoSectionUser">
    <h2 class="tituloSection">Usuario <?php echo $email; ?></h2>
        <?php if(isset($mensaje)){
            echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
        }else{
            echo validation_errors();
        }?>
    
    <button value="Desbloquear" id="unlock">Desbloquear</button>
    
        <form action="<?php echo base_url();?>index.php/Admins/modify/<?php echo $id;?>" method="post">
    
        <div class="dato"><span for="perfil_nombre">Nombre:</span><input type="text" name="perfil_nombre" id="perfil_nombre" size="30" title="Nombre" value="<?php echo $nombre;?>" disabled></div><br>
        <div class="dato"><span for="perfil_apellido">Apellido:</span><input type="text" name="perfil_apellido" id="perfil_apellido" size="30" title="Apellido" value="<?php echo $apellido;?>" disabled></div><br>
        <div class="dato"><span for="perfil_direccion">Direccion:</span><input type="text" name="perfil_direccion" id="perfil_direccion" size="30" title="Direccion" value="<?php echo $direccion;?>" disabled></div><br>
        <div class="dato"><span for="perfil_ciudad">Ciudad:</span><input type="text" name="perfil_ciudad" id="perfil_ciudad" size="30" title="Ciudad" value="<?php echo $ciudad;?>" disabled></div><br>
        <div class="dato"><span for="perfil_cp">Codigo postal:</span><input type="number" name="perfil_cp" id="perfil_cp" size="30" title="Codigo postal" value="<?php echo $cp;?>" disabled><span id="error_cp" hidden>Debe tener 5 digitos</span></div><br>
        <div class="dato"><span for="perfil_email">Email:</span><input type="email" name="perfil_email" id="perfil_email" size="30" title="Email" value="<?php echo $email;?>" disabled><span id="error_email" hidden>Debe tener @ y un punto.</span></div><br>
        
        
        
        <div id="dato"><span for="perfil_pass">Su contraseña:</span><input type="password" name="pass" id="perfil_pass" size="30" title="Su contraseña"  disabled></div>
                        
                    <input type="submit" value="Enviar datos" id="enviar">
    
    </form>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/perfil.js"></script>
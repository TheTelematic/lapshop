<?php 

$nombre = $this->session->userdata('usr_nombre'); 
$apellido = $this->session->userdata('usr_apellido');
$direccion = $this->session->userdata('usr_direccion'); 
$ciudad = $this->session->userdata('usr_ciudad'); 
$cp = $this->session->userdata('usr_cp'); 
$email = $this->session->userdata('usr_email'); 
//$pass = $this->session->userdata('usr_pass'); 
//$nivel = $this->session->userdata('usr_nivel');
$id = $this->session->userdata('usr_id'); 
?>
<div class="contenidoSection">
    <h2 class="tituloSection">Perfil de <?php echo $email;?></h2>
     <?php if(isset($mensaje)){
            echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
        }else{
            echo validation_errors();
        }?>
   
    <form action="<?php echo base_url();?>index.php/Usuarios/modify" method="post">
    
        <div class="dato"><span for="perfil_nombre">Nombre:</span><input type="text" name="perfil_nombre" id="perfil_nombre" size="30" title="Nombre" value="<?php echo $nombre;?>"></div><br>
        <div class="dato"><span for="perfil_apellido">Apellido:</span><input type="text" name="perfil_apellido" id="perfil_apellido" size="30" title="Apellido" value="<?php echo $apellido;?>"></div><br>
        <div class="dato"><span for="perfil_direccion">Direccion:</span><input type="text" name="perfil_direccion" id="perfil_direccion" size="30" title="Direccion" value="<?php echo $direccion;?>"></div><br>
        <div class="dato"><span for="perfil_ciudad">Ciudad:</span><input type="text" name="perfil_ciudad" id="perfil_ciudad" size="30" title="Ciudad" value="<?php echo $ciudad;?>"></div><br>
        <div class="dato"><span for="perfil_cp">Codigo postal:</span><input type="number" name="perfil_cp" id="perfil_cp" size="30" title="Codigo postal" value="<?php echo $cp;?>"><span id="error_cp" hidden>Debe tener 5 digitos</span></div><br>
        <div class="dato"><span for="perfil_email">Email:</span><input type="email" name="perfil_email" id="perfil_email" size="30" title="Email" value="<?php echo $email;?>"><span id="error_email" hidden>Debe tener @ y un punto.</span></div><br>
        
        
        
        <div id="dato"><span for="perfil_pass">Contraseña:</span><input type="password" name="perfil_pass" id="perfil_pass" size="30" title="Contraseña"></div>
                        
                    <input type="submit" value="Enviar datos" id="enviar">
    
    </form>
    
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/perfil.js"></script>
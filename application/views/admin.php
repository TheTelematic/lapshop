
<div class="contenidoSectionAdmin">
    <h2 class="tituloSection">PANEL DE ADMINISTRACIÓN</h2>
     <?php 
        if(isset($mensaje)){
            echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
        }else{
            echo validation_errors();
        }
        ?>
    <div class="adm_categorias">
        <div class="adm_titulo">
            Categorias
        </div>
        <ul>
            <li><?php echo anchor('Admins/addCatV','Añadir categoria')?></li>
            <li><?php echo anchor('Admins/editCatV','Editar categoria')?></li>
            <li><?php echo anchor('Admins/borrarCat','Borrar categoria')?></li>
        </ul>
    </div>
    <div class="adm_productos">
        <div class="adm_titulo">
            Productos
        </div>
        <ul>
            <li><a href="<?php echo base_url();?>index.php/Admins/add_producto">Añadir producto</a></li>
            <li><?php echo anchor('Admins/select_producto','Editar producto')?></li>
            <li><?php echo anchor('Admins/select_producto','Borrar producto')?></li>
        </ul>
    </div>
    <div class="adm_usuarios">
        <div class="adm_titulo">
            Usuarios
        </div>
            <form action="<?php echo base_url()."index.php/Admins/showUser/";?>" method="post">
                <input type="password" name="pass" id="pass" size="30" title="Contraseña" placeholder="Contraseña para confirmar">
                <div class="nota">(Para encontrar rápidamente pulse Ctrl + F)</div>
                <?php
                    $usuarios = (new Usuario())->get_normal_users();

                    foreach ($usuarios as $usr){
                        ?>

                                <input type="submit" name="_email_" value="<?php echo $usr->usr_email;?>">

                        <?php
                    }
                ?>
            </form>                
            
            
    </div>
    </form>
    
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/perfil.js"></script>
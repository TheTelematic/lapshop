<?php if(($this->session->userdata('usr_nivel') != NULL) && ($this->session->userdata('usr_nivel') == 0) ){?>
        <aside>
            <h3>Acciones</h3>

        <ul>
            <li><?php echo anchor('Admins/edit_producto/'.$producto->producto_id,'Editar producto')?></li>
            <li><?php echo anchor('Admins/borrar_producto/'.$producto->producto_id,'Borrar producto')?></li>
        </ul>
        </aside>
    <?php }?>
<div class="contenidoSection">
    <h2 class="tituloSection">
        <a href="<?php echo base_url();?>">
            <img src="<?php echo base_url();?>img/logo.png" style="width: 20px;">lapshop
        </a>
        <img src="<?php echo base_url();?>img/flecha.png" style="width: 15px;">
        <a href="
            <?php echo base_url()."index.php/Productos/ver_por_categoria/".$categoria->cat_id;?>
           ">
        <?php echo $categoria->cat_nombre;?>
        </a>
        <img src="<?php echo base_url();?>img/flecha.png" style="width: 15px;">
        <?php echo substr($producto->producto_nombre, 0, 13);
                if(strlen($producto->producto_nombre)>13){
                    echo '...';
                }
?>
    </h2>
    
    <div class="producto_unico">
        <?php
        if($producto->producto_imagen == NULL){
            $producto->producto_imagen = "default.png";
        }
        echo "<img id=\"imagen_producto\" alt=\"".html_escape($producto->producto_nombre)."\" src=\"".base_url()."resources/imgs/".html_escape($producto->producto_imagen)."\">";
        echo "<div id=\"nombre_producto\">".html_escape($producto->producto_nombre)."</div>";
        
        ?>
        
    <div class="stock"
        <?php
            if($producto->producto_stock > 20){
                echo 'style="color: green;" >Con stock</div>';
                if($this->session->userdata('usr_nombre') != NULL){
                    echo '<div class="boton_comprar"><form action="'.base_url().'index.php/Carrito/process/'.$producto->producto_id.'" method="post">
                        <input type="submit" name="accion" value="Añadir">
                    </form></div>';
                    ?>
         <div>Pagar por Paypal:</div>
                    <form action="<?php echo base_url().'index.php/Payments/buy/'.$producto->producto_id;?>" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="JZBSYRJKJZJBE">
                        <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
                        <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                    </form> 
         
                    <?php
                }else{
                    echo 'Debe estar logueado para comprar';
                }
                
            }elseif ((0 < $producto->producto_stock) && ($producto->producto_stock < 20)) {
                echo 'style="color: orange;">Poco stock</div>';
                if($this->session->userdata('usr_nombre') != NULL){
                    echo '<div class="boton_comprar"><form action="'.base_url().'index.php/Carrito/process/'.$producto->producto_id.'" method="post">
                        <input type="submit" name="accion" value="Añadir">
                    </form></div>';
                    ?>
                    <form action="<?php echo base_url().'index.php/Payments/buy/'.$producto->producto_id;?>" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="JZBSYRJKJZJBE">
                        <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
                        <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                    </form> 
         
                    <?php
                }else{
                    echo 'Debe estar logueado para comprar';
                }
            }else{
                echo 'style="color: red">Sin stock</div>';
            }
        ?>
    
    
        <?php
        
        echo "<div id=\"precio_producto\">".html_escape($producto->producto_precio)." EUR</div>";
        echo "<div id=\"categoria_producto\">Categoría: <a href=\"".base_url()."index.php/Productos/ver_por_categoria/".$categoria->cat_id."\">".$categoria->cat_nombre."</a></div>";
        echo "<div id=\"desc_producto\"><b>Descripción:</b><br>".html_escape($producto->producto_descripcion)."</div>";
        echo "<div id=\"codigo_producto\"><i>Codigo: ".html_escape($producto->producto_codigo)."</i></div>";
        
           
        ?>
    </div>
    
</div>
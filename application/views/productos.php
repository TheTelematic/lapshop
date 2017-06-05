<div class="contenidoSection">
<h2 class="tituloSection">Todos los productos</h2>

<div class="listaProductos">
<?php
    $cont = 0;
    foreach ($productos as $producto) {
        if($producto['producto_imagen'] == NULL){
            $producto['producto_imagen'] = "default.png";
        }
        
        echo "<a href=\"".base_url()."index.php/Productos/get_producto/".html_escape($producto['producto_id'])."\"><div class=\"producto\">";
        echo "<img id=\"imagen_producto\" alt=\"".html_escape($producto['producto_nombre'])."\" src=\"".base_url()."resources/imgs/".html_escape($producto['producto_imagen'])."\">";
        echo "<div id=\"nombre_producto\">";
        
        if(strlen(html_escape($producto['producto_nombre'])) > 30){
            echo substr(html_escape($producto['producto_nombre']), 0, 30).'...';
        }else{
            echo html_escape($producto['producto_nombre']);
        }
        
        echo "</div>";
        echo "<div id=\"precio_producto\">".html_escape($producto['producto_precio'])." EUR</div>";
        echo "<div id=\"desc_producto\">";
        if(strlen(html_escape($producto['producto_descripcion'])) > 100){
            echo substr(html_escape($producto['producto_descripcion']), 0, 100).'...';
        }else{
            echo html_escape($producto['producto_descripcion']);
        }
        
        
        echo "</div>";
        
        ?>
    
    <div class="stock"
        <?php
            if($producto['producto_stock'] > 20){
                echo 'style="color: green;" >Con stock</div>';
                if($this->session->userdata('usr_nombre') != NULL){
                echo '<div class="boton_comprar"><form action="'.base_url().'index.php/Carrito/process/'.$producto['producto_id'].'" method="post">
        <input type="submit" name="accion" value="Añadir">
    </form></div>';
                }
            }elseif ((0 < $producto['producto_stock']) && ($producto['producto_stock'] < 20)) {
                echo 'style="color: orange;">Poco stock</div>';
                if($this->session->userdata('usr_nombre') != NULL){
                echo '<div class="boton_comprar"><form action="'.base_url().'index.php/Carrito/process/'.$producto['producto_id'].'" method="post">
        <input type="submit" name="accion" value="Añadir">
    </form></div>';
                }
            }else{
                echo 'style="color: red">Sin stock</div>';
            }
        ?>
    
    
    
    <?php
        
        echo "</div></a>";
        $cont++;
        if($cont == 2){
            $cont = 0;
            echo "<a class=\"ir_arriba\" href=\"#_header\">^^Volver arriba^^</a>";
        }
    }
?>
</div>
</div>

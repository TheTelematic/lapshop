

<div class="contenidoSection">
    <h2 class="tituloSection"><p id="index" style="text-align: center;">Productos TOP</p>
    </h2>
    
    <?php
    if(isset($mensaje) && $mensaje != NULL){
        echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
    }
    $cont1 = 0; $cont2 = 0;
    foreach ($productos as $producto) {
        if($producto['producto_imagen'] == NULL){
            $producto['producto_imagen'] = "default.png";
        }
        if($cont2 == 0){
            echo "<div class=\"par_top_productos\">";
            echo "<a href=\"".base_url()."index.php/Productos/get_producto/".html_escape($producto['producto_id'])."\"><div class=\"producto_top_izq\">";
        }else{
            echo "<a href=\"".base_url()."index.php/Productos/get_producto/".html_escape($producto['producto_id'])."\"><div class=\"producto_top_der\">";
        }
        
        echo "<img id=\"imagen_producto\" alt=\"".html_escape($producto['producto_nombre'])."\" src=\"".base_url()."resources/imgs/".html_escape($producto['producto_imagen'])."\">";
        echo "<div id=\"nombre_producto\">".html_escape($producto['producto_nombre'])."</div>";
        echo "<div id=\"precio_producto\">".html_escape($producto['producto_precio'])." EUR</div>";
        echo "</div></a>";
        $cont1++;
        $cont2++;
        if($cont1 == 4){
            $cont1 = 0;
            echo "<a class=\"ir_arriba\" href=\"#_header\">^^Volver arriba^^</a>";
        }
        if($cont2 == 2){
            echo "</div>";
            $cont2 = 0;
        }
        
    }
?>
</div>

</div>

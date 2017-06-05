<div class="contenidoSection">
<h2 class="tituloSection">Su carrito</h2>

<?php
    if(isset($error)){
        echo "<div style=\"border: 1px red solid; background-color: black; color: yellow;\">".$error."</div>";
    }elseif(isset($mensaje)){
        echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
    }
    $this->load->library("form_validation");
    echo validation_errors();
    
    
    ?>

<div class="listaProductos">
    <div class="subtotal">Total: <?php echo $this->cart->total();?> €</div>
    <form action="<?php echo base_url().'index.php/Carrito/process/0'?>" method="post">
        <label for="direccion">Direccion de envio:</label>
        <input type="text" name="direccion" id="direccion" placeholder="<?php
            echo $this->session->userdata('usr_direccion');
        ?>">
        <input type="submit" name="accion" value="Finalizar compra">
    </form>
    
<?php
    $cont = 0;
    foreach ($this->cart->contents() as $producto) {
        $tmp = new Producto();
        
        $tmp->load($producto['id']);
        
        if($tmp->producto_imagen == NULL){
            $tmp->producto_imagen = "default.png";
        }
        
        echo "<a href=\"".base_url()."index.php/Productos/get_producto/".html_escape($producto['id'])."\"><div class=\"producto\">";
        echo "<img id=\"imagen_producto\" alt=\"".html_escape($producto['name'])."\" src=\"".base_url()."resources/imgs/".html_escape($tmp->producto_imagen)."\">";
        echo "<div id=\"nombre_producto\">".html_escape($producto['name'])."</div></a>";
        echo "<div id=\"precio_producto\">".html_escape($producto['price'])." EUR</div>";
        echo "<div id=\"cantidad_producto\">".html_escape($producto['qty'])." uds</div>";
        
        ?>
    
    <form action="<?php echo base_url().'index.php/Carrito/process/'.$producto['id']; ?>" method="post">
        <input type="number" name="cantidad" placeholder="Cantidad a añadir/eliminar">
        <input type="submit" name="accion" value="Añadir">
        <input type="submit" name="accion" value="Eliminar"><br>
    </form>
    
    
    <?php
        
        echo "</div>";
        $cont++;
        if($cont == 2){
            $cont = 0;
            echo "<a class=\"ir_arriba\" href=\"#_header\">^^Volver arriba^^</a>";
        }
    }
?>
    <div class="subtotal">Total: <?php echo $this->cart->total();?> €</div>
    <form action="<?php echo base_url().'index.php/Carrito/process/0'?>" method="post">
        <label for="direccion">Direccion de envio:</label>
        <input type="text" name="direccion" id="direccion" placeholder="<?php
            echo $this->session->userdata('usr_direccion');
        ?>">
        <input type="submit" name="accion" value="Finalizar compra">
    </form>
</div>

</div>
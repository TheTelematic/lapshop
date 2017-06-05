<div class="contenidoSection">
<h2 class="tituloSection"> Editar/Borrar producto </h2>

    <?php
    echo validation_errors();
    ?>
    
<form action="<?php echo base_url().'index.php/Admins/select_producto';?>" method="post">
        <label for="select_producto_nombre">Producto:</label>
        <select id="select_producto_nombre" name="producto_id">
            <option value="">Selecciona un producto...</option>
            <?php
                foreach ($productos as $producto){
                    echo '<option value="'.$producto['producto_id'].'">'.$producto['producto_nombre'].'</option>';
                }
            ?>
            
        </select>
        <input type="submit" value="Seleccionar">
</form>
</div>
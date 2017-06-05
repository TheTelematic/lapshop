<div class="contenidoSection">
    <h2 class="tituloSection">
    Datos del nuevo producto </h2>
    
    <?php
    if(isset($mensaje)){
            echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
        }else{
            echo validation_errors();
        }
    ?>
    <form action="<?php echo base_url().'index.php/Admins/add_producto';?>" method="post">
        <div class="dato"><span for="producto_nombre">Nombre:</span><input autofocus type="text" name="producto_nombre" id="producto_nombre" size="30"></div><br>
        <div class="dato"><span for="producto_precio">Precio sin IVA:</span><input type="number" name="producto_precio" id="producto_precio" size="30"></div><br>
        <div class="dato"><span for="producto_iva">IVA (%):</span><input type="number" name="producto_iva" id="producto_iva" size="30"></div><br>
        <div class="dato"><span for="producto_codigo">Codigo:</span><input type="number" name="producto_codigo" id="producto_codigo" size="30"></div><br>
        <div class="dato"><span for="producto_descripcion">Descripcion:</span><textarea cols="50" rows="20" name="producto_descripcion" id="producto_descripcion"></textarea></div><br>
        <div class="dato"><span for="producto_stock">Stock:</span><input type="number" name="producto_stock" id="producto_stock" size="30"></div><br>
        
        <div class="dato"><span for="categoria_id">Categoria:</span><select name="categoria_id" id="producto_descripcion">
                <option value="0">Selecciona una categoria...</option>
            <?php
            
            $categorias = (new Categoria())->get();
            
            foreach ($categorias as $cat){
                
                ?>
                <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_nombre']; ?></option>
                <?php
                
            }
            
            ?>
            </select></div><br>
            
            <div class="dato"><input type="submit" value="Añadir"><input type="reset" value="Resetear campos"></div>
    </form>
    
    
</div>
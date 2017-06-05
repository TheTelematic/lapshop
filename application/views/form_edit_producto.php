<?php
$id = $producto->producto_id;
$nombre = $producto->producto_nombre;
$iva = $producto->producto_iva;
$precio = $producto->producto_precio/(1 + ($iva/100));
$codigo = $producto->producto_codigo;
$descripcion = $producto->producto_descripcion;
$stock = $producto->producto_stock;
$categoria = new Categoria();
$categoria->load($producto->categoria_id);

?>
<div class="contenidoSection">
    <h2 class="tituloSection">
    Datos del producto <?php echo $id;?></h2>
    
    <?php
    
    if(isset($mensaje)){
            echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
        }else{
            echo validation_errors();
        }?>
    <form action="<?php echo base_url().'index.php/Admins/edit_producto/'.$id;?>" method="post">
        <div class="dato"><span for="producto_nombre">Nombre:</span><input value="<?php echo $nombre;?>" autofocus type="text" name="producto_nombre" id="producto_nombre" size="30"></div><br>
        <div class="dato"><span for="producto_precio">Precio:</span><input value="<?php echo $precio;?>" type="number" name="producto_precio" id="producto_precio" size="30"></div><br>
        <div class="dato"><span for="producto_iva">IVA (%):</span><input value="<?php echo $iva;?>" type="number" name="producto_iva" id="producto_iva" size="30"></div><br>
        <div class="dato"><span for="producto_codigo">Codigo:</span><input value="<?php echo $codigo;?>" type="number" name="producto_codigo" id="producto_codigo" size="30"></div><br>
        <div class="dato"><span for="producto_descripcion">Descripcion:</span><textarea cols="50" rows="20" name="producto_descripcion" id="producto_descripcion"><?php echo $descripcion;?></textarea></div><br>
        <div class="dato"><span for="producto_stock">Stock:</span><input  value="<?php echo $stock;?>" type="number" name="producto_stock" id="producto_stock" size="30"></div><br>
        <div class="dato"><span for="categoria_id">Categoria:</span><select name="categoria_id" id="producto_descripcion">
                <option value="0">Selecciona una categoria...</option>
            <?php
            
            $categorias = (new Categoria())->get();
            
            foreach ($categorias as $cat){
                
                ?>
                <option value="<?php echo $cat['cat_id']; ?>" <?php if($cat['cat_id'] == $categoria->cat_id){?> selected <?php } ?>><?php echo $cat['cat_nombre']; ?></option>
                <?php
                
            }
            
            ?>
            </select></div><br>
            <div class="dato"><input type="submit" value="Editar"><input type="reset" value="Resetear campos"></div>
    </form>
    <a href="<?php echo base_url().'index.php/Admins/do_upload/'.$id;?>">Editar imagen del producto</a>
    <form action="<?php echo base_url().'index.php/Admins/borrar_producto/'.$id;?>" method="post">
        <input type="submit" name="borrar" value="Borrar"></form>
    
</div>
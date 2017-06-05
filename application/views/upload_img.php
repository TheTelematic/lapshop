
<div class="contenidoSection">
    <h2 class="tituloSection">
    ¿Desea añadirle una imagen al producto "<?php echo $producto->producto_nombre;?>"? </h2>
    
    Actual:
    <?php if($producto->producto_imagen == NULL){
            $producto->producto_imagen = "default.png";
        }
        ?>
    <img src="<?php echo base_url().'resources/imgs/'.$producto->producto_imagen; ?>" alt="Imagen del producto" width="200">

    <?php
        
        if(isset($error)){
            echo $error;
        }
    ?>
<?php
    $this->load->helper('form');
    
    echo form_open_multipart('Admins/do_upload/'.$producto->producto_id);
    
?>
    <input type="file" name="producto_img">
    <input type="submit" value="Subir imagen"><br>
</form>

</div>
<div class="contenidoSection">
    <h2 class="tituloSection">
    Datos de la nueva categoría </h2> 

    <?php
    echo validation_errors();
    ?>
    <form id="formCategorias"
          action="<?php echo base_url();?>index.php/Admins/addCatV"
          method="post"
          class="formularioSimple elementoConBorde">

        <label for="cat_nombre">Nueva categoría:</label>
        <input type="text" id="cat_nombre" name="cat_nombre" required><br>
        <label for="cat_nombre_corto">Nueva corto:</label>
        <input type="text" id="cat_nombre_corto" name="cat_nombre_corto" required value="<?php if(isset($nombre_corto)) {echo $nombre_corto;}?>"><br>
        <input type="submit" value="Crear">
        <input type="reset" value="Limpiar">

    </form>
</div>
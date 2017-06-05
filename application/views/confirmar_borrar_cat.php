<div class="contenidoSection">
    <h2 class="tituloSection">¿Está seguro que desea borrar la categoria  <b>  <?php  echo $cat_nombre;?></b> ?</h2>
    
    <?php
    echo validation_errors();
    ?>
        <form id="formCategorias"
            action="<?php echo base_url();?>index.php/Admins/borrarCatV/<?php echo $cat_id; ?>"
            method="post"
            class="formularioSimple elementoConBorde">

            <input class="submit" type="submit" value="Sí">
            
        </form>
        <form id="formCategorias"
            action="<?php echo base_url();?>index.php/Admins/"
            method="post"
            class="formularioSimple elementoConBorde">

            <input class="submit" type="submit" value="No">
            
        </form>
    
</div>
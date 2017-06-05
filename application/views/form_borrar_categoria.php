<div class="contenidoSection">
    <h2 class="tituloSection">Borrar categoria</h2>
    
    <?php
    echo validation_errors();
    ?>
    
        <form id="formCategorias"
            action="<?php echo base_url();?>index.php/Admins/borrarCat"
            method="post"
            class="formularioSimple elementoConBorde">

            <label for="cat_id">Categoría:</label>
            <select id="select_cat_nombre" name="cat_id">
                <option value="-1">Selecciona la categoria</option>
                <?php
                    foreach ($categorias as $cat){
                        echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_nombre'].'</option>';
                    }
                ?>
            </select>

            <input type="submit" value="Borrar">
        
        </form>
    
    
</div>

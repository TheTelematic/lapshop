<div class="contenidoSection">
<h2 class="tituloSection"> Editar categoria </h2>

    <?php
    echo validation_errors();
    ?>
    

        <label for="cat_id">Categoría:</label>
        <select id="select_cat_nombre" name="cat_id">
            <option value="-1">Selecciona la categoria</option>
            <?php
                foreach ($categorias as $cat){
                    echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_nombre'].'</option>';
                }
            ?>
            
        </select>
        <?php
            foreach ($categorias as $cat){
                echo '<div id="categoria_nombre_'.$cat['cat_id'].'" value="'.$cat['cat_nombre'].'" hidden></div>';
                echo '<div id="categoria_nombre_corto_'.$cat['cat_id'].'" value="'.$cat['cat_nombre_url'].'" hidden/></div>';
            }
        ?>
        
        <form id="formCategorias"
            action="<?php echo base_url();?>index.php/Admins/editCatV"
            method="post"
            class="formularioSimple elementoConBorde" hidden>

            <label for="cat_nombre">Categoría:</label>
            <input type="text" id="cat_nombre" name="cat_nombre" required><br>
            <label for="cat_nombre_corto">Nombre corto:</label>
            <input type="text" id="cat_nombre_corto" name="cat_nombre_corto" required disabled><br>
            <input type="submit" value="Editar" onclick="return enable()">
        </form>
</div>

<script type="text/javascript" src="<?php echo base_url();?>/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/edit.js"></script>
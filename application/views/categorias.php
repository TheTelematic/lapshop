
<div class="contenidoSection">
<h2 class="tituloSection">Categorias</h2>

<div class="listaCategorias">
<?php
    foreach ($categorias as $cat) {
        //echo '<a href=\"'.base_url().'index.php/ver_categoria/index/'.html_escape($cat['cat_id']).'\">';
        
        $tmp =  "<div class=\"categoria\"><h3>".html_escape($cat['cat_nombre'])."</h3>"."<h6>Nombre corto: ".html_escape($cat['cat_nombre_url'])."</h6></div>";
        echo anchor('Productos/ver_por_categoria/'.$cat['cat_id'],$tmp );
    }
?>
</div>
</div>

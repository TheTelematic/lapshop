<div class="contenidoSection">
    <h2 class="tituloSection">
    Error desconocido </h2>
    
    <?php
    if(isset($MENSAJE_DE_ERROR)){
            echo "<div style=\"border: 1px red solid; background-color: black; color: yellow;\">".$MENSAJE_DE_ERROR."</div>";
        }else{
            echo validation_errors();
        }
    ?>
</div>
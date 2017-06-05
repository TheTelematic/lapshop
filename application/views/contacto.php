
<div class="contenidoSection">
    <h2 class="tituloSection">Contacto</h2>
    <?php if(isset($respuesta)){
            echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$respuesta</div>";
        } ?>
    <form action="<?php echo base_url();?>index.php/Contacto/enviar_contacto" method="post">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" style="padding: 5px; margin: 5px;"><br>
        <input type="email" id="email" name="email" placeholder="Email" style="padding: 5px; margin: 5px;"><br>
        <textarea id="mensaje" name="mensaje" placeholder="Escriba aqui su mensaje..." rows="20" cols="40" style="padding: 5px; margin: 5px;"></textarea><br>
        <input type="submit" id="contactar" value="Enviar" style="padding: 5px; margin: 5px;">
        <input type="reset" id="limpiar" value="Limpiar" style="padding: 5px; margin: 5px;">
        
    </form>
</div>


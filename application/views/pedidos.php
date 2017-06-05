<div class="contenidoSection">
<h2 class="tituloSection">Sus pedidos</h2>

<?php
    if(isset($error)){
        echo "<div style=\"border: 1px red solid; background-color: black; color: yellow;\">".$error."</div>";
    }elseif(isset($mensaje)){
        echo "<div id=\"respuesta_contacto\" class=\"respuesta_contacto\">$mensaje</div>";
    }
?>
<div class="listaPedidos">
<?php
foreach ($pedidos->result_array() as $pedido){
    ?>
    <div class="pedido">
        <div class="numeroPedido">Pedido #<?php echo $pedido['pedido_codigo_pago'];?></div>

        <ul class="listaProductos">

            <?php
                $productos = unserialize($pedido['pedido_detalles']);

                foreach ($productos as $item){
                    echo "<li>".$item['qty'].' - '.$item['name']."</li>";
                }
            ?>

        </ul>

        <div class="direccionEnvio">Direccion: <?php echo $pedido['pedido_direccion_envio'];?></div>
        <div class="subtotalPedido">Total: <?php echo $pedido['pedido_subtotal']; ?> €</div>
    </div>
    <?php
}

?>

</div>
</div>
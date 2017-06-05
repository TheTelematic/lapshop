</section>
<?php if($this->session->userdata('usr_nivel') != NULL){?>
<aside>
    <h3>Opciones</h3>

<ul>
    <li><?php echo anchor('Usuarios/changePass','Cambiar contraseña')?></li>
    <li><?php echo anchor('Usuarios/verPedidosHechos','Ver pedidos hechos')?></li>
   
</ul>
</aside>
<?php }
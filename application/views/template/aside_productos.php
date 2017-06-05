</section>
<?php if(($this->session->userdata('usr_nivel') != NULL) && ($this->session->userdata('usr_nivel') == 0) ){?>
<aside>
    <h3>Enlaces</h3>

<ul>
    <li><a href="<?php echo base_url();?>index.php/Admins/add_producto">Añadir producto</a></li>
    <li><?php echo anchor('Admins/select_producto','Editar producto')?></li>
    <li><?php echo anchor('Admins/select_producto','Borrar producto')?></li>
</ul>
</aside>
<?php }
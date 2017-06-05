</section>
<?php if(($this->session->userdata('usr_nivel') != NULL) && ($this->session->userdata('usr_nivel') == 0) ){?>
<aside>
    <h3>Enlaces</h3>

<ul>
    <li><?php echo anchor('Admins/addCatV','Añadir categoria')?></li>
    <li><?php echo anchor('Admins/editCatV','Editar categoria')?></li>
    <li><?php echo anchor('Admins/borrarCat','Borrar categoria')?></li>
</ul>
</aside>
<?php }
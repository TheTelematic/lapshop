</section>
<?php if(($this->session->userdata('usr_nivel') != NULL) && ($this->session->userdata('usr_nivel') == 0) ){?>
<aside>
    <h3>Opciones</h3>

<ul>
    <li><?php echo anchor('Admins/changePass/'.$usuario->usr_id,'Cambiar contraseña')?></li>
    <li><?php echo anchor('Admins/doAdmUSer/'.$usuario->usr_id,'Elevar usuario')?></li>
    <li><?php echo anchor('Admins/removeUser/'.$usuario->usr_id,'Eliminar usuario')?></li>
   
</ul>
</aside>
<?php }
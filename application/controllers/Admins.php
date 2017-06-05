<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends AdminController{
    
    public function index(){
        $this->load->library("form_validation");
        $this->go_to_view('admin', 'aside_admin', [], []);
    }
    
    
    public function showUser(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => '_email_',
                        'label' => 'Email',
                        'rules' => 'required|callback_exists_email'
                    ),
                    array(
                        'field' => 'pass',
                        'label' => 'Antigua contraseña',
                        'rules' => 'required|callback_check_password'
                    )
                )
        );
        
        
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            
            $this->go_to_view('admin', 'aside_admin', [], []);
            
        }else{
            $usr = new Usuario();
            $usr->load_by_email($this->input->post('_email_'));
            
            $this->go_to_view('showUser', 'aside_user', ["usuario"], [$usr]);
        }
    }
    
    
    
    public function doAdmUser($id){
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => '_email_',
                        'label' => 'Email',
                        'rules' => 'required|callback_exists_email'
                    ),
                    array(
                        'field' => 'pass',
                        'label' => 'Antigua contraseña',
                        'rules' => 'required|callback_check_password'
                    )
                )
        );
        
        
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            $u = new Usuario();
            $u->load($id);
            $this->go_to_view('doadmuser', 'aside', ["usuario"], [$u]);
            
        }else{
            
            $user = new Usuario();$user->load_by_email($this->input->post('_email_'));
            
            $user->usr_nivel = 0;
            
            $user->save();
            
            
            $this->go_to_view('admin', 'aside_admin', ["mensaje"], ["El usuario con email ".$user->usr_email." se hizo administrador"]);
        }
    }
    
    public function removeUser($id){
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => '_email_',
                        'label' => 'Email',
                        'rules' => 'required|callback_exists_email'
                    ),
                    array(
                        'field' => 'pass',
                        'label' => 'Antigua contraseña',
                        'rules' => 'required|callback_check_password'
                    )
                )
        );
        
        
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            $u = new Usuario();
            $u->load($id);
            $this->go_to_view('removeuser', 'aside', ["usuario"], [$u]);
            
        }else{
            
            $user = new Usuario();$user->load_by_email($this->input->post('_email_'));
            
            
            
            $user->delete();
            
            
            $this->go_to_view('admin', 'aside_admin', ["mensaje"], ["El usuario con email ".$user->usr_email." ha sido eliminado"]);
        }
    }
    
    public function modify($id) {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'perfil_nombre',        //Nombre del campo en el formulario
                        'label' => 'Nombre',   //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'perfil_apellido',        //Nombre del campo en el formulario
                        'label' => 'Apellido',   //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'perfil_direccion',
                        'label' => 'Direccion',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'perfil_cp',
                        'label' => 'Codigo postal',
                        'rules' => 'required|callback_checkCP'
                    ),
                    array(
                        'field' => 'perfil_ciudad',
                        'label' => 'Ciudad',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'perfil_email',
                        'label' => 'Email',
                        'rules' => 'required|callback_validate_email['.$id.']'
                    ),
                    array(
                        'field' => 'pass',
                        'label' => 'Antigua contraseña',
                        'rules' => 'required|callback_check_password'
                    )
                )
        );
        //echo $this->input->post('perfil_email');
        
        
        $this->form_validation->set_error_delimiters(
                '<div class="errorValidacion">','</div>');
        
        if (!$this->form_validation->run()){
            
            $this->go_to_view('perfil', 'aside_perfil', [], []);
            
        }else{
            
            $user = new Usuario();$user->load_by_email($this->input->post('perfil_email'));
            
            $user->usr_nombre = $this->input->post('perfil_nombre');
            $user->usr_apellido = $this->input->post('perfil_apellido');
            $user->usr_direccion = $this->input->post('perfil_direccion');
            $user->usr_cp = $this->input->post('perfil_cp');
            $user->usr_ciudad = $this->input->post('perfil_ciudad');
            $user->usr_email = $this->input->post('perfil_email');
            
            
            
            
            $user->save();
            
            $this->go_to_view('showUser', 'aside_user', ["usuario", "mensaje"], [$user, "Modificación confirmada"]);
        }
    }
    
    public function changePass($id) {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'perfil_pass',
                        'label' => 'Antigua contraseña',
                        'rules' => 'required|callback_check_password'
                    ),
                    array(
                        'field' => 'perfil_new_pass',
                        'label' => 'Nueva contraseña',
                        'rules' => 'required|callback_check_new_password'
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class="errorValidacion">','</div>');
        
        if (!$this->form_validation->run()){
            
            $this->go_to_view('changepassAdm', 'aside', ["id"], [$id]);
        }else{
            $user = new Usuario();$user->load($id);
            
            $user->usr_hash = $this->encrypt->encode($this->input->post('perfil_new_pass'));
            $user->save();
            
            
            $result = $this->sendEmail($user->usr_email, 'lapshop - Nueva contraseña', 'Su contraseña ha sido cambiada a: '.$this->input->post('perfil_new_pass'));
            
            if($result){
                $notice = 'SI';
            }else{
                $notice = 'NO';
            }
            
            $this->go_to_view('showUser', 'aside_user', ["usuario", "mensaje"], [$user, "Contraseña cambiada - ".$notice." se le ha notificado al correo del usuario"]);
        }
    }
    
    public function add_producto(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'producto_nombre',        //Nombre del campo en el formulario
                        'label' => 'Nombre producto',   //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'producto_precio',
                        'label' => 'Precio producto',
                        'rules' => 'required|callback_check_number'
                    ),
                    array(
                        'field' => 'producto_codigo',
                        'label' => 'Codigo producto',
                        'rules' => 'required|callback_check_number|callback_check_codigo[0]'
                    ),
                    array(
                        'field' => 'producto_descripcion',
                        'label' => 'Descripcion producto',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'producto_stock',
                        'label' => 'Stock',
                        'rules' => 'required|callback_check_stock'
                    ),
                    array(
                        'field' => 'categoria_id',
                        'label' => 'Categoria',
                        'rules' => 'required|callback_validate_categoria'
                    ),
                    array(
                        'field' => 'producto_iva',
                        'label' => 'IVA',
                        'rules' => 'required'
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            //echo "jadio";
            $this->go_to_view('form_producto', 'aside', [], []);
        }else{
            //echo "jola";
            $producto = new Producto();
            
            $producto->producto_nombre = $this->input->post('producto_nombre');
            $producto->producto_iva = $this->input->post('producto_iva');
            $producto->producto_precio = $this->input->post('producto_precio') * (1 + ($producto->producto_iva/100));
            $producto->producto_codigo = $this->input->post('producto_codigo');
            $producto->producto_descripcion = $this->input->post('producto_descripcion');
            $producto->categoria_id = $this->input->post('categoria_id');
            $producto->producto_stock = $this->input->post('producto_stock');
            $producto->producto_imagen = 'default.png';
            
            
            $producto->save();
            
            $this->go_to_view('upload_img', 'aside', ['producto'], [$producto]);
            
        }
    }
    
    public function select_producto() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'producto_id',        //Nombre del campo en el formulario
                        'label' => 'ID producto',   //Nombre de la etiqueta asociada
                        'rules' => 'callback_checkID'           //regla que debe cumplir
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            
            $productos = $this->Producto->get();
            
            $this->go_to_view('form_select_edit_producto', 'aside', ['productos'], [$productos]);
            
        }else{
            
            $producto = new Producto();
            
            $producto->load($this->input->post('producto_id'));
            $this->go_to_view('form_edit_producto', 'aside', ['producto'], [$producto]);
            
        }
        
    }
    
    public function edit_producto($id){
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'producto_nombre',        //Nombre del campo en el formulario
                        'label' => 'Nombre producto',   //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'producto_precio',
                        'label' => 'Precio producto',
                        'rules' => 'required|callback_check_number'
                    ),
                    array(
                        'field' => 'producto_codigo',
                        'label' => 'Codigo producto',
                        'rules' => 'required|callback_check_codigo['.$id.']'
                    ),
                    array(
                        'field' => 'producto_descripcion',
                        'label' => 'Descripcion producto',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'producto_stock',
                        'label' => 'Stock',
                        'rules' => 'required|callback_check_stock'
                    ),
                    array(
                        'field' => 'categoria_id',
                        'label' => 'Categoria',
                        'rules' => 'required|callback_validate_categoria'
                    ),
                    array(
                        'field' => 'producto_iva',
                        'label' => 'IVA',
                        'rules' => 'required'
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            //echo "jadio";
            $producto = new Producto();
            
            $producto->load($id);
            $this->go_to_view('form_edit_producto', 'aside', ['producto'], [$producto]);
                    
        }else{
            //echo "jola";
            $producto = new Producto();
            
            $producto->load($id);
            
            $producto->producto_nombre = $this->input->post('producto_nombre');
            $producto->producto_iva = $this->input->post('producto_iva');
            $producto->producto_precio = $this->input->post('producto_precio') * (1 + ($producto->producto_iva/100));
            //$producto->producto_precio = $this->input->post('producto_precio');
            $producto->producto_codigo = $this->input->post('producto_codigo');
            $producto->producto_descripcion = $this->input->post('producto_descripcion');
            $producto->categoria_id = $this->input->post('categoria_id');
            $producto->producto_stock = $this->input->post('producto_stock');
            
            $producto->save();
            
            $this->go_to_view('form_edit_producto', 'aside', ['producto', 'mensaje'], [$producto, "Modificado correctamente"]);
            
        }
    }
    
    public function check_stock($stock){
        if( $stock < 0){
            $this->form_validation->set_message('check_stock', "El stock no puede ser negativo");
            return false;
        }
        
        return true;
    }


    
    public function borrar_producto($id) {
        $producto = new Producto();
        
        $producto->load($id);
        
        $producto->delete();
        
        $this->go_to_view('admin', 'aside_admin', ["mensaje"], ["Producto borrado"]);
    }
    
    public function checkID($id) {
        
        if( $id == ""){
            $this->form_validation->set_message('checkID', "Debe de seleccionar un producto");
            return false;
        }
        
        return true;
        
    }
    
    public function addCatV($nombre_corto = null){
        //$this->load->model('Categoria');
        
        //cargar libreria de validacion
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'cat_nombre',        //Nombre del campo en el formulario
                        'label' => 'Nueva_categoria',   //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'cat_nombre_corto',
                        'label' => 'Nombre corto',
                        'rules' => 'required|callback_check_categoria'
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){/*
            $datos['nombre_corto'] = $nombre_corto;
            $datos['mainContent'] = "form_categorias";
            $datos['aside'] = 'aside_categorias';
            $this->load->view('template/template', $datos);*/
            
            $this->go_to_view("form_categorias", "aside_categorias", ["nombre_corto"], [$nombre_corto]);
        }else{
            $newCat = new Categoria();
            
            $newCat->cat_nombre = $this->input->post('cat_nombre');
            $newCat->cat_nombre_url = $this->input->post('cat_nombre_corto');
            
            
            $newCat->save();
            
            
            redirect('Categorias');
        }
    }
    
    public function check_categoria($str){
        //$this->load->model('Categoria');
        
        $categorias = (new Categoria())->get();
        
        foreach ($categorias as $cat){
            if ($cat['cat_nombre_url'] == $str){
                $this->form_validation->set_message('check_categoria', "Ese nombre corto de categoria ya existe.");
                return false;
            }
        }
        
        return true;
    }
    
    public function editCatV() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'cat_nombre',        //Nombre del campo en el formulario
                        'label' => 'Categoria',         //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'cat_nombre_corto',
                        'label' => 'Nombre corto',
                        'rules' => 'required|callback_check_nombrecorto'
                    )
                )
        );
        
        
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        if (!$this->form_validation->run()){
            /*$this->load->model('Categoria');
            
            $datos['categorias'] = $this->Categoria->get();
            $datos['mainContent'] = "form_edit_categoria";
            $datos['aside'] = 'aside_categorias';
            $this->load->view('template/template', $datos);*/
            
            $this->go_to_view("form_edit_categoria","aside_categorias" , [], []);
        }else{
            $newCat = new Categoria();
            
            foreach ((new Categoria())->get() as $cat){
                if ($cat['cat_nombre_url'] == $this->input->post('cat_nombre_corto')){
                    $id = $cat['cat_id'];
                }
            }
            
            $newCat->cat_id = $id;
            $newCat->cat_nombre = $this->input->post('cat_nombre');
            $newCat->cat_nombre_url = $this->input->post('cat_nombre_corto');
            
            
            $newCat->save();
            
            
            redirect('Categorias');
        }
    }
    
    public function check_nombrecorto($str){
        
        /*echo $this->input->post('cat_nombre')."<br>";
        echo $this->input->post('cat_nombre_corto')."<br>";
        echo $str;*/
        
        //$this->load->model('Categoria');
        
        $categorias = (new Categoria())->get();
        
        //$tmp = $str."<br>";
        foreach ($categorias as $cat){
            //$tmp .= $cat['cat_nombre_url']."<br>";
            if ($cat['cat_nombre_url'] == $str){
                
                return true;
            }
        }
        $this->form_validation->set_message('check_nombrecorto', "Ese nombre corto de categoria no existe.<br>Si quiere editarlo debe de ".anchor('categorias/addCatV/'.$str,'crear una categoria nueva').".<br>");
        return false;
    }
    
    
    public function borrarCatV($cat_id) {
        if (!isset($cat_id)){
            /*$this->load->model('Categoria');
            
            $datos['categorias'] = $this->Categoria->get();
            $datos['mainContent'] = "form_edit_categoria";
            $datos['aside'] = 'aside_categorias';
            $this->load->view('template/template', $datos);*/
            
            $this->go_to_view("form_borrar_categoria","aside_categoria" , ["error"], ["Hubo un error borrando"]);
        }else{
            //$this->load->model('Categoria');
            $cat = new Categoria();
            
            $cat->load($cat_id);
            
            $cat->delete();
            
            $productos = (new Producto())->get_of_cat($cat_id);
            
            
            
            foreach ($productos->result() as $producto){
               /* echo "---------------";
                echo $producto->producto_nombre;
                echo "===============";
                */
                $temp = new Producto();
                
                $temp->load($producto->producto_id);
                
                $temp->delete();
                
                
            }
            
            redirect('Categorias');
        }
    }
     
    
    public function borrarCat() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'cat_id',        //Nombre del campo en el formulario
                        'label' => 'Categoria',         //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    )
                )
        );
        
        
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        if (!$this->form_validation->run()){
            /*$this->load->model('Categoria');
            
            $datos['categorias'] = $this->Categoria->get();
            $datos['mainContent'] = "form_edit_categoria";
            $datos['aside'] = 'aside_categorias';
            $this->load->view('template/template', $datos);*/
            
            $this->go_to_view("form_borrar_categoria","aside_categorias" , [], []);
        }else{
            $this->load->model('Categoria');
            
            $categoria = new Categoria();
            $categoria->load($this->input->post('cat_id'));
            
            $this->go_to_view("confirmar_borrar_cat", "aside", ["cat_id", "cat_nombre"], [$categoria->cat_id, $categoria->cat_nombre ]);
        }
    }


    public function check_codigo($codigo, $id) {
        $productos = new Producto();
        
        
        
        foreach ($productos->get() as $producto){
            
            if($id == 0){
                if($producto['producto_codigo'] == $codigo){
                    $this->form_validation->set_message('check_codigo', "Ese codigo de producto ya existe");
                    return false;
                }
            }else{
                if(($producto['producto_id'] != $id) && ($producto['producto_codigo'] == $codigo)){
                    $this->form_validation->set_message('check_codigo', "Ese codigo de producto ya existe");
                    return false;
                }
            }
            
            
        }
        
        return true;
    }
    
    public function validate_categoria($cat) {
        //echo 'categoria:'.$cat;
        if($cat == 0){
            $this->form_validation->set_message('validate_categoria', "Debe de seleccionar una categoria valida.");
            return false;
        }
        
        return true;
    }
    
    public function check_number($str){
        if($str < 0){
            $this->form_validation->set_message('check_number', "No puede ser negativo ni precio ni codigo");
            return false;
        }
        
        return true;
    }
    
    
    public function check_new_password($str) {
        
        //echo "new password: ".$str;
        if(!preg_match("/^(?=.*\W)(?=.*\d)(?=.*[A-Z]).{6,}$/", $str)){
            $this->form_validation->set_message('check_new_password', "La contraseña debe tener al menos 6 caracteres, incluyendo un signo de puntuación, un numero y mayusculas");
            return false;
        }
        return true;
    }
    
    public function checkCP($str) {
        //echo "cp: ".$str;
        if(preg_match("/\d{5}/", $str)){
            return true;
        }else{
            $this->form_validation->set_message('checkCP', "Codigo postal invalido, debe tener 5 digitos");
            return false;
        }
    }
    
    public function validate_email($str, $id) {
        
        if(!filter_var($str, FILTER_VALIDATE_EMAIL)){
            $this->form_validation->set_message('validate_email', "Email no valido, formato -> ejemplo@ejemplo.org");
            return false;
        }
        
        $usuario = new Usuario();
        
        $usuario->load($id);
        
        if($str != $usuario->usr_email){
            if( ! $usuario->exists_by_email($str)){
                return true;
            }  else {
                $this->form_validation->set_message('validate_email', "Ya existe el email ".$usuario->usr_email);
                return false;
            }
        }
        return true;
    }
    
    public function exists_email($str) {
        
        if(!filter_var($str, FILTER_VALIDATE_EMAIL)){
            $this->form_validation->set_message('validate_email', "Email no valido, formato -> ejemplo@ejemplo.org");
            return false;
        }
        
        if( $this->Usuario->exists_by_email($str)){
            return true;
        }  else {
            $this->form_validation->set_message('validate_email', "No existe el email ".$str);
            return false;
        }
    }
    
    public function check_password($str) {
        
        $usuario = new Usuario();
            
        $usuario->load($this->session->userdata('usr_id'));
        
        //echo $str;
        
        if($this->encrypt->decode($usuario->usr_hash) == $str){
            return true;
        }else{
            $this->form_validation->set_message('check_password', "Contraseña incorrecta");
            return false;
        }
    }
    
    public function do_upload($id) {
        $p = new Producto();
        $p->load($id);
        
        //$p->producto_imagen = $this->input->post('producto_img');

        //echo $p->producto_imagen;
        
        $config['upload_path']          = './resources/imgs/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 500;
        $config['max_width']            = 1024;
        $config['max_height']           = 900;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('producto_img'))
        {
            $this->go_to_view('upload_img', 'aside', ['producto','error'], [$p, $this->upload->display_errors()]);
                
        }
        else
        {
            $data = $this->upload->data();
            $p->producto_imagen = $data['file_name'];
            $p->save();
            $this->go_to_view('admin', 'aside_admin', ['mensaje'], ['Imagen subida correctamente']);


        }
        
        //$this->go_to_view('form_producto', 'aside', ['mensaje'], ['Añadido correctamente']);
    }
    
    
}

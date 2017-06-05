<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends UsuarioController{
    
    public function index(){
        redirect('Tienda');
    }
    
    /*public function perfil(){
        $this->go_to_view('perfil', 'aside_perfil', [], []);
    }*/
    
    public function modify(){
  
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
                        'rules' => 'required|callback_validate_email'
                    ),
                    array(
                        'field' => 'perfil_pass',
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
            
            $user = new Usuario();$user->load($this->session->userdata('usr_id'));
            
            $user->usr_nombre = $this->input->post('perfil_nombre');
            $user->usr_apellido = $this->input->post('perfil_apellido');
            $user->usr_direccion = $this->input->post('perfil_direccion');
            $user->usr_cp = $this->input->post('perfil_cp');
            $user->usr_ciudad = $this->input->post('perfil_ciudad');
            $user->usr_email = $this->input->post('perfil_email');
            
            
            
            
            $user->save();
            
            $this->session->set_userdata('usr_nombre', $user->usr_nombre); 
            $this->session->set_userdata('usr_apellido', $user->usr_apellido);
            $this->session->set_userdata('usr_direccion', $user->usr_direccion); 
            $this->session->set_userdata('usr_ciudad', $user->usr_ciudad); 
            $this->session->set_userdata('usr_cp', $user->usr_cp);
            
            $this->session->set_userdata('usr_email', $user->usr_email);
            
            $this->go_to_view('perfil', 'aside_perfil', ["mensaje"], ["Modificado correctamente"]);
        }
        
    }
    
    public function changePass() {
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
            
            $this->go_to_view('changepass', 'aside', [], []);
        }else{
            $user = new Usuario();$user->load($this->session->userdata('usr_id'));
            
            $user->usr_hash = $this->encrypt->encode($this->input->post('perfil_new_pass'));
            $user->save();
            $this->session->set_userdata('usr_pass', $this->input->post('perfil_new_pass'));
            
            
            
            $this->go_to_view('perfil', 'aside_perfil', ["mensaje"], ["Contraseña modificada correctamente"]);
        }
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
    
    public function check_new_password($str) {
        
        echo "new password: ".$str;
        if(!preg_match("/^(?=.*\W)(?=.*\d)(?=.*[A-Z]).{6,}$/", $str)){
            $this->form_validation->set_message('check_new_password', "La contraseña debe tener al menos 6 caracteres, incluyendo un signo de puntuación, un numero y mayusculas");
            return false;
        }
        return true;
    }
    
    public function check_password($str) {
        
        
        
        $usuario = new Usuario();
            
        $usuario->load($this->session->userdata('usr_id'));
        
        
        
        if($this->encrypt->decode($usuario->usr_hash) == $str){
            return true;
        }else{
            $this->form_validation->set_message('check_password', "Contraseña incorrecta");
            return false;
        }
    }
    
    public function validate_email($str) {
        
        if(!filter_var($str, FILTER_VALIDATE_EMAIL)){
            $this->form_validation->set_message('validate_email', "Email no valido, formato -> ejemplo@ejemplo.org");
            return false;
        }
        
        
        $usuario = new Usuario();
        
        $usuario->load($this->session->userdata('usr_id'));
        
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
    
    public function verPedidosHechos() {
        
        $pedido = new Pedido();
        
        $pedidos = $pedido->get_by_userID($this->session->userdata('usr_id'));
        
        /*if($pedidos == NULL){
            echo "ES NULO!";
        }else{
            echo "no es nulo";
        }*/
        
        $this->go_to_view('pedidos', 'aside', ['pedidos'], [$pedidos]);
        
    }
    
}

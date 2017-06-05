<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    
    
    public function index() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'usr_email',        //Nombre del campo en el formulario
                        'label' => 'Email',   //Nombre de la etiqueta asociada
                        'rules' => 'required|callback_check_email'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'pass',
                        'label' => 'Password',
                        'rules' => 'required|callback_check_password'
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            if($this->input->post('usr_email') != NULL){
                $this->go_to_view('login', 'aside', ['email'], [$this->input->post('usr_email')]);
            }  else {
                $this->go_to_view('login', 'aside', [], []);
            }
            
        }else{
            
            $usuario = new Usuario();
            
            $usuario->load_by_email($this->input->post('usr_email'));
            
            $this->session->set_userdata('usr_nombre',      $usuario->usr_nombre);
            $this->session->set_userdata('usr_apellido',    $usuario->usr_apellido);
            $this->session->set_userdata('usr_ciudad',      $usuario->usr_ciudad);
            $this->session->set_userdata('usr_cp',          $usuario->usr_cp);
            $this->session->set_userdata('usr_direccion',   $usuario->usr_direccion);
            $this->session->set_userdata('usr_email',       $usuario->usr_email);
            $this->session->set_userdata('usr_pass',        $this->encrypt->decode($usuario->usr_hash));
            $this->session->set_userdata('usr_id',          $usuario->usr_id);
            $this->session->set_userdata('usr_nivel',       $usuario->usr_nivel);
            
            
            //echo "PASO POR AQUI";
            redirect('Usuarios');
            
        }
    }
    
    public function check_email($str) {
        
        if(!filter_var($str, FILTER_VALIDATE_EMAIL)){
            $this->form_validation->set_message('validate_email', "Email no valido, formato -> ejemplo@ejemplo.org");
            return false;
        }
        
        $usuario = new Usuario();
            
        
        
        if($usuario->exists_by_email($this->input->post('usr_email'))){
            return true;
        }else{
            $this->form_validation->set_message('check_email', "No existe ese usuario");
            return false;
        }
    }
    
    public function check_password($str) {
        $usuario = new Usuario();
            
        $usuario->load_by_email($this->input->post('usr_email'));
        
        if($this->encrypt->decode($usuario->usr_hash) == $str){
            return true;
        }else{
            $this->form_validation->set_message('check_password', "Contraseña incorrecta");
            return false;
        }
    }
    
    //----------------------------------------------------------------------------------------------------
    
    
    
    public function registro() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'usr_email',        //Nombre del campo en el formulario
                        'label' => 'Email',   //Nombre de la etiqueta asociada
                        'rules' => 'required|callback_validate_email'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'pass',
                        'label' => 'Password',
                        'rules' => 'required|callback_check_new_password'
                    ),
                    array(
                        'field' => 'usr_nombre',
                        'label' => 'Nombre',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'usr_apellido',
                        'label' => 'Apellido',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'usr_ciudad',
                        'label' => 'Ciudad',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'usr_cp',
                        'label' => 'Codigo postal',
                        'rules' => 'required|callback_checkCP'
                    ),
                    array(
                        'field' => 'usr_direccion',
                        'label' => 'Direccion',
                        'rules' => 'required'
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class="errorValidacion">','</div>');
        
        if (!$this->form_validation->run()){
            
            $this->go_to_view('registro', 'aside', [], []);
            
            
        }else{
            
            $usuario = new Usuario();
            
            $pass = $this->input->post('pass');
            
            //echo "pass -> ".$pass;
            
            $usuario->usr_apellido  = $this->input->post('usr_apellido');
            $usuario->usr_ciudad    = $this->input->post('usr_ciudad');
            $usuario->usr_cp        = $this->input->post('usr_cp');
            $usuario->usr_direccion = $this->input->post('usr_direccion');
            $usuario->usr_email     = $this->input->post('usr_email');
            $usuario->usr_hash      = $this->encrypt->encode($pass);
            $usuario->usr_nivel     = 1;
            $usuario->usr_nombre    = $this->input->post('usr_nombre');
            
            $usuario->save();
            
            redirect('Tienda/index/Regitrado');
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
    
    public function checkCP($str) {
        //echo "cp: ".$str;
        if(preg_match("/\d{5}/", $str)){
            return true;
        }else{
            $this->form_validation->set_message('checkCP', "Codigo postal invalido, debe tener 5 digitos");
            return false;
        }
    }
    
    public function validate_email($str) {
        
        if(!filter_var($str, FILTER_VALIDATE_EMAIL)){
            $this->form_validation->set_message('validate_email', "Email no valido, formato -> ejemplo@ejemplo.org");
            return false;
        }
        
        $usuario = new Usuario();
            
        if( ! $usuario->exists_by_email($str)){
            return true;
        }  else {
            $this->form_validation->set_message('validate_email', "Ya existe el email ".$usuario->usr_email);
            return false;
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        
        redirect('Tienda');
    }
    
    public function rememberPass(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'email',        //Nombre del campo en el formulario
                        'label' => 'Email',   //Nombre de la etiqueta asociada
                        'rules' => 'required|callback_existe_email'           //regla que debe cumplir
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            //echo "hola";
            $this->go_to_view('login', 'aside', [], []);
        }else{
            //echo "adios";
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'cifrado123@gmail.com',
                'smtp_pass' => 'cifrado1',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
            
            $this->load->library('email', $config);
            //$this->email->initialize($config);
            $this->email->set_newline("\r\n");
            //TODO: NO ENVIA LOS EMAILS
            //$this->load->library('email');
            
            $this->email->from('cifrado123@gmail.com', "NO RESPONDER");
            //$list = array('cifrado123@gmail.com');
            $this->email->to($this->input->post('email'));
            //$this->email->reply_to('cifrado123@gmail.com', 'Consulta lapshop - '.$this->input->post('nombre'));
            //$this->email->to('cifrado123@gmail.com');
            $this->email->subject('Recordar contraseña de lapshop');
            
            $usuario = new Usuario();
            $usuario->load_by_email($this->input->post('email'));
            $this->email->message('Su contraseña es: '.$this->encrypt->decode($usuario->usr_hash));
            
            if($this->email->send()){
                $this->go_to_view('login', 'aside', ['respuesta'], [' Contraseña enviada a su email ']);
            }else{
                $this->go_to_view('login', 'aside', ['respuesta'], [' Hubo un error :( ']);
            }
            
        }
        
    }
    
    public function existe_email($email) {
        
        $usuario = new Usuario();
        
        //echo 'EEEEEEEE -------->'.$email;
        
        if( ! $usuario->exists_by_email($email)){
            $this->form_validation->set_message('existe_email', "No existe usuario con ese email");
            return false;
        }else{
            return true;
        }
        
    }
}
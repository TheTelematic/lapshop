<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    
    protected function go_to_view($mainContent, $aside, $nombres_parametros, $parametros){
        $consulta1 = $this->Categoria->get();
       
        $datos['categorias'] = $consulta1;
        $datos['mainContent'] = $mainContent;
        $datos['aside'] = $aside;
        
        $k = 0;
        foreach ($nombres_parametros as $param){
            $datos[$param] = $parametros[$k];
            $k++;
        }
        
        
        
        $this->load->view('template/template', $datos);
    }
    
    public function sendEmail($email, $subject, $mensaje) {
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
        $this->email->to($email);
        //$this->email->reply_to('cifrado123@gmail.com', 'Consulta lapshop - '.$this->input->post('nombre'));
        //$this->email->to('cifrado123@gmail.com');
        $this->email->subject($subject);

        
        $this->email->message($mensaje);

        return $this->email->send();
            
    }
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Categoria');
        $this->load->model('Producto');
        $this->load->model('Usuario');
        $this->load->model('Pedido');
        $this->load->library('cart');
        
        
    }
    
    
    
    
    
    
}

class UsuarioController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        
        if($this->session->userdata('usr_email') == NULL){
            //$this->load->library("form_validation");
            $this->go_to_view('login', 'aside', ['mensaje_error'], ['ERROR_EMAIL_NOT_VALID']);
        }elseif($this->session->userdata('usr_nivel') == NULL){
            //$this->load->library("form_validation");
            $this->go_to_view('login', 'aside', ['mensaje_error'], ['ERROR_NIVEL_NOT_VALID']);
        }elseif ($this->session->userdata('usr_nivel') == 1 || $this->session->userdata('usr_nivel') == 0) {
            
            
            $this->load->model('Payment');
            //$this->go_to_view('index', 'aside', ['usuario', 'usr_nivel'], [$this->session->userdata('usr_nombre'), 1]);
            
            
            
            /*
            $pedido = new Pedido();
            
            
            
            if($pedido->load($this->session->userdata('usr_id')) == NULL){
                
                $pedido->usuario_id = $this->session->userdata('usr_id');
                $pedido->pedido_subtotal = 0.00;
                $pedido->pedido_direccion_envio = "(SIN ESPECIFICAR)";
                $pedido->pedido_detalles = "";
                $pedido->pedido_codigo_pago = $this->session->userdata('usr_id') * 1000 + 1;
                
            }else{
                
                //$this->load_to_the_cart($pedido);
                
                //Para que no tenga el mismo pedido_id
                //$pedido->delete();
                
                $pedido_vacio = new Pedido();
                
                
                $pedido_vacio->usuario_id = $this->session->userdata('usr_id');
                $pedido_vacio->pedido_subtotal = 0.00;
                $pedido_vacio->pedido_direccion_envio = "(SIN ESPECIFICAR)";
                $pedido_vacio->pedido_detalles = "";
                $pedido_vacio->pedido_codigo_pago = $pedido->pedido_codigo_pago + 1;
                
                
            }*/
            
        }  else {
            
            $this->go_to_view('index', 'aside', ['MENSAJE_DE_ERROR'], ["ERROR_UNKNOWED_USER"]);
            
        }
        
    }
    
    
    //For the future
    public function load_to_the_cart($pedido) {
        
        $this->cart->update(unserialize($pedido->pedido_detalles));
        
        
    }
}

class AdminController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        
        if($this->session->userdata('usr_email') == NULL){
            $this->go_to_view('login', 'aside', ['mensaje_error'], ['ERROR_EMAIL_NOT_VALID']);
        }
        if($this->session->userdata('usr_nivel') == NULL){
            $this->go_to_view('login', 'aside', ['mensaje_error'], ['ERROR_EMAIL_NOT_VALID']);
        }elseif ($this->session->userdata('usr_nivel') == 0) {
            
            //$this->go_to_view('index', 'aside', ['usuario', 'usr_nivel'], [$this->session->userdata('usr_nombre'), 0]);
            
        }
        else {
            
            $this->go_to_view('login', 'aside', ['mensaje_error'], ['ERROR_UNKNOWED_ADMIN']);
            
        }
        
    }
}
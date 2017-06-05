<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends MY_Controller {
    
    public function index() {
        $this->go_to_view('contacto', 'aside', [], []);
    }
    public function enviar_contacto() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'nombre',        //Nombre del campo en el formulario
                        'label' => 'Nombre',   //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'mensaje',
                        'label' => 'Mensaje',
                        'rules' => 'required'
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            $this->go_to_view('contacto', 'aside', [], []);
        }else{
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
            
            $this->email->from($this->input->post('email'), $this->input->post('nombre'));
            //$list = array('cifrado123@gmail.com');
            $this->email->to('cifrado123@gmail.com');
            //$this->email->reply_to('cifrado123@gmail.com', 'Consulta lapshop - '.$this->input->post('nombre'));
            //$this->email->to('cifrado123@gmail.com');
            $this->email->subject('Consulta lapshop - '.$this->input->post('nombre'));
            $this->email->message($this->input->post('mensaje'));
            
            if($this->email->send()){
                $this->go_to_view('contacto', 'aside', ['respuesta'], [' Mensaje enviado! ']);
            }else{
                $this->go_to_view('contacto', 'aside', ['respuesta'], [' Hubo un error :( ']);
            }
            //var_dump($this->email->print_debugger());
        }
    }
    
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends UsuarioController{
    
    public function success() {
        //redirect('Carrito/doPurchase');
        $this->session->set_flashdata('pedido', 'Pago por Paypal hecho! :D');
        redirect('Tienda');
    }
    
    public function cancel() {
        $this->go_to_view('carrito', 'aside', ['mensaje'], ['Pago cancelado']);
    }
    
    public function ipn() {
        redirect('Payments/ipn');
    }
    
}
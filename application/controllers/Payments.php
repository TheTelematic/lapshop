<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends UsuarioController{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library('paypal_lib');
    }
    
    public function buy($id) {
        
        $paypalURL  = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $paypalID   = 'cifrado123-facilitator@gmail.com';
        $returnURL  = base_url().'index.php/Paypal/success';
        $cancelURL  = base_url().'index.php/Paypal/cancel';
        $notifyURL  = base_url().'index.php/Paypal/ipn';
        
        $product    = new Producto();
        $product->load($id);
        $logo       = base_url().'img/logo.png';
        
        $this->paypal_lib->add_field('business'     , $paypalID);
        $this->paypal_lib->add_field('return'       , $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url'   , $notifyURL);
        $this->paypal_lib->add_field('item_name'    , $product->producto_nombre);
        $this->paypal_lib->add_field('custom'       , $this->session->userdata('usr_id'));
        $this->paypal_lib->add_field('item_number'  , $product->producto_id);
        $this->paypal_lib->add_field('amount'       , $product->producto_precio);
        $this->paypal_lib->image($logo);
        
        $this->paypal_lib->paypal_auto_form();
        
    }
    
    public function ipn() {
        $paypalInfo = $this->input->post();
        
        $data['user_id']    = $paypalInfo['custom'];
        $data['product_id'] = $paypalInfo['item_number'];
        $data['txn_id']     = $paypalInfo['txn_id'];
        $data['payment_gross'] = $paypalInfo['payment_gross'];
        $data['currency_code'] = $paypalInfo['mc_currency'];
        $data['payer_email']   = $paypalInfo['payer_email'];
        $data['payment_status']= $paypalInfo['payment_status'];
        
        $paypalURL = $this->paypal_lib->paypal_url;
        $result    = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);
        
        if(eregi("VERIFIED", $result)){
            $this->Carrito->doPurchase();
        }
        
    }
    
}
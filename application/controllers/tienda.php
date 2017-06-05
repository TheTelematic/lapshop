<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda extends MY_Controller {
    
    
    private function get_top_products() {
        //Ahora solo devuelve todos los productos, TODO modificar esto
        //$this->load->model('Producto');
        //nos vamos a traer todas las categorias
        $consulta = $this->Producto->get(6);
        
        return $consulta;
    }
    
   public function index($mensaje=NULL){
      
     if($mensaje == NULL){
         
        $this->go_to_view("index", "aside", ["productos", "mensaje"], [$this->get_top_products(), $this->session->flashdata('pedido')]);
     }else{
        $this->go_to_view("index", "aside", ["productos", "mensaje"], [$this->get_top_products(), $mensaje]);
     }
       
      
      

   }
   
   
}


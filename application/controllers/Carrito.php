<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends UsuarioController{
    
    public function index() {
        
        $this->go_to_view('carrito', 'aside_carrito', [], []);
        
    }
    
    public function process($productoID) {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'accion',
                        'label' => 'Accion',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'cantidad',
                        'label' => 'Cantidad',
                        'rules' => 'callback_check_cantidad'
                    )
                    
                )
        );
        
        
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){
            
            //redirect('Productos/get_producto/'.$productoID);
            $this->go_to_view('carrito', 'aside_carrito', [], []);
            
        }else{
            
            if($this->input->post('accion') == 'Añadir'){
                
                if($this->input->post('cantidad') == NULL){
                    $this->add_item($productoID, 1);
                }else{
                    $this->add_item($productoID, $this->input->post('cantidad'));
                }
                
            }elseif ($this->input->post('accion') == 'Eliminar') {
                
                if($this->input->post('cantidad') == NULL){
                    $this->remove_item($productoID, 1);
                }else{
                    $this->remove_item($productoID, $this->input->post('cantidad'));
                }
                
            }elseif ($this->input->post('accion') == 'Finalizar compra'){
                
                if($this->input->post('direccion') == NULL){
                    
                    $this->doPurchase();
                    
                }else{
                    $this->doPurchase($this->input->post('direccion'));
                    
                    
                }
                $this->session->set_flashdata('pedido', 'Pedido hecho correctamente! :D');
                redirect('Tienda');
            }else{
                
                $this->go_to_view('error', 'aside', ['MENSAJE_DE_ERROR'], ['ACCION DESCONOCIDA']);
                
            }
            
        }
        
        
    }
    
    
    public function add_item($producto_id, $cantidad) {
        
        $producto = new Producto();
        
        $producto->load($producto_id);
        
        if($producto->producto_stock > $cantidad){
            
            $data = array(
                    'id'      => $producto_id,
                    'qty'     => $cantidad,
                    'price'   => $producto->producto_precio,
                    'name'    => $producto->producto_nombre,
            );

            $this->cart->insert($data);
            
            $this->go_to_view('carrito', 'aside_carrito', ['mensaje'], ['Producto añadido al carrito']);
            
        }else{
            
            $this->go_to_view('carrito', 'aside_carrito', ['error'], ['No hay stock suficiente']);
            
        }
        
    }
    
    public function remove_item($producto_id, $cantidad) {
        
        $productos = $this->cart->contents();
        
        foreach ($productos as $item){
            
            if($item['id'] == $producto_id){
                $rowID = $item['rowid'];
                $cantidad_Old = $item['qty'];
                break;
            }
            
        }
        
        if(($cantidad_Old - $cantidad) >= 0){
        
            if(isset($rowID)){

                $data = array(
                        'rowid' => $rowID,
                        'qty'   => $cantidad_Old - $cantidad
                );

                $this->cart->update($data);

                 $this->go_to_view('carrito', 'aside_carrito', ['mensaje'], ['Producto borrado']);

            }else{
                $this->go_to_view('carrito', 'aside_carrito', ['MENSAJE_DE_ERROR'], ['ERROR, NO SE ENCUENTRA ESE PRODUCTO EN SU CARRITO']);
            }
        }else{
            $this->go_to_view('carrito', 'aside_carrito', ['error'], ['No puede borrar más de lo que tiene añadido']);
        }
        
    }
    
    public function doPurchase($direccionEnvio = NULL) {
        
        $cartString = serialize($this->cart->contents());
        
        $pedido = new Pedido();
        
        $pedido->usuario_id = $this->session->userdata('usr_id');
        $usuario = new Usuario();
        $usuario->load($this->session->userdata('usr_id'));
        
        if($direccionEnvio == NULL){
            
            
            $direccionEnvio = $usuario->usr_direccion;
            
            
        }
        $pedido->pedido_direccion_envio = $direccionEnvio;
        $pedido->pedido_codigo_pago = 0;
        $pedido->pedido_subtotal = $this->cart->total();
        $pedido->pedido_detalles = $cartString;
        
        
        $pedido->save();
        $pedido->pedido_codigo_pago = $pedido->pedido_id;
        
        $pedido->save();
        
        
        
        $productos = $this->cart->contents();
        
        $mensaje = '<html>Pedido de lapshop realizado correctamente<br>Productos:<ul>';
        foreach ($productos as $item){
            
            $temp = new Producto();
            
            $temp->load($item['id']);
            
            $temp->producto_stock -= $item['qty'];
            
            $temp->save();
            
            $mensaje = $mensaje.'<li>'.$item['qty'].' - '.$item['name'].' '.$item['price'].'€/ud</li>';
            
        }
        
        $this->cart->destroy();
        
        
        
            
        
       
        $mensaje = $mensaje.'</ul>Total:'.$pedido->pedido_subtotal.'<br>'.$pedido->pedido_direccion_envio.'</html>';
        
        $this->sendEmail($usuario->usr_email, "Pedido hecho", $mensaje);
        
    }
    
    public function check_cantidad($cantidad) {
        
        
        
        if($cantidad != NULL && $cantidad <= 0 && gettype($cantidad) != "integer"){
            
            $this->form_validation->set_message('check_cantidad', "La cantidad debe ser entera positiva");
            
            return false;
        }
        
        return true;
    }
    
}

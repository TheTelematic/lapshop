<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Model{
    private $nametable = 'pedidos';
    
    public $pedido_id;
    public $usuario_id;
    public $pedido_detalles;
    public $pedido_subtotal;
    public $pedido_codigo_pago;
    public $pedido_direccion_envio;
    
    
    private function insert(){
        $this->db->insert($this->nametable, $this);
        
        $this->pedido_id = $this->db->insert_id();
    }
    private function update(){
        $this->db->update(
                $this->nametable,//La base de datos
                $this,//Que valores cojo
                array('pedido_id' => $this->pedido_id)//Donde los coloco
        );
    }
    
    
    /*
     * Guarda una categoria nueva o si existe la actualiza
     */
    public function save(){
        if (isset($this->pedido_id)){
            $this->update();
        }else{
            $this->insert();
        }
    }
    
    
    /*
     * Funcion que devuelve todos los productos
     */
    public function get(){
        //hacemos una consulta a la tabla de la db
        $consulta = $this->db->get($this->nametable);
        return $consulta->result_array();
        
    }
    
    
    public function get_by_userID($userID){
        $filas = $this->db->get_where($this->nametable,
                array('usuario_id' => $userID));
        
        return $filas;
        
    }
    
    
    
    
    


    /*
     * Funcion para cargar los valores de una categoria, dado su id
     */
    public function load($id) {
        $fila = $this->db->get_where(
                    $this->nametable,
                    array('pedido_id' => $id)
                )->row();
        
        if($fila == NULL){
            return NULL;
        }
        
        $this->pedido_id = $fila->pedido_id;
        $this->usuario_id = $fila->usuario_id;
        $this->pedido_detalles = $fila->pedido_detalles;
        $this->pedido_subtotal = $fila->pedido_subtotal;
        $this->pedido_codigo_pago = $fila->pedido_codigo_pago;
        $this->pedido_direccion_envio = $fila->pedido_direccion_envio;
    }
    
    /*
     * Funcion para borrar una categoria
     */
    public function delete() {
        $this->db->delete(
                $this->nametable,
                array('pedido_id' => $this->pedido_id));
        unset($this->pedido_id);
    }
}
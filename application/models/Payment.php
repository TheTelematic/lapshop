<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Model{
    private $nametable = 'payments';
    
    public $payment_id;
    public $user_id;
    public $product_id;
    public $txn_id;
    public $payment_gross;
    public $currency_code;
    public $payer_email;
    public $payment_status;
    
    
    private function insert(){
        $this->db->insert($this->nametable, $this);
        
        $this->payment_id = $this->db->insert_id();
    }
    private function update(){
        $this->db->update(
                $this->nametable,//La base de datos
                $this,//Que valores cojo
                array('payment_id' => $this->payment_id)//Donde los coloco
        );
    }
    
    
    /*
     * Guarda una categoria nueva o si existe la actualiza
     */
    public function save(){
        if (isset($this->payment_id)){
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
                array('user_id' => $userID));
        
        return $filas;
        
    }
    
    
    
    
    


    /*
     * Funcion para cargar los valores de una categoria, dado su id
     */
    public function load($id) {
        $fila = $this->db->get_where(
                    $this->nametable,
                    array('payment_id' => $id)
                )->row();
        
        if($fila == NULL){
            return NULL;
        }
        
        $this->payment_id = $fila->payment_id;
        $this->currency_code = $fila->currency_code;
        $this->payer_email = $fila->payer_email;
        $this->payment_gross = $fila->payment_gross;
        $this->payment_status = $fila->payment_status;
        $this->product_id = $fila->product_id;
        $this->txn_id = $fila->txn_id;
        $this->user_id = $fila->user_id;
    }
    
    /*
     * Funcion para borrar una categoria
     */
    public function delete() {
        $this->db->delete(
                $this->nametable,
                array('payment_id' => $this->payment_id));
        unset($this->payment_id);
    }
}
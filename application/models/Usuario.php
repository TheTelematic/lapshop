<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model{
    private $nametable = 'usuarios';
    
    public $usr_id;
    public $usr_nombre;
    public $usr_apellido;
    public $usr_email;
    public $usr_hash;
    public $usr_direccion;
    public $usr_ciudad;
    public $usr_cp;
    public $usr_nivel;
    
    
    private function insert(){
        $this->db->insert($this->nametable, $this);
        
        $this->usr_id = $this->db->insert_id();
    }
    private function update(){
        $this->db->update(
                $this->nametable,//La base de datos
                $this,//Que valores cojo
                array('usr_id' => $this->usr_id)//Donde los coloco
        );
    }
    
    
    /*
     * Guarda una categoria nueva o si existe la actualiza
     */
    public function save(){
        if (isset($this->usr_id)){
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
    
    public function get_normal_users() {
        $filas = $this->db->get_where($this->nametable,
                array('usr_nivel' => 1));
        
        
        return $filas->result();
    }
    public function exists_by_email($email) {
        $fila = $this->db->get_where(
                    $this->nametable,
                    array('usr_email' => $email)
                )->row();
        
        if($fila == NULL){
            return false;
        }else{
            return true;
        }
    }
    
    
    public function load_by_email($email) {
        $fila = $this->db->get_where(
                    $this->nametable,
                    array('usr_email' => $email)
                )->row();
        
        if($fila == NULL){
            return NULL;
        }
        
        $this->usr_id = $fila->usr_id;
        $this->usr_nombre = $fila->usr_nombre;
        $this->usr_apellido = $fila->usr_apellido;
        $this->usr_email = $fila->usr_email;
        $this->usr_ciudad = $fila->usr_ciudad;
        $this->usr_hash = $fila->usr_hash;
        $this->usr_cp = $fila->usr_cp;
        $this->usr_nivel = $fila->usr_nivel;
        $this->usr_direccion = $fila->usr_direccion;
    }
    
    


    /*
     * Funcion para cargar los valores de una categoria, dado su id
     */
    public function load($id) {
        $fila = $this->db->get_where(
                    $this->nametable,
                    array('usr_id' => $id)
                )->row();
        
        if($fila == NULL){
            return NULL;
        }
        
        $this->usr_id = $fila->usr_id;
        $this->usr_nombre = $fila->usr_nombre;
        $this->usr_apellido = $fila->usr_apellido;
        $this->usr_email = $fila->usr_email;
        $this->usr_ciudad = $fila->usr_ciudad;
        $this->usr_hash = $fila->usr_hash;
        $this->usr_cp = $fila->usr_cp;
        $this->usr_nivel = $fila->usr_nivel;
        $this->usr_direccion = $fila->usr_direccion;
    }
    
    /*
     * Funcion para borrar una categoria
     */
    public function delete() {
        $this->db->delete(
                $this->nametable,
                array('usr_id' => $this->usr_id));
        unset($this->usr_id);
    }
}
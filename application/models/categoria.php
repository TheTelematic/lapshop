<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Model{
    
    /*
     * Identificador unico de categoria
     */
    public $cat_id;
    
    /*
     * Nombre de la categoria
     */
    public $cat_nombre;
    
    /*
     * Nombre de la categoria en la URL (filtrar)
     */
    public $cat_nombre_url;
    
    
    
    /*
     * Funcion para insertar una nueva categoria
     */
    private function insert(){
        $this->db->insert('categorias', $this);
        
        $this->cat_id = $this->db->insert_id();
    }
    
    private function update(){
        $this->db->update(
                'categorias',//La base de datos
                $this,//Que valores cojo
                array('cat_id' => $this->cat_id)//Donde los coloco
        );
    }
    
    
    /*
     * Guarda una categoria nueva o si existe la actualiza
     */
    public function save(){
        if (isset($this->cat_id)){
            $this->update();
        }else{
            $this->insert();
        }
    }
    
    
    /*
     * Funcion que devuelve todas las categorias
     */
    public function get(){
        //hacemos una consulta a la tabla de la db
        $consulta = $this->db->get('categorias');
        return $consulta->result_array();
        
    }
    
    /*
     * Funcion para cargar los valores de una categoria, dado su id
     */
    public function load($id) {
        $fila = $this->db->get_where(
                    'categorias',
                    array('cat_id' => $id)
                )->row();
        
        $this->cat_id = $id;
        $this->cat_nombre = $fila->cat_nombre;
        $this->cat_nombre_url = $fila->cat_nombre_url;
    }
    
    /*
     * Funcion para borrar una categoria
     */
    public function delete() {
        $this->db->delete(
                'categorias',
                array('cat_id' => $this->cat_id));
        unset($this->cat_id);
    }
}
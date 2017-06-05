<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Model{
    private $nametable = 'productos';
    
    public $producto_id;
    public $producto_nombre;
    public $producto_codigo;
    public $producto_descripcion;
    public $categoria_id;
    public $producto_precio;
    public $producto_stock;
    public $producto_imagen;
    public $producto_iva;
    
    
    private function insert(){
        $this->db->insert($this->nametable, $this);
        
        $this->producto_id = $this->db->insert_id();
    }
    private function update(){
        $this->db->update(
                $this->nametable,//La base de datos
                $this,//Que valores cojo
                array('producto_id' => $this->producto_id)//Donde los coloco
        );
    }
    
    
    /*
     * Guarda una categoria nueva o si existe la actualiza
     */
    public function save(){
        if (isset($this->producto_id)){
            $this->update();
        }else{
            $this->insert();
        }
    }
    
    
    /*
     * Funcion que devuelve todos los productos
     */
    public function get($max=NULL){
        //hacemos una consulta a la tabla de la db
        if($max == NULL){
            $consulta = $this->db->get($this->nametable);
        }else{
            $consulta = $this->db->get($this->nametable, $max);
        }
        
        return $consulta->result_array();
        
    }
    
    /*
     * Funcion que devuelve todos los productos de una categoria
     */
    public function get_of_cat($id) {
        $filas = $this->db->get_where($this->nametable,
                array('categoria_id' => $id));
        
        
        
        return $filas;
    }


    /*
     * Funcion para cargar los valores de una categoria, dado su id
     */
    public function load($id) {
        $fila = $this->db->get_where(
                    $this->nametable,
                    array('producto_id' => $id)
                )->row();
        
        $this->producto_id = $id;
        $this->producto_codigo = $fila->producto_codigo;
        $this->producto_descripcion = $fila->producto_descripcion;
        $this->categoria_id = $fila->categoria_id;
        $this->producto_precio = $fila->producto_precio;
        $this->producto_nombre = $fila->producto_nombre;
        $this->producto_stock = $fila->producto_stock;
        $this->producto_imagen = $fila->producto_imagen;
        $this->producto_iva = $fila->producto_iva;
    }
    
    /*
     * Funcion para borrar una categoria
     */
    public function delete() {
        $this->db->delete(
                $this->nametable,
                array('producto_id' => $this->producto_id));
        unset($this->producto_id);
    }
    
}
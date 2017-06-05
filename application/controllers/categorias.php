<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends AdminController {
    
    
    public function index(){
        /*$this->load->model('Categoria');
        //nos vamos a traer todas las categorias
       $consulta = $this->Categoria->get();
       
       
       //mostramos el resultado por pantalla(para debug, aqui no se debe hacer)
       //echo "<pre>".var_export($consulta)."</pre>";
       
       //cargamos una vista
       $datos['categorias'] = $consulta;
        $datos['mainContent'] = "categorias";
        $datos['aside'] = "aside_categorias";
        $this->load->view('template/template', $datos);*/
        
        $this->go_to_view("categorias", "aside_categorias", [], []);
    }
    
    
    public function addCatV($nombre_corto = null){
        //$this->load->model('Categoria');
        
        //cargar libreria de validacion
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'cat_nombre',        //Nombre del campo en el formulario
                        'label' => 'Nueva_categoria',   //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'cat_nombre_corto',
                        'label' => 'Nombre corto',
                        'rules' => 'required|callback_check_categoria'
                    )
                )
        );
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        
        if (!$this->form_validation->run()){/*
            $datos['nombre_corto'] = $nombre_corto;
            $datos['mainContent'] = "form_categorias";
            $datos['aside'] = 'aside_categorias';
            $this->load->view('template/template', $datos);*/
            
            $this->go_to_view("form_categorias", "aside_categorias", ["nombre_corto"], [$nombre_corto]);
        }else{
            $newCat = new Categoria();
            
            $newCat->cat_nombre = $this->input->post('cat_nombre');
            $newCat->cat_nombre_url = $this->input->post('cat_nombre_corto');
            
            
            $newCat->save();
            
            
            redirect('Categorias');
        }
    }
    
    public function check_categoria($str){
        //$this->load->model('Categoria');
        
        $categorias = (new Categoria())->get();
        
        foreach ($categorias as $cat){
            if ($cat['cat_nombre_url'] == $str){
                $this->form_validation->set_message('check_categoria', "Ese nombre corto de categoria ya existe.");
                return false;
            }
        }
        
        return true;
    }
    
    public function editCatV() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'cat_nombre',        //Nombre del campo en el formulario
                        'label' => 'Categoria',         //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    ),
                    array(
                        'field' => 'cat_nombre_corto',
                        'label' => 'Nombre corto',
                        'rules' => 'required|callback_check_nombrecorto'
                    )
                )
        );
        
        
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        if (!$this->form_validation->run()){
            /*$this->load->model('Categoria');
            
            $datos['categorias'] = $this->Categoria->get();
            $datos['mainContent'] = "form_edit_categoria";
            $datos['aside'] = 'aside_categorias';
            $this->load->view('template/template', $datos);*/
            
            $this->go_to_view("form_edit_categoria","aside_categorias" , [], []);
        }else{
            $newCat = new Categoria();
            
            foreach ((new Categoria())->get() as $cat){
                if ($cat['cat_nombre_url'] == $this->input->post('cat_nombre_corto')){
                    $id = $cat['cat_id'];
                }
            }
            
            $newCat->cat_id = $id;
            $newCat->cat_nombre = $this->input->post('cat_nombre');
            $newCat->cat_nombre_url = $this->input->post('cat_nombre_corto');
            
            
            $newCat->save();
            
            
            redirect('Categorias');
        }
    }
    
    public function check_nombrecorto($str){
        
        /*echo $this->input->post('cat_nombre')."<br>";
        echo $this->input->post('cat_nombre_corto')."<br>";
        echo $str;*/
        
        //$this->load->model('Categoria');
        
        $categorias = (new Categoria())->get();
        
        //$tmp = $str."<br>";
        foreach ($categorias as $cat){
            //$tmp .= $cat['cat_nombre_url']."<br>";
            if ($cat['cat_nombre_url'] == $str){
                
                return true;
            }
        }
        $this->form_validation->set_message('check_nombrecorto', "Ese nombre corto de categoria no existe.<br>Si quiere editarlo debe de ".anchor('categorias/addCatV/'.$str,'crear una categoria nueva').".<br>");
        return false;
    }
    
    
    public function borrarCatV($cat_id) {
        if (!isset($cat_id)){
            /*$this->load->model('Categoria');
            
            $datos['categorias'] = $this->Categoria->get();
            $datos['mainContent'] = "form_edit_categoria";
            $datos['aside'] = 'aside_categorias';
            $this->load->view('template/template', $datos);*/
            
            $this->go_to_view("form_borrar_categoria","aside_categoria" , ["error"], ["Hubo un error borrando"]);
        }else{
            //$this->load->model('Categoria');
            $cat = new Categoria();
            
            $cat->load($cat_id);
            
            $cat->delete();
            
            $productos = new Producto();
            $productos->get_of_cat($cat_id);
            
            foreach ($productos->result() as $producto){
                $producto->delete();
            }
            
            redirect('Categorias');
        }
    }
     
    
    public function borrarCat() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'cat_id',        //Nombre del campo en el formulario
                        'label' => 'Categoria',         //Nombre de la etiqueta asociada
                        'rules' => 'required'           //regla que debe cumplir
                    )
                )
        );
        
        
        
        $this->form_validation->set_error_delimiters(
                '<div class=errorValidacion>','</div>');
        if (!$this->form_validation->run()){
            /*$this->load->model('Categoria');
            
            $datos['categorias'] = $this->Categoria->get();
            $datos['mainContent'] = "form_edit_categoria";
            $datos['aside'] = 'aside_categorias';
            $this->load->view('template/template', $datos);*/
            
            $this->go_to_view("form_borrar_categoria","aside_categorias" , [], []);
        }else{
            $this->load->model('Categoria');
            
            $categoria = new Categoria();
            $categoria->load($this->input->post('cat_id'));
            
            $this->go_to_view("confirmar_borrar_cat", "aside", ["cat_id", "cat_nombre"], [$categoria->cat_id, $categoria->cat_nombre ]);
        }
    }
}

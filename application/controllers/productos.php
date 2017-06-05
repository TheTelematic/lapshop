<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends MY_Controller {
    
    
    public function index(){
        
        //$this->load->model('Producto');
        //nos vamos a traer todas las categorias
        $consulta = $this->Producto->get();


        //mostramos el resultado por pantalla(para debug, aqui no se debe hacer)
        //echo "<pre>".var_export($consulta)."</pre>";
/*
        //cargamos una vista
        $datos['productos'] = $consulta;
        $datos['mainContent'] = "productos";
        $datos['aside'] = "aside_productos";
        $this->load->view('template/template', $datos);*/
        
        
        $this->go_to_view("productos", "aside_productos", ["productos"], [$consulta]);
    }
    
    public function ver_por_categoria($id){
        //$this->load->model('Producto');
        //$this->load->model('Categoria');
        
        $productos = (new Producto())->get_of_cat($id);
        $cat = new Categoria();
        $cat->load($id);
        
        /*
        $datos['productos'] = $productos;
        $datos['categoria'] = $cat->cat_nombre;
        $datos['mainContent'] = 'productos_por_categoria';
        $datos['aside'] = 'aside';
        $this->load->view('template/template', $datos);
        */
        
        $this->go_to_view('productos_por_categoria', 'aside', ['productos', 'categoria'], [$productos, $cat->cat_nombre]);
    }
    
    
    public function get_producto($id) {
        //$this->load->model('Producto');
        //$this->load->model('Categoria');
        
        $producto = new Producto();
        
        $producto->load($id);
        $categoria = new Categoria();
        $categoria->load($producto->categoria_id);
        
        
        
        $this->go_to_view('producto', 'aside', ["producto", "categoria"], [$producto, $categoria]);
    }
    
    public function buscar() {
        
        $this->load->library("form_validation");
        $this->form_validation->set_rules(
                array(
                    array(
                        'field' => 'busqueda',
                        'label' => 'El buscador',
                        'rules' => 'required'
                    )
                )
        );
        
        if (!$this->form_validation->run()){
            redirect('Tienda');
        }else{
            
            //quitar acentos de las palabras claves
            $busqueda = $this->clean($this->input->post('busqueda'));
            
            //echo $busqueda.'<br>';
            
            $keywords = explode(' ', strtolower($busqueda));
            
            $tipoDeBusqueda = 'producto_nombre';
            if(count($keywords) == 1){
                
                $codigo = intval($keywords[0]);
                
                if($codigo != 0){
                    $tipoDeBusqueda = 'producto_codigo';
                }
                
            }
            $matched = [];
            $all_products = $this->Producto->get();

            foreach ($keywords as $key){
                //echo $key.'<br>';

                $result = $this->matchProduct($all_products, $key, $tipoDeBusqueda, $matched );
                if($result !== FALSE){
                    //echo 'UNION!';
                    $matched = array_merge($result, $matched);
                    //echo 'result: '.count($result).'<br>';
                }

            } 
            
            
            
            
            
            $this->go_to_view('busqueda', 'aside', ['productos', 'busqueda'], [$matched, $busqueda]);
            
        }
        
    }
    
    public function matchProduct($all_products, $key, $tipoDeBusqueda, $productsFound = []) {
        $productos = [];
        foreach($all_products as $producto){
            
            
            //convertimos temporalmente el nombre de un producto a lo que queremos
            $tmp = strtolower($this->clean($producto[$tipoDeBusqueda]));
            
            //echo "Producto: ".$producto['producto_nombre'].'<br>Keyword: '.$key.'<br>';
            if(strpos($tmp, $key) !== FALSE){
                //echo "!!! COINCIDENCIA --> ".$producto['producto_nombre'].'<br>';
                $ya_encontrado = false;
                foreach ($productsFound as $pF){
                    if($pF['producto_id'] == $producto['producto_id']){
                        $ya_encontrado = true;
                        break;
                    }
                }
                if(!$ya_encontrado){
                    array_push($productos, $producto); 
                }
                
            }

        }
        
        if(count($productos) <= 0){
            //echo "productos vacios";
            return FALSE;
        }else{
            //echo 'productos no vacios';
            return $productos;
        }
        
        
    }
    
    public function clean($str) {
        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        return strtr( $str, $unwanted_array );
    }
    
}
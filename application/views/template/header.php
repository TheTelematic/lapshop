
    

<html>
    <head>
        <title>	lapshop</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <?php echo link_tag('css/style_1.css')?>
        
    </head>
    <body>
        
        <header id="_header">
            <a href="<?php echo base_url();?>"><img alt="lapshop" src="<?php echo base_url(); ?>img/logo.png"/>
            <h1 title="Tienda de portátiles">lapshop</h1></a>
            
            
            
<?php
if(isset($MENSAJE_DE_ERROR)){
    echo "<div style=\"border: 1px red solid; background-color: black; color: yellow;\">".$MENSAJE_DE_ERROR."</div>";
}
$usuario = $this->session->userdata('usr_nombre');
$usr_nivel = $this->session->userdata('usr_nivel');
if ($usuario != NULL){
    $logout = base_url()."index.php/Login/logout";
    $carrito = base_url()."index.php/Carrito";
    $num_items_carrito = $this->cart->total_items();
    if($num_items_carrito == NULL){
        $num_items_carrito = 0;
    }
    echo '<div class="cajon_usuario"';
    
    if($usr_nivel == 0){
        echo 'style="background-color: red;"';
    }
    
    echo '>';
    print <<<bloq
    
    <h4 id="titulo_cajon_usuario">Estas conectado como $usuario - <a id="banner_carrito" href="$carrito">Carrito ($num_items_carrito)</a> - <a id="logout" href="$logout">Logout</a></h4>
            
bloq;

}else{
    $login = base_url()."index.php/Login";
    $registro = base_url()."index.php/Login/registro";
    print <<<bloq
    <div class="cajon_usuario">
    <h4 id="titulo_cajon_usuario"><a href="$login" >Login</a> - <a href="$registro">Registro</a></h4>
    <form action="$login" method="post">
            <input type="email" id="email" name="usr_email" placeholder="Email">
            <input type="password" id="pass" name="pass" placeholder="Contraseña">
            <input type="submit" id="logear" value="Login">
    </form>
            
bloq;
}
?>
            </div>
            
        </header>


        <nav>
            <form method="post" action="<?php  echo base_url(); ?>index.php/Productos/buscar">
            <ul>
                
                <li id="t_cats"><?php echo anchor('categorias','Categorias');?></li>
                <li><a href="<?php echo base_url();?>index.php/Productos">Productos</a></li>
                <?php
                    if ($usuario != NULL){?>
                        <li><a href="<?php echo base_url();?>index.php/Usuarios/modify/0">Mi Perfil</a></li>
                <?php
                        if($usr_nivel == 0){?>
                            <li><a href="<?php echo base_url();?>index.php/Admins/">Administrar</a></li>
                <?php
                        }
                
                    }
                ?>
                <input type="text" id="buscador" name="busqueda" style="float: right;" placeholder="Buscar por palabras clave o código..." size="60">
                
            </ul>
            </form>
        </nav>
        
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/header.js"></script>
        <section>
        <div id="todas_categorias" hidden>
            
            <?php
                //TODO: Mandar todas categorias en cada controlador
            foreach($categorias as $cat){
                
                $tmp =  "<div class=\"categoria_oculta\" hidden> > ".html_escape($cat['cat_nombre'])."</div>";
                echo anchor('Productos/ver_por_categoria/'.$cat['cat_id'],$tmp );
            }
            
            
            ?>
            <div id="ocultar_categorias_ocultas" class="categoria_oculta" style="cursor: pointer; text-align: center;" hidden>^Cerrar^</div>
        </div>



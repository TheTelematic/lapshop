

$('document').ready(function(){
    $ancho_original = $('.contenidoSection').innerWidth();
    $ancho_lateral = $('.categoria_oculta').css("width").replace("px", "");
    $ancho_body = $('body').innerWidth();
    $('#t_cats').on('mouseover', function(){
        if(!$('.categoria_oculta').is(':visible')){
            console.log("entro");
            $('.categoria_oculta').show(600);
        
            $tmp = ($ancho_original - $ancho_lateral)/$ancho_body*100;

            $('.contenidoSection').animate({
                width: $tmp+"%"
                },500);
        }
        
        /*console.log("ancho original: " + $ancho_original);
        console.log("lateral: " + $ancho_lateral);
        console.log("body: " + $ancho_body);
        console.log("resultado: " + ($ancho_original - $ancho_lateral)/$ancho_body*100 + "%");*/
        
    });
    $('#ocultar_categorias_ocultas').on('click', function(){
        
        $('.categoria_oculta').hide(500);
        $tmp = $ancho_original/$ancho_body*100;
        
        $('.contenidoSection').animate({
            width: $tmp+"%"
            },500);
    });
    
    
    
});


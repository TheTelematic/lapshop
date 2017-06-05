

$("document").ready(function (){
    $("#select_cat_nombre").on('change', function (){
        var cat_id = document.getElementById('select_cat_nombre').value;
        //console.log(cat_id);
        var cat_nombre = document.getElementById('categoria_nombre_'+ cat_id);
        var cat_nombre_corto = document.getElementById('categoria_nombre_corto_'+ cat_id);

        //console.log(cat_nombre + " -- " + cat_nombre_corto);
        document.getElementById('cat_nombre').value = cat_nombre.attributes[1].value;
        //console.log(document.getElementById('cat_nombre').value);
        document.getElementById('cat_nombre_corto').value = cat_nombre_corto.attributes[1].value;
        
        
        
        $('#formCategorias').show(300,null);
    });
});


function enable(){
    document.getElementById('cat_nombre_corto').disabled = false;
}
/*
function fillFieldsCategoria(){
    var cat_id = document.getElementById('select_cat_nombre').value;
    var cat_nombre = document.getElementById('categoria_nombre_'+ cat_id);
    var cat_nombre_corto = document.getElementById('categoria_nombre_corto_'+ cat_id);
    
    
    document.getElementById('cat_nombre').value = cat_nombre;
    document.getElementById('cat_nombre_corto').value = cat_nombre_corto;
    
    document.getElementById('campos').hidden = false;
    
}*/
$('document').ready(function (){
    $cambiar = false;
    $('#cambiarPass').on('click', function (){
       $('#perfil_new_pass').prop("disabled", $cambiar);
       $('#perfil_new_pass2').prop("disabled", $cambiar);
       
       $cambiar = !$cambiar;
    });
    
    $('#perfil_new_pass2').on('keyup', function (){
        
        if ($('#perfil_new_pass')[0].value !== $('#perfil_new_pass2')[0].value){
            document.getElementById("pass_not_matched").hidden = false;
        }else{
            document.getElementById("pass_not_matched").hidden = true;
        }
        
    });
    
    $('#unlock').on('click', function (){
        $('#perfil_nombre').prop("disabled", false);
        $('#perfil_apellido').prop("disabled", false);
        $('#perfil_direccion').prop("disabled", false);
        $('#perfil_ciudad').prop("disabled", false);
        $('#perfil_cp').prop("disabled", false);
        $('#perfil_email').prop("disabled", false);
        //$('#perfil_new_pass').prop("disabled", false);
        //$('#perfil_new_pass2').prop("disabled", false);
        $('#perfil_pass').prop("disabled", false);
    });
    
    $('#enviar').on('click', function (){
        if (($('#perfil_nombre')[0].value === undefined) || 
                ($('#perfil_apellido')[0].value === undefined) || 
                ($('#perfil_direccion')[0].value === undefined) || 
                ($('#perfil_cp')[0].value === undefined) || 
                ($('#perfil_ciudad')[0].value === undefined) || 
                /*($('#perfil_new_pass')[0].value === undefined) || */
                ($('#perfil_pass')[0].value === undefined) || 
                ($('#perfil_email')[0].value === undefined)){
            alert("Todos los campos son obligatorios");
            return false;
        }
        
        if($('#new_pass').is(':visible') && !$("#pass_not_matched").hidden ){
            //alert("La contraseña nueva no coincide");
            return false;
        }
        
        
        if (!/\d{5}/.test($('#perfil_cp')[0].value)){
            //alert("Codigo postal invalido");
            document.getElementById("error_cp").hidden = false;
            return false;
        }
        document.getElementById("error_cp").hidden = true;
        
        if($cambiar){
            if (!/^(?=.*\W)(?=.*\d)(?=.*[A-Z]).{6,}$/.test($('#perfil_new_pass')[0].value)){
                //alert("La contraseña debe tener al menos 6 caracteres, incluyendo un signo de puntuación, un numero y mayusculas");
                document.getElementById("error_new_pass").hidden = false;
                return false;
            }
            document.getElementById("error_new_pass").hidden = true;
        }
        
        
        var email = $('#perfil_email')[0].value;
    
        var p = email.indexOf("@");
        if ((p === -1) || (p === 0)){
            //alert("Email invalido");
            document.getElementById("error_email").hidden = false;
            return false;
        }

        var slice = email.slice(p);

        //_log("slice: "+ slice);

        if (slice.indexOf('.') === -1){
            //alert("Email invalido");
            document.getElementById("error_email").hidden = false;
            return false;

        }
        document.getElementById("error_email").hidden = true;
    });
});
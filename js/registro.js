
"use strict";
var debug = true;

function _log(txt){
    if (debug)
        console.log(txt);
}

$('document').ready(function (){
    $('#contr2').on('keyup', function (){
        _log($('#contr') + " - " + $('#contr2'));
        if ($('#contr')[0].value !== $('#contr2')[0].value){
            document.getElementById("pass_not_matched").hidden = false;
        }else{
            document.getElementById("pass_not_matched").hidden = true;
        }
    });
    
    $('#enviar').on('click', function (){
        if (($('#nombre')[0].value === undefined) || 
                ($('#apellido')[0].value === undefined) || 
                ($('#direccion')[0].value === undefined) || 
                ($('#cpostal')[0].value === undefined) || 
                ($('#ciudad')[0].value === undefined) || 
                ($('#pass')[0].value === undefined) || 
                ($('#email_registro')[0].value === undefined)){
            alert("Todos los campos son obligatorios");
            return false;
        }
        
        
        if (!/\d{5}/.test($('#cpostal')[0].value)){
            //alert("Codigo postal invalido");
            document.getElementById("error_cp").hidden = false;
            return false;
        }
        document.getElementById("error_cp").hidden = true;
        
        if (!/^(?=.*\W)(?=.*\d)(?=.*[A-Z]).{6,}$/.test($('#contr')[0].value)){
            document.getElementById("error_new_pass").hidden = false;
            return false;
        }
        document.getElementById("error_new_pass").hidden = true;
        
        var email = $('#email_registro')[0].value;
    
        var p = email.indexOf("@");
        if ((p === -1) || (p === 0)){
            document.getElementById("error_email").hidden = false;
            return false;
        }

        var slice = email.slice(p);

        _log("slice: "+ slice);

        if (slice.indexOf('.') === -1){
            document.getElementById("error_email").hidden = false;
            return false;

        }
        document.getElementById("error_email").hidden = true;
    });
});
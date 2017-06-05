/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
"use strict";
var debug = true;

function _log(txt){
    if (debug)
        console.log(txt);
}


function alguno_vacio(form){
    for(var k=0; k<form.elements.length; k++){
        _log("k:" + k + " - id:" + form.elements[k].id +" - value:" + form.elements[k].value);
        
        if ((form.elements[k].id !== "comentarios") && (form.elements[k].value === "")){
            alert("El campo " + form.elements[k].title +" es obligatorio");
            return true;
        }
    }
    
    
    return false;
}

function fecha_incorrecta(){
    var fecha = document.getElementById("fnac");
    
    if (!/[0-3][0-9][/][0-1][0-9][/][1|2][9|0][0-9][0-9]/.test(fecha.value)){
        alert("Formato de la fecha de nacimiento incorrecto, debe ser DD/MM/AAAA");
        return true;
    }
    
    return false;
}

function DNIincorrecto(){
    var dni = document.getElementById("dni").value;
    if (!/[0-9]{8}[A-Z]/i.test(dni)){
        alert("DNI incorrecto!!");
        return true;
        
    }
    
    
    return false;
}

function cpostal_incorrecto(){
    var cpostal = document.getElementById("cpostal");
    
    if (!/\d{5}/.test(cpostal.value)){
        alert("Codigo postal invalido");
        return true;
    }
    
    return false;
}


function password_incorrecta(){
    var pass = document.getElementById("pass");
    
    if (!/^(?=.*\W)(?=.*\d)(?=.*[A-Z]).{6,}$/.test(pass.value)){
        alert("La contraseña debe tener al menos 6 caracteres, incluyendo un signo de puntuación, un numero y mayusculas");
        return true;
    }
    
    return false;
}


function email_incorrect(){
    var email = document.getElementById("email").value;
    
    var p = email.indexOf("@");
    if ((p === -1) || (p === 0)){
        alert("Email invalido");
        return true;
    }
    
    var slice = email.slice(p);
    
    _log("slice: "+ slice);
    
    if (slice.indexOf('.') === -1){
        alert("Email invalido");
        return true;
        
    }
    
    return false;
}


function validar(){
    var form = document.forms[0];
    
    _log("Validando...");
    
    if (alguno_vacio(form)) return false;
    
    
    if (fecha_incorrecta()) return false;
    
    if (DNIincorrecto()) return false;
    
    if (cpostal_incorrecto()) return false;
    
    if (password_incorrecta()) return false;
    
    if (email_incorrect()) return false;
    
    _log("Todo correcto");
    return true;
}


function password_not_match(){
    var pass = document.getElementById("pass");
    var pass2 = document.getElementById("pass2");
    
    if (pass.value !== pass2.value){
        document.getElementById("pass_not_matched").hidden = false;
    }else{
        document.getElementById("pass_not_matched").hidden = true;
    }
    
}
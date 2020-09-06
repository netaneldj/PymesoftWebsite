// Creo variables Globales
var ajaxPantTrabajo=objetoAjax();
var objPantTrabajo;

function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function EjecutarAlInicio() {
	objPantTrabajo=document.getElementById('PantTrabajo');
}

function sistemas() {
    var rs=ajaxPantTrabajo.readyState;
    if (rs==0 || rs==4){
        var consulta='sistemas.php?dat1=1';
        ajaxPantTrabajo.open("POST",consulta);
        ajaxPantTrabajo.onreadystatechange=RetAjaxSistemas;
        ajaxPantTrabajo.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajaxPantTrabajo.send(consulta);
    }
}

function RetAjaxSistemas() {
    if (ajaxPantTrabajo.readyState==4) {
        txt=ajaxPantTrabajo.responseText;
        objPantTrabajo.innerHTML=txt;
    }
}

function web() {
    var rs=ajaxPantTrabajo.readyState;
    if (rs==0 || rs==4){
        var consulta='web.php';
        ajaxPantTrabajo.open("POST",consulta);
        ajaxPantTrabajo.onreadystatechange=RetAjaxWeb;
        ajaxPantTrabajo.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajaxPantTrabajo.send(consulta);
    }
}

function RetAjaxWeb() {
    if (ajaxPantTrabajo.readyState==4) {
        txt=ajaxPantTrabajo.responseText;
        objPantTrabajo.innerHTML=txt;
    }
}

function contacto() {
    var rs=ajaxPantTrabajo.readyState;
    if (rs==0 || rs==4){
        var consulta='contacto.html';
        ajaxPantTrabajo.open("POST",consulta);
        ajaxPantTrabajo.onreadystatechange=RetAjaxContacto;
        ajaxPantTrabajo.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajaxPantTrabajo.send(consulta);
    }
}

function RetAjaxContacto() {
    if (ajaxPantTrabajo.readyState==4) {
        txt=ajaxPantTrabajo.responseText;
        objPantTrabajo.innerHTML=txt;
    }
}

function EnviarMailContacto() {
    var rs=ajaxPantTrabajo.readyState;
    if (rs==0 || rs==4){
		var objNombre=document.getElementById('nombre');
		var objEmpresa=document.getElementById('empresa');
		var objEmail=document.getElementById('email');
		var objTelefono=document.getElementById('telefono');
		var objMensaje=document.getElementById('mensaje');
    	var nombre = objNombre.value;
    	var empresa = objEmpresa.value;
    	var email = objEmail.value;
    	var telefono = objTelefono.value;
    	var mensaje = objMensaje.value;
        var request='EnviarMailcontacto.html?nombre='+nombre+'&empresa='+empresa+'&email='+email+'&telefono='+telefono+'&mensaje='+mensaje;
        ajaxPantTrabajo.open("POST",request);
        ajaxPantTrabajo.onreadystatechange=RetAjaxEnviarMailContacto;
        ajaxPantTrabajo.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajaxPantTrabajo.send(request);
    }
}

function RetAjaxEnviarMailContacto() {
    if (ajaxPantTrabajo.readyState==4) {
        txt=ajaxPantTrabajo.responseText;
        objPantTrabajo.innerHTML=txt;
    }
}

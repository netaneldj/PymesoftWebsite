<?php
$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$to = "ventas@pymesoft.com.ar";
$subject = "Consulta web de '$nombre.' desde Pymesoft";
$headers =  'MIME-Version: 1.0' . "\r\n";
$headers .= "From: $email\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$body='<?xml version="1.0" encoding="UTF-8"?>';
$body.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>';
$body.='<h2>Consulta de '.$nombre.' desde la web de Pymesoft</h2>';
$body.='<div class="textonormal">';
$body.='<table width="500" height="10" class="normal" align="left">';
$body.='<tr><td width="100"><strong>Nombre:</strong></td><td width="400">'.$nombre.'</td></tr>';
$body.='<tr><td width="100"><strong>Empresa:</strong></td><td width="400">'.$empresa.'</td></tr>';
$body.='<tr><td><strong>Email:</strong></td><td>'.$email.'</td></tr>';
$body.='<tr><td><strong>Telefono:</strong></td><td>'.$telefono.'</td></tr>';
$body.='<tr style="vertical-align:top"><td><strong>Mensaje:</strong></td><td>'.$mensaje.'</td></tr>';
//$cuerpo.='<tr style="vertical-align:top"><td><strong>Consulta:</strong></td><td>'.htmlentities(utf8_decode($consulta)).'</td></tr>';
$body.='</table></div>';
$body.='</body></html>';
$mail_status = mail($to, $subject, $body, $headers);
if($mail_status == true){
	echo "<script>
	alert('Muchas gracias! Hemos recibido tu consulta. A la brevedad nos pondremos en contacto con vos.');
	window.location.href='index.html';
	</script>";	
}else{
	echo "<script>
	alert('Error al enviar el email! Por favor intenta de nuevo.');
	window.location.href='contacto.html';
	</script>";		
}
?>

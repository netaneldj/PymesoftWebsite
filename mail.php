<?php
$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$to = "ventas@pymesoft.com.ar";
$subject = "Consulta web de '.$nombre.' desde Pymesoft";
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
mail($to, $subject, $body, $headers) or die("Error!");
echo '<style>';
include("css/styles.css");
include("css/font-awesome.min.css");
echo '</style>';

echo '
<form method="post">
	<div class="row">
	  <div class="col-6 col-12-xsmall">
		<h2 class="titulo"><b>Muchas gracias '.$nombre.'</b></h2><br />
		<p class="informacion">Hemos recibido tu consulta. A la brevedad nos pondremos en contacto con vos.</p>
	  </div>
	</div>
</form>';
?>

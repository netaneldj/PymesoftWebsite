<?php
$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$contenido=" De: $nombre \n Empresa: $empresa \n Email: $email \n Telefono: $telefono \n Mensaje: $mensaje";
$destinatario = "ventas@pymesoft.com.ar";
$asunto = "Consulta Pymesoft";
$encabezado = "De: $email \r\n";
mail($destinatario, $asunto, $contenido, $encabezado) or die("Error!");
echo "Gracias por su consulta!" . " -" . "<a href='contacto.html' style='text-decoration:none;color:#ff0099;'> Regresar al inicio</a>";
?>

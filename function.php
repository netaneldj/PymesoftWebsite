<?php

function mailsend($dest_mail, $subject, $message, $type, $cc, $bcc, $from, $host, $port, $user_name, $user_pass) {
	global $mail_from,$mail_host,$mail_port,$mail_user,$mail_pass,$mail_dest;
/*
	** Cambiar **
		mail($user_email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());

	** Por **
		$from = "From: $from\nX-Mailer: PHP/" . phpversion();
		$host = "my.smtp.server";
		$port = 25;

		// check that the rest of the variables, like
		// $username, $user_email, $subject, $message, $username, $user_password
		// are also correctly set, then call mymail():

		mymail($dest_email, $subject, $message, $from, $host, $port, $username, $user_password);

*/

	$crlf=chr(13).chr(10);
  // This is the Mail.php file from PEAR.
//	include_once("Mail.php");

	if ($host=='') {
		$headers='';
		//para el envío en formato HTML
		if ($type=='html') {
			$headers = 'MIME-Version: 1.0'.$crlf;
			$headers .= 'Content-type: text/html; charset=iso-8859-1'.$crlf;
		}

		//dirección del remitente
		$headers .= 'From: '.$mail_from.$crlf;

		//direcciones que recibián copia
		if ($cc!=null) {
			$headers .= 'Cc: '.$cc.$crlf;
		}

		//direcciones que recibirán copia oculta
		if ($bcc!=null) {
			$headers .= 'Bcc: '.$bcc.$crlf;
		}
		// Envío el mail por PHP (sin autenticación)
		mail($dest_mail,$subject,$message,$headers);
	}
	else {
		$headers["From"]    = $from;
		$headers["To"]      = $dest_mail;
		$headers["Subject"] = $subject;
		if ($type=='html') {
			$headers["MIME-Version"]='1.0';
			$headers["Content-type"]='text/html; charset=UTF-8';
//			$headers["Content-type"]='text/html; charset=iso-8859-1';
        }
		$params["host"] = $host;
		$params["port"] = $port;
		if ($user_name=='') {
			$params["auth"] = false;
			$params["username"] = '';
			$params["password"] = '';
		}
		else {
			$params["auth"] = true;
			$params["username"] = $user_name;
			$params["password"] = $user_pass;
		}

		// Create the mail object using the Mail::factory method
		$mail_object =& Mail::factory("smtp", $params);
		$mail_object->send($dest_mail, $headers, $message);
	}

}

function enviarmail($destinatario,$asunto,$cuerpo,$copia,$copiaoculta,$remitente) {

	$crlf=chr(13).chr(10);
	//para el envío en formato HTML
	$headers = 'MIME-Version: 1.0'.$crlf;
	$headers .= 'Content-type: text/html; charset=utf-8'.$crlf;
//	$headers .= 'Content-type: text/html; charset=iso-8859-1'.$crlf;

	//dirección del remitente
	$headers .= 'From: '.$remitente.$crlf;

	//direcciones que recibián copia
	if ($copia!=null) {
		$headers .= 'Cc: '.$copia.$crlf;
	}

	//direcciones que recibirán copia oculta
	if ($copiaoculta!=null) {
		$headers .= 'Bcc: '.$copiaoculta.$crlf;
	}

// Envío el mail por PHP (sin autenticación)

	mail($destinatario,$asunto,$cuerpo,$headers);

// Envío el mail por PEAR Mail (con autenticacion)

/*
	$from='grjamilis@yahoo.com.ar';
	$host='smtp.mail.yahoo.com.ar';
	$port=25;
	$user='grjamilis';
	$pass='netil1689';
	mymail($destinatario, $asunto, $cuerpo, $from, $host, $port, $user, $pass, &$headers);
*/
}

function mymail($dest_email, $subject, $message, $from, $host, $port, $username, $user_password) {

/*
	** Cambiar **
		mail($user_email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());

	** Por **
		$from = "From: $from\nX-Mailer: PHP/" . phpversion();
		$host = "my.smtp.server";
		$port = 25;

		// check that the rest of the variables, like
		// $username, $user_email, $subject, $message, $username, $user_password
		// are also correctly set, then call mymail():

		mymail($dest_email, $subject, $message, $from, $host, $port, $username, $user_password);

*/

  // This is the Mail.php file from PEAR.
	include("Mail.php");

	$recipients = $dest_email;

	$headers["From"]    = $from;
	$headers["To"]      = $dest_email;
	$headers["Subject"] = $subject;
	$headers["MIME-Version"]='1.0';
	$headers["Content-type"]='text/html; charset=iso-8859-1';

	$body = $message;

	$params["host"] = $host;
	$params["port"] = $port;
	$params["auth"] = true;
	$params["username"] = $username;
	$params["password"] = $user_password;

	// Create the mail object using the Mail::factory method
	$mail_object =& Mail::factory("smtp", $params);

	$mail_object->send($recipients, $headers, $body);

}

function mail_html($mailto, $copyto, $bccto, $from_mail, $from_name, $replyto, $subject, $message) {
    $crlf=chr(13).chr(10);
    $header = 'From: "'.$from_name.'" <'.$from_mail.'>'.$crlf;
    if ($copyto!='') {
        $header .= 'Cc: '.$copyto.$crlf;
    }
    if ($bccto!='') {
        $header .= 'Bcc: '.$bccto.$crlf;
    }
    $header .= 'Reply-To: '.$replyto.$crlf;
    $header .= 'MIME-Version: 1.0'.$crlf;
    $header .= 'Content-type: text/html; charset=iso-8859-1'.$crlf;
    if (mail($mailto, $subject, $message, $header)) {
        echo 'El email fue enviado exitosamente'.$crlf; // or use booleans here
    } else {
        echo 'El email no pudo ser enviado'.$crlf;
    }
}

function mail_attachment($filename, $path, $mailto, $copyto, $bccto, $from_mail, $from_name, $replyto, $subject, $message) {
    global $system_root;
	$crlf=chr(13).chr(10);
    $filepath = $_SERVER['DOCUMENT_ROOT'].$system_root.$path;
    $file = $filepath.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = 'From: "'.$from_name.'" <'.$from_mail.'>'.$crlf;
    if ($copyto!='') {
        $header .= 'Cc: '.$copyto.$crlf;
    }
    if ($bccto!='') {
        $header .= 'Bcc: '.$bccto.$crlf;
    }
    $header .= 'Reply-To: '.$replyto.$crlf;
    $header .= 'MIME-Version: 1.0'.$crlf;
    $header .= 'Content-Type: multipart/mixed; boundary="'.$uid.'"'.$crlf.$crlf;
    $header .= 'Status:'.$crlf.$crlf;
    $header .= 'This is a multi-part message in MIME format.'.$crlf.$crlf;
    $header .= '--'.$uid.$crlf;
    $header .= 'Content-type:text/plain; charset="iso-8859-1"'.$crlf;
    $header .= 'Content-Transfer-Encoding: 7bit'.$crlf.$crlf;
    $header .= $message.$crlf.$crlf;
    $header .= '--'.$uid.$crlf;
    $header .= 'Content-Type: application/vnd.ms-excel; name="'.$filename.'"'.$crlf; // use different content types here
    $header .= 'Content-Transfer-Encoding: base64'.$crlf;
    $header .= 'Content-Disposition: attachment; filename="'.$filename.'"'.$crlf.$crlf;
    $header .= $content.$crlf.$crlf;
    $header .= '--'.$uid.'--';
    if (mail($mailto, $subject, '', $header)) {
        echo 'El email fue enviado exitosamente'; // or use booleans here
    } else {
        echo 'El email no pudo ser enviado';
    }
}

?>

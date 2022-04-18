<?php
$name = $_POST['nombre'];
$phone = $_POST['telefono'];
$mail = $_POST['correo'];
$city = $_POST['ciudad'];

$header = 'From: ' . $mail . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$message = "Este mensaje fue enviado por " . $nombre . " \r\n";
$message .= "Su e-mail es: " . $correo . " \r\n";
$message .= "Su telefono es: " . $telefono . " \r\n";
$message .= "Su ciudad es: " . $ciudad . " \r\n";   
$message .= "Enviado el " . date('d/m/Y', time());

$para = 'info@teduemprende.com';
$asunto = 'Inscripción desde el sitio web';

mail ($para, $asunto, utf8_decode($message), $header);

header("Location:gracias.html");
?>
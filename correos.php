<?php
$destinatario = 'info@teduemprende.com';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$ciudad = $_POST['ciudad'];


$header = "Enviado desde teduemprende.com";
$mensajeCompleto = $mensaje . "\nAtentamente: " . $nombre;

mail($destinatario, $nombre, $mensajeCompleto, $header);
echo "<script>setTimeou(\"location.href='index.html'\", 1000)</script>"
?>

<?php
header("Content-Type: text/html; charset=UTF-8", true);
error_reporting(1);

function correo($correos,$nombre,$carta){
    require_once("phpmailer/class.phpmailer.php");
   
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    $mail->PluginDir = "phpmailer/";
    //$mail->IsSMTP();
    $mail->SMTPDebug = 2;

    $mail->Host = 'mail.teduemprende.com';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'avisos@teduemprende.com';
    $mail->Password = 'EmprendeconTedu2022';
    $mail->setFrom('avisos@teduemprende.com', 'Equipo TEDU');
    
    //$mail->addReplyTo('info@teduemprende.com', 'Equipo TEDU');
    $mail->addAddress($correos, $nombre);
    $mail->addAddress('teduemprende@gmail.com', 'Equipo TEDU');
    
    $mail->Subject ="Lanzamiento de TEDU, la fabrica de negocios **MUY PRONTO**";
    
    $contenido = "Estimad@ ".$nombre."\n\nAgradecemos que hayas sido participe en nuestro proximo lanzamiento a nuestra gran apertura que te cambiara la vida.\n\nTus datos de contactos son:\n".$carta."\n\nTendremos grandes sorpresas.\n\nEquipo TEDU\n\n\nPor favor no responder este correo";
    
    //$mail->msgHTML(file_get_contents('contenido.html'), __DIR__);
    $mail->Body = $contenido;
    //$mail->IsHTML(true);
    //$mail->addAttachment('test.txt');
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'The email message was sent.';
    }
}


	//LLAMANDO A LOS CAMPOS
    $nombre=$_POST['nombre'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $ciudad=$_POST['ciudad'];

    //DATOS PARA EL CORREO
    $destinatario = "info@teduemprende.com";
    $asunto = "Contacto desde la web";

    $carta = "\n"."Participante:".$nombre."\n";
    $carta .= "Correo:".$correo."\n";
    $carta .= "Telefono:".$telefono."\n";
    $carta .= "Ciudad:".$ciudad."\n\n";

    //ENVIANDO MENSAJE
    //mail($destinatario, $asunto, $carta);
	correo($correo,$nombre,$carta);
	header('Location:index.html')
?>

<?php

include()

error_reporting(1);

function correo($correos,$nombre){
 require_once("phpmailer/class.phpmailer.php");

  $mail = new phpmailer();

  $mail->PluginDir = "phpmailer/";
  $mail->CharSet = 'UTF-8';
  //$mail->isSMTP();

  //Con la propiedad Mailer le indicamos que vamos a usar un
  //servidor smtp
  $mail->Mailer = "smtp";
  $mail->SMTPDebug  = 0;
  $mail->Debugoutput = 'html';

  //Asignamos a Host el nombre de nuestro servidor smtp
  $mail->Host ="smtp.gmail.com";
  $mail->Port = 587;
  //Le indicamos que el servidor smtp requiere autenticación
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPOptions = array(
            'ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true)
        );
  //Le decimos cual es nuestro nombre de usuario y password
  $mail->Username ="";//debes de poner un correo de gmail que tenga configurado para aplicaciones no seguras en la parte de gmail
  $mail->Password =""; // debes de poner la clave del correo

  //Indicamos cual es nuestra dirección de correo y el nombre que
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = "aviso@hospitalsanfrancisco.com.ec";
  $mail->FromName = "Reserva de asistencia TEDU EMPRENDE";

  //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar
  //una cuenta gratuita, por tanto lo pongo a 30
  $mail->Timeout=30;

  //Indicamos cual es la dirección de destino del correo
  $mail->AddAddress($correos,$nombre);


  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo
  //que se vea en negrita

  $mail->Subject = "Reserva de lanzamiento TEDU";
  $fecha_actual = date("d-m-Y");
  $shtml="Estimado ".$nombre."<br><br>TEDU agradece su registro de asistencia, estaremos gustosos en recibirte en nuestro lanzamiento.<br><br>Tendremos grandes sorpresas.";
  $mail->msgHTML($shtml);

  $mail->IsHTML(true);

  $exito = $mail->Send();

  //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho
  //para intentar enviar el mensaje, cada intento se hara 5 segundos despues
  //del anterior, para ello se usa la funcion sleep
  $intentos=1;
  while ((!$exito) && ($intentos < 5)) {
	sleep(5);
     	//echo $mail->ErrorInfo;
     	$exito = $mail->Send();
     	$intentos=$intentos+1;
   }


   if(!$exito)
   {
		echo "Problemas enviando el correo electronico a ".$correos;
		echo "<br/>".$mail->ErrorInfo;
   }
   else
   {
	    echo "Enviado con exito";
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

    $carta = "De: $nombre \n";
    $carta .= "Correo: $correo \n";
    $carta .= "Teléfono: $telefono \n";
    $carta .= "Ciudad: $ciudad";

    //ENVIANDO MENSAJE
    //mail($destinatario, $asunto, $carta);
	correo($correo,$nombre);
	header('Location:index.html')
?>
<?php
require ('class.phpmailer.php');
include("class.smtp.php");

class Email  extends PHPMailer{

    /*datos de remitente
    var $tu_email = "notificaciones@itpmsoftware.com";
    var $tu_nombre = "iTPM Software Notifica";
    var $tu_password = "Z+8g5DZe3EiMYr";*/

    /**
 * Constructor de clase
 */
    public function __construct()
    {
    // datos de remitente
     $tu_email = "notificaciones@itpmsoftware.com";
     $tu_nombre = "FIONA Notifica";
     $tu_password = "Z+8g5DZe3EiMYr";
      //configuracion general
     $this->IsSMTP(); // protocolo de transferencia de correo
     $this->Host = 'smtp.mi.com.co';  // Servidor GMAIL
     $this->Port = 465; //puerto
     $this->SMTPAuth = true; // Habilitar la autenticación SMTP
     $this->Username = $this->tu_email=$tu_email;
     $this->Password = $this->tu_password=$tu_password;
     $this->SMTPSecure = 'ssl';  //habilita la encriptacion SSL
     //remitente
     $this->From = $this->tu_email;
     $this->FromName = $this->tu_nombre=$tu_nombre;
	   $this->CharSet='UTF-8';
    }

    /**
 * Metodo encargado del envio del e-mail
 */
    public function enviar($asunto , $contenido)
    {
      //$this->AddAddress($para,$nombre );  // Correo y nombre a quien se envia
	   //$this->addCC("harold-c-m@hotmail.com",'Harold Campo Morales');
	   //$this->addBCC("harold-c-m@hotmail.com",'Harold Campo Morales'); 
       $this->WordWrap = 50; // Ajuste de texto
       $this->IsHTML(true); //establece formato HTML para el contenido
       $this->Subject = $asunto;
       $this->Body    =  $contenido; //contenido con etiquetas HTML
       $this->AltBody =  strip_tags($contenido); //Contenido para servidores que no aceptan HTML
	   //$this->addAttachment("archivoadjunto.pdf",'Prueba 1.pdf');
	   //$this->addAttachment("archivoadjunto.pdf",'Prueba 2.pdf');
       //envio de e-mail y retorno de resultado
       return $this->Send() ;
   }
   public function agregar($correo,$nombre = ''){
	   $this->addAddress($correo,$nombre);
	}

}//--> fin clase
	
   $contenido_html =  "<div>
   <img data-imagetype='External' 
   src='http://fiona.byethost11.com/assets/images/logo-icon.png/>
   <p>
      Señor(a).<br>
      $contenido_mess<strong>$consetiket</strong>.<br>
      Por Favor no responda a este mensaje.
   </p>
</div>";
?>

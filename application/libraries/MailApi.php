<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/vendor_mail/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class MailApi {
	
	public function __construct()
    {
    }
    public function send_mail($para,$nueva_contrasena){
    		$mail = new PHPMailer(true);
			try {
			    //Server settings
			    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			    $mail->isSMTP();                                            //Send using SMTP
			    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			    $mail->Username   = 'eugeniapesca322@gmail.com';                     //SMTP username
			    $mail->Password   = '23725856';                               //SMTP password
			    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			    $mail->Port       = 587;       
			    $mail->SMTPSecure = 'tls';                             //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			    //Recipients
			    $mail->setFrom('eugeniapesca322@gmail.com', 'Mailer');
			    $mail->addAddress($para, 'Cliente');     //Add a recipient
			    //Content
			    $mail->isHTML(true);                                  //Set email format to HTML
			    $mail->Subject = 'Clave temporal Movieflix';
			    $mail->Body    = 'Su contraseña temporal es <b>'.$nueva_contrasena.'</b>';
			    $mail->AltBody = 'Su contraseña temporal es '.$nueva_contrasena;

			    $mail->send();
			    echo 'Message has been sent';
			} catch (Exception $e) {
			    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
    }
}
 

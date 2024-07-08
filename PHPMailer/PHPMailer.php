<?php

session_start(); // Ensure the session is started before using session variables
error_reporting(0);
$user_name = $_SESSION["user_name"];
$user_mail = $_SESSION["user_mail"];

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'mail.monitorcenter.com.mx';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'reportes@monitorcenter.com.mx';                     //SMTP username
  $mail->Password   = '{[tf_[mTXGa5';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
  $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom('reportes@monitorcenter.com.mx', 'LANRED');
  $mail->addAddress($user_mail, $user_name);               //Name is optional
  $mail->addReplyTo('reportes@monitercenter.com.mx', 'LANRED');

  //Attachments
  $mail->addAttachment('../PHPPdf/PDF/' . $user_name . '.pdf', 'monitorcenter.pdf');         //Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Bienvenido a ' . $user_name;
  $body = '<h1>Soy Monitercenter</h1>
  <p style="font-size: 1.5rem">Aquí está el <b>informe</b>.</p>';
  $mail->msgHTML($body);

  // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  echo 'Message has been sent';
  $filePath = '../PHPPdf/PDF/' . $user_name . '.pdf';

  if (file_exists($filePath)) {
    if (unlink($filePath)) {
      echo "File deleted successfully.";
    } else {
      echo "Unable to delete the file.";
    }
  } else {
    echo "File does not exist.";
  }
  echo '<script>window.close();</script>';
  exit;
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  exit;
}

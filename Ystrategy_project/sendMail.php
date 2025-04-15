<?php
  

  require_once 'src/PHPMailer.php';
  require_once 'src/SMTP.php';
  require_once 'src/Exception.php';

  

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  $mail = new PHPMailer(true);
    try{
    
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        // $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        // $mail->Username = 'ystrategy@ystrategy.com.br';
        $mail->Username = 'ruama246@gmail.com';
        $mail->Password = 'Ystrategy@123';
        // $mail->Port = 465;
        $mail->Port = 587;

        $mail->setFrom('ystrategy@ystrategy.com.br');
        $mail->addReplyTo('ystrategy@ystrategy.com.br');
        $mail->addAddress('ruama246@gmail.com');
        
        $mail->isHTML(true);
        $mail->Subject = 'Testing PHPMailer';
        $mail->Body = 'This is a plain text message body';
        $mail->AltBody = 'This is a plain text message body';
        //$mail->addAttachment('test.txt');

        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'The email message was sent.';
        }
        
    }catch( Exception $e){

        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }



?>
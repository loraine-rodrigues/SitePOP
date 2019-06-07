<?php
function sendMail($de,$para,$mensagem,$assunto)
{
$fromserver = 'popmotos1111@gmail.com';
    require_once('phpmailer/class.phpmailer.php');
    $mail = new PHPMailer(true);

    $mail->IsSMTP();
    try {
      $mail->CharSet = 'utf-8';
      $mail->SMTPAuth   = true;
      $mail->SMTPDebug  = 2;
     $mail->Host = 'smtp.gmail.com'; // Enter your host here
      $mail->SMTPSecure = 'tls';
	  $mail->Port       = 587;
     $mail->Username = 'popmotos1111@gmail.com'; // Enter your email here
      $mail->Password   = 'motofrete';
      $mail->AddAddress($para, 'email');
	  $mail->AddReplyTo($de, 'POP!');
      $mail->SetFrom($de, 'POP!');
      $mail->Subject = $assunto;
      $mail->MsgHTML($mensagem);
      $mail->Send();
      $envio = true;
    } catch (phpmailerException $e) {
      echo "erro: " . $mail->ErrorInfo;
      $envio = false;
    } catch (Exception $e) {
      echo "erro: " . $mail->ErrorInfo;
      $envio = false;
    }
    return $envio;
}
$email_to = $email;
			
			
			


?>

<?php
function sendMail($de,$para,$mensagem,$assunto)
{
    require_once('phpmailer/class.phpmailer.php');
    $mail = new PHPMailer(true);

    $mail->IsSMTP();
    try {
      $mail->SMTPAuth   = true;
      $mail->SMTPDebug  = 2;
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPSecure = 'tls';
	  $mail->Port       = 587;
      $mail->Username   = 'popmotos1111@gmail.com';
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
?>

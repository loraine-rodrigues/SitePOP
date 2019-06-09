<?php
$title = "ESQUECI A SENHA";
include '../header.php';

?>
<style type="text/css">
	@media only screen and (max-width: 767px) {
		body {
			/* The file size of this background image is 93% smaller
       to improve page load speed on mobile internet connections */
			background-image: url(image/bg-duvida.png) !important;
		}
	}

	body {
		width: 100%;
		background-image: url(image/bg-duvida.png) !important;
		background-repeat: no-repeat;
		background-position: center center;
		background-attachment: fixed;
		background-size: cover;



	}
</style>
<div class="container text-center flex-fill">


     
<h2 class="h1-responsive">Esqueci a Senha</h2>

	<?php

	include('db.php');
	if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
		$email = $_POST["email"];
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		if (!$email) {
			$error .= "<p>Endereço de email inválido. Por favor, digite um email válido.</p>";
		} else {
			$sel_query = "SELECT * FROM `tb_login` WHERE nm_usuario='" . $email . "'";
			$results = mysqli_query($con, $sel_query);
			$row = mysqli_num_rows($results);
			if ($row == "") {
				$error .= "<p>Nenhum usuário está registrado com esse endereço de email!</p>";
			}
		}
		if ($error != "") {
			echo "<div class='error'>" . $error . "</div>
	<br /><a href='javascript:history.go(-1)'>Voltar</a>";
		} else {
			$expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
			$expDate = date("Y-m-d H:i:s", $expFormat);
			$key = md5($email);
			$addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
			$key = $key . $addKey;
			// Insert Temp Table
			mysqli_query(
				$con,
				"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');"
			);

			$output = '<p>Caro usuário,</p>';
			$output .= '<p>Por favor, clique no link abaixo para atualizar sua senha.</p>';
			$output .= '<p>-------------------------------------------------------------</p>';
			$output .= '<p><a href="http://sitepop/demo/reset-password.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">http://sitepop/demo/reset-password.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
			$output .= '<p>-------------------------------------------------------------</p>';
			$output .= '<p>Certifique-se de copiar o link completo no seu navegador.
O link irá expirar após 1 dia por motivos de segurança.</p>';
			$output .= '<p>Se você não solicitou esse email, nenhuma ação é necessária, sua senha não será resetada. 
 Entretanto, talvez você deva verificar a atividade na sua conta ou mudar sua senha caso alguém esteja tentando acessá-la .</p>';
			$output .= '<p>Obrigada, </p>';
			$output .= '<p>Equipe POP! Motofrete</p>';
			$body = $output;
			$subject = "Recuperar Senha";

			$email_to = $email;
			$fromserver = 'popmotos1111@gmail.com';
			require("PHPMailer/PHPMailerAutoload.php");
			$mail = new PHPMailer();
			$mail->CharSet = 'UTF-8';
			$mail->IsSMTP();
			$mail->Host = 'smtp.gmail.com'; // Enter your host here
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = 'popmotos1111@gmail.com'; // Enter your email here
			$mail->Password = "motofrete"; //Enter your passwrod here
			$mail->Port = 587;
			$mail->IsHTML(true);
			$mail->From = "popmotos1111@gmail.com";
			$mail->FromName = "POP!";
			$mail->Sender = $fromserver; // indicates ReturnPath header
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->AddAddress($email_to);
			if (!$mail->Send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				echo "<div class='error'>
<p>Um email foi enviado para seu e-mail cadastrado com instruções para recuperação de senha.</p>
</div><br /><br /><br />";
			}
		}
	} else {
		?>
		<div class="card m-auto text-center" style="width: 24rem;">
    <div class="card-body">
	<div class="container text-center">
		<form method="post" action="" name="reset"><br /><br />
		<div class="form-group ">
			<label ><strong>Digite seu e-mail:</strong></label><br /><br />
			<input type="email" name="email"class="form-control" placeholder="usuario@email.com" />
			<br /><br />
			<input class="btn btn-info btn-entrar" type="submit" value="Recuperar senha" />
		</form>
	</div>
	</div>
    </div>
		</div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	<?php } ?>


	<br /><br />

</div>
</body>

</html>
<?php
include '../footer.php';
?>
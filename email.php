<?php

if (isset($_POST['email']) && !empty($_POST['email'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$mensagem = $_POST['mensagem'];


	$to = "EMAIL DO GRUPO";
	$subjet = "Contato - POP!";
	$body = "Nome: ".$nome. "\r\n".
			"Email: ".$email."\r\n".
			"Mensagem: ".$mensagem;

	$header = "From: EMAIL DO DOMINIO QUE O SCRIPT VAI RODAR O SITE"."\r\n".
				"Reply-To:".$email."\e\n".
				"X=Mailer:PHP/".phpversion();

	if(mail($to,$subject,$body,$header)){

		echo ("Email enviado com sucesso!");
	}
	else {

		echo ("O Email não pode ser enviado");
	}

}
?>
<?php
$title = "CONTATO";

include 'header.php' ?>

<style type="text/css">
	body{font-family: Arial, Helvetica, sans-serif;}
	.content{ background-color:#F69A11; margin-top: 100px; display: flex;justify-content: center; border-radius: 10px;}

	.contato{margin-top: 30px; width: 100%; max-width: 600px; border-radius: 10px;}

	.form{display: flex;flex-direction: column;}

	.field{padding: 10px; margin-top: 20px; margin-bottom: 25px; border: 2px solid #00000; border-radius: 10px;font-family: Arial, Helvetica, sans-serif;font-size: 16px; border-radius: 10px;}
	input{margin-bottom: 40px; border-radius: 10px;}

	textarea{height: 150px;}
	.form-contato{padding: 10px;margin-top: 5px; margin-right: 30%; margin-left: 30%; border-radius: 10px;}


</style>

<div class="form-contato">
	<section class="content">
		<div class="contato">
			<h3>Formulário de contato</h3>
			<form class="form" method="POST" action="email.php">
				<input type="" name="nome" placeholder="Nome">
				<input type="field" name="email" placeholder="E-mail">
				<textarea class="field" name="mensagem" placeholder="Digite sua mensagem aqui."></textarea>
				<input class="field" type="submit" value="Enviar" name="enviar">

			</form>


		</div>


	</section>

</div>

<?php include 'footer.php' ?>

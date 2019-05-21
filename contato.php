<?php
$title = "CONTATO";

include 'header.php' ?>

<style type="text/css">
	body{font-family: Arial, Helvetica, sans-serif;}
	.form{display: flex;flex-direction: column;}
	.field{padding: 10px; margin-top: 10px; margin-bottom: 30px; border: 2px solid #00000;font-family: Arial, Helvetica, sans-serif;font-size: 16px; border-radius: 10px;}
	input{margin-bottom: 40px; border-radius: 5px;}

	textarea{height: 150px;}
	.form-contato{padding: 10px;margin-top: 5px; margin-right: 30%; margin-left: 30%;}


</style>

<div class="form-contato">
	<section class="content">
		<div class="mt-5">
			<h3>Fale conosco</h3>
			<form class="form" method="POST" action="email.php">
				<input type="" name="nome" placeholder=" Nome">
				<input type="field" name="email" placeholder=" E-mail">
				<textarea class="field" name="mensagem" placeholder="Digite sua mensagem aqui."></textarea>
				<input class="field" type="submit" value="Enviar" name="enviar">

			</form>


		</div>


	</section>

</div>

<?php include 'footer.php' ?>

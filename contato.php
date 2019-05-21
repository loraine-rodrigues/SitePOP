<?php
$title = "CONTATO";

include 'header.php' ?>

<style type="text/css">

	.field {
		padding: 10px;
		margin-top: 10px;
		margin-bottom: 30px;
		font-size: 16px;
	}

</style>
<div class="container text-center">
    <div class="row">
        <div class="col-md-11 text-center">
<h2 class="ml-5">Fale Conosco</h2>
		</div>
	</div>
</div>
    <br>
<div class="card m-auto text-left" style="width: 24rem;">
	<div class="card-body">
			<div class="form" method="POST" action="email.php">
				<div class="form-group">
				<div class="form-group">
                    <label for="email"> Email: </label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu email" required>
				</div>
				<div class="form-group">
                    <label for="nome"> Nome: </label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome" required>
                </div>

				</div>
				<div class="form-group">
				<label for="mensagem"> Mensagem: </label>
					<textarea class="field form-control" name="mensagem" placeholder="Digite sua mensagem aqui."></textarea>
					<input class="btn btn-outline-primary btn-block" type="submit" value="Enviar" name="enviar">
				</div>
			</div>
	</div>
</div>



</div>





<?php include 'footer.php' ?>
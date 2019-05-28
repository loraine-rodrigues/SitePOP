<?php
$title = "CONTATO";

include "funcao.php";

if(strlen($_POST['nome']))
{
    if(sendMail($_POST['email'],'seuemail@gmail.com', $_POST['mensagem'], 'Formulário de contato'))
    {
        echo "Sua mensagem foi enviada com sucesso!";
    }
    else
    {
        echo "Ocorreu um erro ao enviar";
    }
    echo "<br><a href='index.php'>Voltar</a>";
    exit();
}

include 'header.php' ?>

<style type="text/css">
	h2 {
		background-color: white;
		line-height: 40px;
		border-style: 2px;
		padding: 5px 20px;
		opacity: 0.6;
		text-decoration: none
	}

	.field {
		padding: 10px;
		margin-top: 10px;
		margin-bottom: 30px;
		font-size: 16px;
	}

	body {
		width: 100%;
		background-image: url(image/home2.jpg) !important;
		background-repeat: no-repeat;
		background-position: 30% 45%;
		background-size: cover;
	}
</style>
<div class="container text-center">

	<div class="row">

		<div class="col-md-11 text-center">
			<img src="image/suporte.png" width="50" height="50" class="float-right">

			<h2 class="ml-5">Fale Conosco</h2>

		</div>
	</div>
</div>
<br>
<div class="card m-auto text-left" style="width: 24rem;">
	<div class="card-body">

		<div class="form" id="formulario_contato" method="POST" onsubmit="validaForm(); return false;">
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


<script type="text/javascript">
        function validaForm()
        {
            erro = false;
            if($('#nome').val() == '')
            {
                alert('Você precisa preencher o campo Nome');erro = true;
            }
            if($('#email').val() == '' && !erro)
            {
                alert('Você precisa preencher o campo E-mail');erro = true;
            }
            if($('#mensagem').val() == '' && !erro)
            {
                alert('Você precisa preencher o campo Mensagem');erro = true;
            }
            
            //se nao tiver erros
            if(!erro)
            {
                $('#formulario_contato').submit();
            }
        }
    </script>



<?php include 'footer.php' ?>

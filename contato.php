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


</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
    

		<form method="post" id="formulario_contato" onsubmit="validaForm(); return false;" class="form">
           <div class="form-group">
           		<label for="name">Nome</label>
               <input type="text" name="nome" id="nome" placeholder="Seu Nome" class="form-control" required="">
            </div>
            
             <div class="form-group">
           		<label for="name">Email</label>
               <input type="email" name="nome" id="nome" placeholder="Seu Nome" class="form-control" required="">
            </div>
             <div class="form-group">
           		<label for="name">Mensagem</label>
               <textarea name="mensagem" id="mensagem" placeholder="Escreva sua mensagem" class="form-control"></textarea>
            </div>
		
		
				
	
		
		<div class="text-center">
        <button class="btn btn-success" type="submit">Enviar</button>    
            </div>
		
	</form>
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

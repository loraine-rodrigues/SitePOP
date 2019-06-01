<?php
$title = "CONTATO";
include 'funcao.php';
include 'header.php';
if (strlen($_POST['nome'])) {
    if (sendMail($_POST['email'], 'popmotos1111@gmail.com', $_POST['mensagem'], 'Formulario de contato')) {
        echo "Sua mensagem foi enviada com sucesso!";
    } else {
        echo "Ocorreu um erro ao enviar";
    }
    echo "<br><a href='home.php'>Voltar</a>";
    exit();
}
?>

<style type="text/css">
    
    .field {
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 30px;
        font-size: 16px;
    }
    @media only screen and (min-width: 767px) {
  body {
    /* The file size of this background image is 93% smaller
       to improve page load speed on mobile internet connections */
       background-image: url(image/bg-contato.png) !important;
  }
}
    body {
        width: 100%;
        background-image: url(image/bg-contato.png) !important;
        background-repeat: no-repeat;
        background-position: 100% 100%;
        background-size: cover;
    }
    
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="container text-center">
    <div class="row">
        <div class="col-md-11 text-center">
            
            <h2 class="ml-5     ">Fale Conosco</h2>
        </div>
    </div>
</div>
<br>
<div class="card m-auto text-left" style="width: 24rem;">
    <div class="card-body">

        <form method="post" id="formulario_contato" onsubmit="validaForm(); return false;" class="form">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Seu Nome" class="form-control" required="">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Seu Email" class="form-control" required="">
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem</label>
                <textarea name="mensagem" id="mensagem" placeholder="Escreva sua mensagem" class="form-control"></textarea>
            </div>





            <div class="text-center">
                <button class="btn btn-info" type="submit">Enviar</button>
            </div>

        </form>
    </div>
</div>
<script type="text/javascript">
    function validaForm() {
        erro = false;
        if ($('#nome').val() == '') {
            alert('Você precisa preencher o campo Nome');
            erro = true;
        }
        if ($('#email').val() == '' && !erro) {
            alert('Você precisa preencher o campo E-mail');
            erro = true;
        }
        if ($('#mensagem').val() == '' && !erro) {
            alert('Você precisa preencher o campo Mensagem');
            erro = true;
        }
        //se nao tiver erros
        if (!erro) {
            $('#formulario_contato').submit();
        }
    }
</script>



<?php include 'footer.php' ?>
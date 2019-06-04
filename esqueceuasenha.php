<?php
$title = "RECUPERAR SENHA";
include 'conexao.php';
include 'funcao.php';
include 'header.php';
<<<<<<< HEAD


if (isset($_POST['email'])) {
    $email =    strip_tags(trim($_POST['email']));
     //envia o email para a pessoa juntamente com seu nome e sua senha
     $mensagem = "Olá, você solicitou a recuperação de senha.\n";    
     $mensagem .= "Recupere sua senha: ";
     $mensagem = "Clique <a href=".$link.">aqui</a> para recuperar sua senha.";
     
=======
if (isset($_POST['email'])) {
    $email =    strip_tags(trim($_POST['email']));
     //envia o email para a pessoa juntamente com seu nome e sua senha
     $mensagem = "Olá $nome, você solicitou a recuperação de senha.\n";
     $mensagem .= "Sua senha é: $senha";
>>>>>>> master
    if (sendMail($_POST['email'], $email, $mensagem, 'Recuperação de senha')) {
         //alerta que o email foi enviado e o redireciona para outra página
         echo "<script>alert('Senha enviada por e-mail, verifique sua caixa de mensagens ou sua caixa de spans.'),window.open('home.php','_self')</script>";
        $sql = "SELECT * FROM tb_login WHERE nm_usuario = '$email'";
        $res = $pdo->query($sql);
        if ($res->rowCount() == 1) {
            //fazemos um while para coletarmos as outras informações do usuario
            //tais como o nome e a senha
            while ($exibir = $res->fetch(PDO::FETCH_OBJ)) {
                $email = $exibir->email;
<<<<<<< HEAD
                $recupera = $exibir->recupera;
=======
                $senha = $exibir->senha;
>>>>>>> master
            }
        }

       
    }
        //caso contrário
        else {
            //lhe informa que o seu e-mail não está cadastrado no banco de dados
            echo "<script>alert('E-mail não cadastrado em nosso sistema, caso não se lembre do email cadastrado, entre em contato conosco.'),window.open('contato.php','_self')</script>";
        }
        exit();
    }
<<<<<<< HEAD
    
=======
>>>>>>> master
?>

<style type="text/css">
    .field {
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 30px;
        font-size: 16px;
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

            <h2 class="ml-5 text-info">Recuperação de Senha</h2>
        </div>
    </div>
</div>
<br>
<div class="card m-auto text-left" style="width: 24rem;">
    <div class="card-body">

        <form method="post" id="recupera" onsubmit="validaForm(); return false;" class="form">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Seu Nome" class="form-control" required="">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Seu Email" class="form-control" required="">
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
        //se nao tiver erros
        if (!erro) {
            $('#recupera').submit();
        }
    }
</script>

<?php include 'footer.php';
?>
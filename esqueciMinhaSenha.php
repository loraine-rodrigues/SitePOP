<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$title = "ESQUECI MINHA SENHA";

include 'header.php';

if (isset($_SESSION['logado'])) {
    ?>
    <script>
        window.location.href = 'perfil/';
    </script>
    <?php
}

require 'conexao.php';

if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
    try {
        $email = $_POST["email"];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!$email) {
            $erro = "<p>Endereço de email inválido.<br> Por favor, digite um email válido.</p>";
        }

        if (empty($erro)) {
            $expiracao = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y")));
            $chaveTemporaria = md5($email) . substr(md5(uniqid(rand(), 1)), 3, 10);

            $comando = $conexao->prepare("CALL gerarSenhaTemporaria(:email, :chaveTemporaria, :expiracao);");
            $comando->bindParam(':email', $email);
            $comando->bindParam(':chaveTemporaria', $chaveTemporaria);
            $comando->bindParam(':expiracao', $expiracao);

            if ($comando->execute()) {
                if ($comando->rowCount() <= 0) {
                    $erro = "Não foi possível recuperar a senha para esse email";
                } else {

                    // Construção do email

                    // Corpo
                    $corpoEmail  = '<h3>Caro usuário,</h3>';
                    $corpoEmail .= '<p>Por favor, clique no link abaixo ou copie e cole-o completo no seu navegador para atualizar sua senha.</p>';
                    $corpoEmail .= '<hr>';
                    $corpoEmail .= '<p><a href="http://popmotofrete.azurewebsites.net/recuperarSenha.php?key=' . $chaveTemporaria . '&email=' . $email . '" target="_blank">http://popmotofrete.azurewebsites.net/recuperarSenha.php?key=' . $chaveTemporaria . '&email=' . $email . '</a></p>';
                    $corpoEmail .= '<hr>';
                    $corpoEmail .= '<p>O link irá expirar após 1 dia por motivos de segurança.</p>';
                    $corpoEmail .= '<p>Se você não solicitou esse email, nenhuma ação é necessária, sua senha não será resetada.</p>';
                    $corpoEmail .= '<p>Obrigado, </p>';
                    $corpoEmail .= '<p>Equipe POP! Motofrete</p>';

                    // Assunto
                    $assuntoEmail = "RECUPERAÇÃO DE SENHA - POP! MOTOFRETE";

                    // Para
                    $paraEmail = $email;

                    // De
                    $deEmail = 'popmotos1111@gmail.com';

                    require("terceiros/phpmailer/PHPMailerAutoload.php");
                    $phpMailer = new PHPMailer();
                    $phpMailer->CharSet = 'UTF-8';
                    $phpMailer->IsSMTP();
                    $phpMailer->Host = 'smtp.gmail.com'; // Host do email
                    $phpMailer->SMTPSecure = 'tls';
                    $phpMailer->SMTPAuth = true;
                    $phpMailer->Username = $deEmail; // Email que irá enviar
                    $phpMailer->Password = "motofrete"; // Senha do email que irá enviar
                    $phpMailer->Port = 587;
                    $phpMailer->IsHTML(true);
                    $phpMailer->From = $deEmail;
                    $phpMailer->FromName = "POP! MOTOFRETE";
                    $phpMailer->Sender = $paraEmail; // indicates ReturnPath header
                    $phpMailer->Subject = $assuntoEmail;
                    $phpMailer->Body = $corpoEmail;
                    $phpMailer->AddAddress($paraEmail);
                    if (!$phpMailer->Send()) {
                        $erro = "Erro no envio das instruções por email";
                    } else {
                        $mensagem = "Recuperação realizada com sucesso<br>Para continuar, siga as instruções enviadas por email";
                    }
                }
            } else {
                $erro = "Endereço de email inválido.<br> Por favor, digite um email válido.";
            }
        }

    } catch (phpmailerException $excecao) {
        $erro = "Erro ao enviar email";

    } catch (PDOException $excecao) {
        $erro = "Erro ao buscar email" . $excecao->getMessage();
    }
} ?>

    <style type="text/css">
        body {
            width: 100%;
            background-image: url(image/bg-duvida.png) !important;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

    <div class="container text-center">
        <h1>ESQUECI MINHA SENHA</h1>
        <div class="card mx-auto my-5" style="width: 54rem;">
            <div class="card-body">

            <?php
            if (isset($erro)) { ?>
                <div class="alert alert-danger text-left">
                    <?= $erro ?>
                </div>
            <?php
            } else if (isset($mensagem)) { ?>
                <div class="alert alert-success text-left">
                    <?= $mensagem ?>
                </div>
            <?php } else { ?>

                <form method="post">

                    <div class="form-group m-3">
                        <label for="email"><strong>Informe seu e-mail:</strong></label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="usuario@email.com" />
                    </div>

                    <input class="btn btn-primary" type="submit" value="Recuperar senha" />

                </form>

            <?php } ?>

            </div>
        </div>
    </div>

<?php
include 'footer.php';
?>
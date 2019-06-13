<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$title = "CONTATO";

if (isset($_POST["enviar"])) {
    try {

        $email = $_POST["email"];
        if (!empty($email)) {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if (!$email) {
                $erro .= "<li>Endereço de email inválido. Por favor, digite um email válido.</li>";
            }
        }

        $nome = $_POST['nome'];
        if (empty($nome)) {
            $erro .= "<li>Informe seu nome para enviar a mensagem</li>";
        }

        $mensagem = $_POST['mensagem'];
        if (empty($mensagem)) {
            $erro .= "<li>Informe a mensagem a ser enviada</li>";
        }

        if (empty($erro)) {
            // Construção do email

            // Corpo
            $corpoEmail  = '<h3>Mensagem de ' . $email . '</h3>';
            $corpoEmail .= '<hr>';
            $corpoEmail .= $mensagem;
            $corpoEmail .= '<hr>';

            // Assunto
            $assuntoEmail = "MENSAGEM - " . $nome;

            // Para
            $paraEmail = 'popmotos1111@gmail.com';

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
                $erro = "Não foi possível enviar sua mensagem";
            } else {
                $mensagem = "Mensagem enviada com sucesso<br>Agradecemos seu contato";
            }
        }
    } catch (phpmailerException $excecao) {
        $erro = "Erro ao enviar mensagem";
    }
}

include 'header.php'; ?>

    <style type="text/css">
        body {
            width: 100%;
            background-image: url(image/bg-contato.png) !important;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

    <div class="container text-center">
        <h1>FALE CONOSCO</h1>
        <div class="card mx-auto my-5" style="width: 54rem;">
            <div class="card-body">

                <?php
                if (isset($erro)) { ?>
                    <div class="alert alert-danger text-left">
                        <ul>
                            <?= $erro ?>
                        </ul>
                    </div>
                    <?php
                } else if (isset($mensagem)) { ?>
                    <div class="alert alert-success text-left">
                        <?= $mensagem ?>
                    </div>
                <?php } else { ?>

                    <form method="post">

                        <div class="form-group m-3 mb-5">
                            <label for="nome">Informe seu nome:</label>
                            <input class="form-control" type="text" id="nome" name="nome" placeholder="Digite seu nome" />
                        </div>

                        <div class="form-group m-3 mb-5">
                            <label for="email">Informe seu e-mail:</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="usuario@email.com" />
                        </div>

                        <div class="form-group m-3 mb-5">
                            <label for="mensagem">Informe sua mensagem:</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" placeholder="Digite aqui sua mensagem..." rows="5"></textarea>
                        </div>

                        <input class="btn btn-primary" type="submit" name="enviar" value="Enviar mensagem" />

                    </form>

                <?php } ?>

            </div>
        </div>
    </div>

<?php
include 'footer.php';
?>
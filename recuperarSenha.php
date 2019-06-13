<?php

require 'conexao.php';

if (isset($_GET["key"]) && isset($_GET["email"])){
    $chave = $_GET["key"];
    $email = $_GET["email"];
    $dataAtual = date("Y-m-d H:i:s");

    try {
        $comando = $conexao->prepare("CALL validarChave(:email, :chave)");
        $comando->bindParam(':email', $email);
        $comando->bindParam(':chave', $chave);

        if ($comando->execute()) {
            if ($comando->rowCount() <= 0) {
                $erro = "O link é inválido ou expirou.<br>Este link pode estar incompleto ou já tenha sido usado.<br>Clique <a href='http://popmotofrete.azurewebsites.net/esqueciMinhaSenha.php'>aqui</a> para tentar recuperar a senha novamente.";
            } else {
                $resultado = $comando->fetch();
            }
        }
    } catch (PDOException $excecao) {
        $erro = "Erro ao iniciar processo de alterar a senha";
    }
}

require 'conexao.php';

if (isset($_POST['alterar'])) {
    $senha = $_POST['senha'];
    $confirmacaoSenha = $_POST['confirmacaoSenha'];

    if ($senha != $confirmacaoSenha) {
        $erro = "Senhas diferentes<br>Informe duas senhas iguais";
    }

    if (empty($erro)) {
        try {
            if ($comando->rowCount() > 0) {
                $comando = $conexao->prepare("CALL resetarSenha(:usuario, :novaSenha)");
                $comando->bindParam(':usuario', $email);
                $comando->bindParam(':novaSenha', $senha);
                if ($comando->execute()) {
                    $mensagem = "Senha alterada com sucesso<br>Clique <a href='index.php'>aqui</a> efetuar login";
                } else {
                    $erro = "Não foi possível alterar a senha";
                }
            }
        } catch (PDOException $exception) {
            echo 'erro';
        }
    }
}


$title = "RECUPERAR SENHA";

include 'header.php';

?>

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
        <h1>RECUPERAR SENHA</h1>
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

                <?php
                } else if ($resultado['dataExpiracao'] >= $dataAtual) { ?>

                    <form method="post" action="" name="reset"><br /><br />

                        <div class="form-group m-3">
                            <label for="senha">Informe sua nova senha:</label>
                            <input class="form-control m-3" type="password" id="senha" name="senha" placeholder="Digite aqui sua senha" />
                        </div>

                        <div class="form-group m-3">
                            <label for="confirmacaoSenha">Informe novamente sua nova senha:</label>
                            <input class="form-control m-3" type="password" id="confirmacaoSenha" name="confirmacaoSenha" placeholder="Confirme aqui sua senha" />
                        </div>

                        <input class="btn btn-primary m-3" type="submit" id="alterar" name="alterar" value="Alterar" />

                    </form>

                <?php } else { ?>

                    <div class="alert alert-danger text-left">
                        <p>Link expirado</p>
                        <p>Os links são gerados com a expiração em 24 horas por motivos de segurança</p>
                        <p>Clique <a href='esqueciMinhaSenha.php'>aqui</a> para tentar recuperar a senha novamente</p>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>
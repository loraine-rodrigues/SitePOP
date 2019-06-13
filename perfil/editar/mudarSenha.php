<?php
$title = "ALTERAR SENHA";

include '../../header.php';

require '../../conexao.php';

if (isset($_POST['alterar'])) {
    if ($_POST['novaSenha'] != $_POST['confirmacaoNovaSenha']) {
        $erro = "Senhas não conferem";
    }

    if (empty($erro)) {
        try {
            $comando = $conexao->prepare("CALL mudarSenha(:email, :senhaAntiga, :novaSenha);");
            $comando->bindParam(':email', $_SESSION['login']);
            $comando->bindParam(':senhaAntiga', $_POST['senhaAntiga']);
            $comando->bindParam(':novaSenha', $_POST['novaSenha']);

            if ($comando->execute()) {
                if ($comando->rowCount() <= 0){
                    $erro = "Não foi possível realizar a alteração";
                } else {
                    $mensagem = "Senha alterada com sucesso";
                }
            } else {
                $erro = "Não foi possível realizar a alteração";
            }
        }
        catch (PDOException $excecao) {
            $erro = "Erro ao realizar a alteração";
        }
    }
} ?>

<div class="container text-center">
    <h1 class=" ml-5">PERFIL CLIENTE</h1>
    <div class="card mx-auto my-5 text-left" style="width: 54rem;">
        <div class="card-body">

            <?php
            if (isset($erro)) { //Mensagem de erro ?>
                <div class="alert alert-danger">
                    <?= $erro ?>
                </div>
                <div class="col text-center">
                    <a href="../index.php" class="btn btn-outline-primary mx-5"><i class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                </div>
            <?php } else if (isset($mensagem)) { //Mensagem de sucesso { ?>
                <div class="alert alert-success">
                    <?= $mensagem ?>
                </div>
                <div class="col text-center">
                    <a href="../index.php" class="btn btn-outline-primary mx-5"><i class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                </div>
            <?php } else { ?>

            <form method="post">
                <h3 class="card-title mb-4">ALTERAR SENHA</h3>
                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senhaAntiga"> Senha antiga: </label>
                            <input type="password" class="form-control" id="senhaAntiga" name="senhaAntiga" required>
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="novaSenha"> Nova senha: </label>
                            <input type="password" class="form-control" id="novaSenha" name="novaSenha" required>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="confirmacaoNovaSenha"> Confirmar nova senha: </label>
                            <input type="password" class="form-control" id="confirmacaoNovaSenha" name="confirmacaoNovaSenha" required>
                        </div>
                    </div>

                </div>

                <div>
                    <div class="row text-right m-3">
                        <div class="col">
                            <a class="btn btn-outline-danger" href="cliente.php">Cancelar</a>
                            <input type="submit" class="btn btn-outline-primary" name="alterar" value="Alterar">
                        </div>
                    </div>
                </div>

            </form>

            <?php } ?>
        </div>

    </div>
</div>

<?php include '../../footer.php'; ?>


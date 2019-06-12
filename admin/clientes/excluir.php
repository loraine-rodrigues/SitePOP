<?php

require "../../conexao.php";

if (isset($_POST['excluir'])) {
    try {
        $comando = $conexao->prepare("CALL desativarCliente(:id)");
        $comando->bindParam(':id', $_POST['id']);

        if ($comando->execute()) {
            header('Location: index.php');
            exit();
        }
    }
    catch (PDOException $excecao) {
        $erro = "Erro ao excluir o cliente";
    }
}

//Redireciona p index se nao receber um valor ou se esse valor nao for numero
if (!isset($_GET['id']) || !is_numeric($_GET['id']) ){
    header('Location: index.php');
    exit();
}

try {
    $comando = $conexao->prepare("CALL buscarCliente(:id)");
    $comando->bindParam(':id', $_GET['id']);
    $comando->execute();
} catch (PDOException $excecao) {
    $erro = "Erro ao mostrar o cliente";
}

try {
    $comando = $conexao->prepare("CALL buscarCliente(:id)"); //prepara o comando para buscar cliente pelo ID
    $comando->bindParam(':id', $_GET['id']);
    if ($comando->execute())
    {
        if ($comando->rowCount() <= 0){     //se o numero de linhas retornadas for igual a 0, redireciona p index
            header('Location: index.php');
            exit();
        }
    } else {
        $erro = "Não foi possível mostrar o cliente";
    }
}
catch (PDOException $excecao) {
    $erro = "Erro ao buscar o cliente";
}

$title = "EXCLUIR CLIENTE";

include "../../header.php";
?>

    <div class="container text-center">
        <h1 class="font-weight-light">EXCLUIR CLIENTE</h1>

        <div class="card m-auto text-left" style="width: 54rem;">
            <div class="card-body">
                <h3 class="card-title mb-4">DADOS PESSOAIS</h3>

                <?php if ($resultado = $comando->fetch()) { ?>

                    <form method="post">
                        <div class="row">

                            <!--Id do cliente-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="id"> Id: </label>
                                    <input type="text" class="form-control" id="id" name="id" value="<?= $resultado['id_cliente'] ?>" readonly>
                                </div>
                            </div>

                            <!--Email usado para login-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="email"> Email: </label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $resultado['nm_email'] ?>" readonly>
                                </div>
                            </div>

                            <!--Data de nascimento do cliente-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label>
                                    <input type="date" class="form-control" id="data" name="nascimento" placeholder="Informe a data de nascimento" value="<?= $resultado['dt_nascimento'] ?>" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!--Nome completo do cliente-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="nome"> Nome: </label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe a nome completo" value="<?= $resultado['nm_cliente'] ?>" readonly>
                                </div>
                            </div>

                            <!--CPF-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="cpf"> CPF: </label>
                                    <input type="tel" class="form-control" id="cpf" name="cpf" placeholder="Informe o cpf" value="<?= $resultado['id_cpf'] ?>" readonly>
                                </div>
                            </div>

                            <!--Celular para contato de emergência-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="celular"> Celular: </label>
                                    <input type="tel" class="form-control" id="celular" name="celular" placeholder="Celular para contato" value="<?= $resultado['cd_celular'] ?>" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-5">
                            <!-- Botão voltar-->
                            <div class="col">
                                <a href="index.php" class="btn btn-outline-warning float-left mx-5"><i class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                            </div>

                            <!-- Botão de excluir cadastro-->
                            <div class="col">
                                <button type="submit" name="excluir" class="btn btn-outline-danger float-right mx-5">Excluir <i class="fas fa-times"></i></button> <!--Botão excluir-->
                            </div>
                        </div>
                    </form>

                <?php } else  { ?>
                    <div class="alert alert-danger">
                        <?= $erro ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $("#celular").inputmask("(99)9999-9999[9]");
            $("#cpf").inputmask("999.999.999-99");
        });
    </script>

<?php
include "../../footer.php";
?>
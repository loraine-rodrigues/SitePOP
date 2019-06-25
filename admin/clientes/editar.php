<?php

require "../../conexao.php";

if (isset($_POST['editar'])) {
    foreach ($_POST as $campo) {
        if (empty($campo)) {
            $erro = "É necessário preencher todos os campos";
        }
    }

    if (empty($erro)) {
        try {
            $id = $_GET['id'];
            $nome = $_POST ['nome'];
            $nascimento = $_POST ['nascimento'];
            $cpf = $_POST ['cpf'];
            $celular = $_POST ['celular'];
            $email = $_POST ['email'];

            $comando = $conexao->prepare("CALL adminEditarCliente(:id, :nome, :nascimento, :cpf, :email, :celular)");
            $comando->bindParam(':id', $id);
            $comando->bindParam(':nome', $nome);
            $comando->bindParam(':nascimento', $nascimento);
            $comando->bindParam(':cpf', $cpf);
            $comando->bindParam(':email', $email);
            $comando->bindParam(':celular', $celular);
            if ($comando->execute()) {
                $mensagem = "Alteração realizada com sucesso";
            }
        } catch (PDOException $excecao) {
            $erro = "Erro ao editar cliente" . $excecao->getMessage();
        }
    }
}

try {
    $comando = $conexao->prepare("CALL adminBuscarCliente(:id)");
    $comando->bindParam(':id', $_GET['id']);
    if ($comando->execute()) {
        if ($comando->rowCount() <= 0) {     //se o numero de linhas retornadas for igual a 0, redireciona p index
            ?>
            <script>
                window.location.href = 'index.php';
            </script>
            <?php
        }
    } else {
        $erro = "Não foi possível mostrar o cliente";
    }
} catch (PDOException $excecao) {
    $erro = "Erro ao mostrar o cliente";
}

$title = "EDITAR CLIENTE";

include "../../header.php"; ?>

    <div class="container text-center">
        <h1 class="font-weight-light">EDITAR CLIENTE</h1>


        <div class="card m-auto text-left" style="width: 54rem;">
            <div class="card-body">

                <?php if (isset($erro)) { ?>

                    <div class="alert alert-danger">
                        <?= $erro ?>
                    </div>
                    <div class="col text-center">
                        <a href="index.php" class="btn btn-outline-primary mx-5"><i class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                    </div>

                <?php } else if (isset($mensagem)) { ?>

                    <div class="alert alert-success">
                        <?= $mensagem ?>
                    </div>
                    <div class="col text-center">
                        <a href="index.php" class="btn btn-outline-primary mx-5"><i class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                    </div>

                <?php } else if ($resultado = $comando->fetch()) { ?>

                    <h3 class="card-title mb-4">DADOS PESSOAIS</h3>

                    <form id="form" method="post" class="needs-validation" novalidate>
                        <div class="row">

                            <!--Nome completo do cliente-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="nome"> Nome: </label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                           placeholder="Informe a nome completo" value="<?= $resultado['nm_cliente'] ?>"
                                           required>
                                    <div class="invalid-feedback">
                                        Campo obrigatório
                                    </div>
                                </div>
                            </div>

                            <!--Data de nascimento do cliente-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label>
                                    <input type="text" class="form-control" id="data" name="nascimento"
                                           placeholder="Informe a data de nascimento"
                                           value="<?= date("d/m/Y", strtotime($resultado['dt_nascimento'])) ?>"
                                           required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackData"> </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!--Email usado para login-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="email"> Email: </label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="<?= $resultado['nm_email'] ?>" required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackEmail"> </span>
                                    </div>
                                </div>
                            </div>

                            <!--CPF-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="cpf"> CPF: </label>
                                    <input type="tel" class="form-control" id="cpf" name="cpf"
                                           placeholder="Informe o cpf" value="<?= $resultado['id_cpf'] ?>" required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackCpf"> </span>
                                    </div>
                                </div>
                            </div>

                            <!--Celular para contato de emergência-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="celular"> Celular: </label>
                                    <input type="tel" class="form-control" id="celular" name="celular"
                                           placeholder="Celular para contato" value="<?= $resultado['cd_celular'] ?>"
                                           required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackCelular"> </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-5">
                            <!-- Botão voltar-->
                            <div class="col">
                                <a href="index.php" class="btn btn-outline-warning float-left mx-5"><i class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                            </div>

                            <!-- Botão de editar cadastro-->
                            <div class="col">
                                <button type="submit" name="editar" value="ok" class="btn btn-outline-success float-right mx-5">Editar <i class="fas fa-edit"></i></button> <!--Botão editar-->
                            </div>
                        </div>
                    </form>

                <?php } else { ?>
                    <div class="alert alert-danger">
                        <?= isset($erro) ? $erro : "Erro ao mostrar o cliente" ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="../../scripts/validaCpf.js"></script>
    <script src="validacoes.js"></script>

<?php
include "../../footer.php";
?>

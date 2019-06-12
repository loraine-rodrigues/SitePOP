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
            $id = $_POST['id'];
            $nome = $_POST ['nome'];
            $nascimento = $_POST ['nascimento'];
            $cpf = $_POST ['cpf'];
            $celular = $_POST ['celular'];
            $email = $_POST ['email'];

            $comando = $conexao->prepare("CALL editarCliente(:id, :nome, :nascimento, :cpf, :email, :celular)");
            $comando->bindParam(':id', $id);
            $comando->bindParam(':nome', $nome);
            $comando->bindParam(':nascimento', $nascimento);
            $comando->bindParam(':cpf', $cpf);
            $comando->bindParam(':email', $email);
            $comando->bindParam(':celular', $celular);
            $comando->execute();

            $mensagem = "Cliente editado com sucesso";
        } catch (PDOException $excecao) {
            $erro = "Erro ao editar cliente";
            echo $excecao->getMessage();
        }
    }
}

try {
    $comando = $conexao->prepare("CALL buscarCliente(:id)");
    $comando->bindParam(':id', $_GET['id']);
    if ($comando->execute()) {
        if ($comando->rowCount() <= 0){     //se o numero de linhas retornadas for igual a 0, redireciona p index
            header('Location: index.php');
            exit();
        }
    } else {
        $erro = "Não foi possível mostrar o cliente";
    }
} catch (PDOException $excecao) {
    $erro = "Erro ao mostrar o cliente";
    echo $excecao->getMessage();
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
                <?php } ?>

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
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $resultado['nm_email'] ?>" required>
                                </div>
                            </div>

                            <!--Data de nascimento do cliente-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label>
                                    <input type="date" class="form-control" id="data" name="nascimento" placeholder="Informe a data de nascimento" value="<?= $resultado['dt_nascimento'] ?>" required>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!--Nome completo do cliente-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="nome"> Nome: </label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe a nome completo" value="<?= $resultado['nm_cliente'] ?>" required>
                                </div>
                            </div>

                            <!--CPF-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="cpf"> CPF: </label>
                                    <input type="tel" class="form-control" id="cpf" name="cpf" placeholder="Informe o cpf" value="<?= $resultado['id_cpf'] ?>" required>
                                </div>
                            </div>

                            <!--Celular para contato de emergência-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="celular"> Celular: </label>
                                    <input type="tel" class="form-control" id="celular" name="celular" placeholder="Celular para contato" value="<?= $resultado['cd_celular'] ?>" required>
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

                <?php } else  { ?>
                    <div class="alert alert-danger">
                        <?= isset($erro) ? $erro : "Erro ao mostrar o cliente" ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $("#celular").inputmask("(99)9999-9999[9]", {removeMaskOnSubmit: true});
            $("#cpf").inputmask("999.999.999-99", {removeMaskOnSubmit: true});
        });
    </script>

<?php
include "../../footer.php";
?>
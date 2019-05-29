<?php

$title = "EDITAR CLIENTE";

include "../../header.php";
require "../../conexao.php";

if (isset($_POST['excluir'])) {
    try {
        $comando = $conexao->prepare("CALL deletarCliente(:id)");
        $comando->bindParam(':id', $_POST['id']);
        $comando->execute();

        header('Location: home.php');
        exit();
    }
    catch (PDOException $excecao) {
        echo "Erro ao excluir o cliente: " . $excecao->getMessage();
    }
}

try {
    $comando = $conexao->prepare("CALL buscarCliente(:id)");
    $comando->bindParam(':id', $_GET['id']);
    $comando->execute();
}
catch (PDOException $excecao) {
    echo "Erro ao buscar o cliente: " . $excecao->getMessage();
}

$resultado = $comando->fetch();
?>

<div class="container text-center">
    <h1 class="font-weight-light text-white">EXCLUIR CLIENTE</h1>
    <br>
    <div class="card m-auto text-left" style="width: 54rem;"> <!--Div usada para formartar o card de login -->
        <div class="card-body">
            <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
            <form method="post">
                <div class="row">

                    <!--Id do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="id"> Id: </label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $resultado['id_cliente'] ?>" readonly>
                        </div>
                    </div>

                    <!--Email usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $resultado['nm_email'] ?>" readonly>
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Data de nascimento: </label>
                            <input type="date" class="form-control" id="data" name="nascimento" placeholder="Informe a data de nascimento" value="<?php echo $resultado['dt_nascimento'] ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe a nome completo" value="<?php echo $resultado['nm_cliente'] ?>" readonly>
                        </div>
                    </div>

                    <!--CPF-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cpf"> CPF: </label>
                            <input type="tel" class="form-control" id="cpf" name="cpf" placeholder="Informe o cpf" value="<?php echo $resultado['id_cpf'] ?>" readonly>
                        </div>
                    </div>

                    <!--Celular para contato de emergência-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular: </label>
                            <input type="tel" class="form-control" id="celular" name="celular" placeholder="Celular para contato" value="<?php echo $resultado['cd_celular'] ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">




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
        </div>

        </div>
    </div>
    <br>
</div>

<?php
include "../../footer.php";
?>
<?php
$title = "EDITAR PERFIL";

include '../../header.php';

require '../../conexao.php';

if (isset($_POST['salvar'])) {
    foreach ($_POST as $campo) {
        if (empty($campo)) {
            $erro = "É necessário informar todos os campos";
        }
    }

    if (empty($erro)) {
        try {
            $comando = $conexao->prepare("CALL editarCliente(:id, :nome, :data, :cpf, :email, :celular)");
            $comando->bindParam(':id', $_SESSION['id']);
            $comando->bindParam(':nome', $_POST['nome']);
            $comando->bindParam(':data', $_POST['data']);
            $comando->bindParam(':cpf', $_POST['cpf']);
            $comando->bindParam(':email', $_POST['email']);
            $comando->bindParam(':celular', $_POST['celular']);

            if ($comando->execute()) {
                if ($comando->rowCount() > 0){
                    $mensagem = "Alteração realizada com sucesso";
                    $_SESSION['nome'] = $_POST['nome'];
                    $_SESSION['login'] = $_POST['email'];
                    ?>
                    <script>
                        $("#nome_sessao").text("<?= $_POST['nome'] ?>")
                    </script>
                    <?php
                } else {
                    $erro = "Não foi possível realizar alteração";
                }
            } else {
                $erro = "Não foi possível realizar alteração";
            }
        } catch (PDOException $e) {
            $erro = "Erro ao realizar alteração" . $e->getMessage();
        }
    }
}

try {
    if ($_SESSION['tipo'] == 1) { // Se for do tipo cliente (1)
        $comando = $conexao->prepare("CALL buscarCliente(:id)");
    } else if ($_SESSION['tipo'] == 2) { // Se for do tipo motofretista (2)
        ?>
        <script>
            window.location.href = '../motofretista.php';
        </script>
        <?php
    } else { // Se for do tipo admin (3)
        ?>
        <script>
            window.location.href = '../admin.php';
        </script>
        <?php
    }

    $comando->bindParam(':id', $_SESSION['id']);

    if ($comando->execute()) {
        if ($comando->rowCount() <= 0){
            $erro = "Perfil não encontrado";
        }
    } else {
        $erro = "Não foi possível exibir seu perfil no momento";
    }
}
catch (PDOException $excecao) {
    $erro = "Erro ao exibir perfil";
} ?>

<div class="container text-center">
    <h1 class=" ml-5">PERFIL CLIENTE</h1>
    <div class="card mx-auto my-5 text-left" style="width: 54rem;">
        <form id="form" method="post" class="needs-validation" novalidate>
            <div class="card-body">

                <?php
                if (isset($erro)) { //Mensagem de erro ?>
                    <div class="alert alert-danger">
                        <?= $erro ?>
                    </div>
                    <div class="col text-center">
                        <a href="../index.php" class="btn btn-outline-primary mx-5"><i class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                    </div>
                <?php } else if (isset($mensagem)) { //Mensagem de sucesso ?>
                    <div class="alert alert-success">
                        <?= $mensagem ?>
                    </div>
                    <div class="col text-center">
                        <a href="../index.php" class="btn btn-outline-primary mx-5"><i class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                    </div>
                <?php } else if ($resultado = $comando->fetch()) { ?>
                    <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
                    <div class="row">

                        <!--Nome completo do cliente-->
                        <div class="col">
                            <div class="form-group">
                                <label for="nome"> Nome: </label>
                                <input type="text" class="form-control" id="nome" name="nome" required value="<?= $resultado['nm_cliente'] ?>">
                                <div class="invalid-feedback">
                                    <span> Campo obrigatório </span>
                                </div>
                            </div>
                        </div>

                        <!--Data de nascimento do cliente-->
                        <div class="col">
                            <div class="form-group">
                                <label for="data"> Data de nascimento: </label>
                                <input type="text" class="form-control" id="data" name="data" required  value="<?= date("d/m/Y", strtotime($resultado['dt_nascimento'])) ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackData"> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!--CPF-->
                        <div class="col">
                            <div class="form-group">
                                <label for="cpf"> CPF: </label>
                                <input type="text" class="form-control" id="cpf" name="cpf" readonly  value="<?= $resultado['id_cpf'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackCpf"> </span>
                                </div>
                            </div>
                        </div>

                        <!--Celular para contato de emergência-->
                        <div class="col">
                            <div class="form-group">
                                <label for="celular"> Celular: </label>
                                <input type="text" class="form-control" id="celular" name="celular" required  value="<?= $resultado['cd_celular'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackCelular"> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!--Email que será usado para login-->
                        <div class="col">
                            <div class="form-group">
                                <label for="email"> Email: </label>
                                <input type="text" class="form-control" id="email" name="email" required  value="<?= $resultado['nm_email'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackEmail"> </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div>
                        <div class="row text-right m-3">
                            <div class="col">
                                <a class="btn btn-outline-danger" href="../">Cancelar</a>
                                <input type="submit" class="btn btn-outline-success" name="salvar" value="Salvar" />
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </form>
    </div>
</div>

<script src="../../scripts/validaCpf.js"></script>
<script src="validacoesCliente.js"></script>

<?php include '../../footer.php'; ?>


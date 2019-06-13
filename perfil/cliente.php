<?php
$title = "PERFIL";

include '../header.php';

require '../conexao.php';

try {
    if ($_SESSION['tipo'] == 1) { // Se for do tipo cliente (1)
        $comando = $conexao->prepare("CALL buscarCliente(:id)");
    } else if ($_SESSION['tipo'] == 2) {
        ?>
        <script>
            window.location.href = 'motofretista.php';
        </script>
        <?php
    }else if ($_SESSION['tipo'] == 3) {
        ?>
        <script>
            window.location.href = 'admin.php';
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
    echo "Erro ao exibir perfil";
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
            <?php } ?>

            <?php if ($resultado = $comando->fetch()) { ?>
                <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" readonly value="<?= $resultado['nm_cliente'] ?>">
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Data de nascimento: </label>
                            <input type="text" class="form-control" id="data" readonly  value="<?= date("d/m/Y", strtotime($resultado['dt_nascimento'])) ?>">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--CPF-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cpf"> CPF: </label>
                            <input type="text" class="form-control" id="cpf" readonly  value="<?= $resultado['id_cpf'] ?>">
                        </div>
                    </div>

                    <!--Celular para contato de emergência-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular: </label>
                            <input type="text" class="form-control" id="celular" readonly  value="<?= $resultado['cd_celular'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" id="email" readonly  value="<?= $resultado['nm_email'] ?>">
                        </div>
                    </div>

                </div>

                <div>
                    <div class="row text-right m-3">
                        <div class="col">
                            <a class="btn btn-outline-info" href="editar/mudarSenha.php">Alterar senha</a>
                            <a class="btn btn-outline-warning" href="../perfil/editar/cliente.php">Editar</a>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>

    </div>
</div>

<script>
    //Formato das mascaras

    $("#celular").inputmask("(99)9999-9999[9]");
    $("#cpf").inputmask("999.999.999-99");

</script>
<?php include '../footer.php'; ?>


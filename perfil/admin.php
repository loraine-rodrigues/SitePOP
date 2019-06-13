<?php
$title = "PERFIL";

include '../header.php';

require '../conexao.php';

try {
    if ($_SESSION['tipo'] == 3) { // Se for do tipo cliente (1)
        $comando = $conexao->prepare("CALL buscarAdmin(:usuario)");
    } else if ($_SESSION['tipo'] == 2) {
        ?>
        <script>
            window.location.href = 'motofretista.php';
        </script>
        <?php
    }else if ($_SESSION['tipo'] == 1) {
        ?>
        <script>
            window.location.href = 'cliente.php';
        </script>
        <?php
    }

    $comando->bindParam(':usuario', $_SESSION['login']);

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
    <h1 class=" ml-5">PERFIL</h1>
    <div class="card mx-auto my-5 text-left" style="width: 54rem;">
        <div class="card-body">

            <?php
            if (isset($erro)) { //Mensagem de erro ?>
                <div class="alert alert-danger">
                    <?= $erro ?>
                </div>
            <?php } ?>

            <?php if ($resultado = $comando->fetch()) { ?>
                <h3 class="card-title mb-4">INFORMAÇÕES</h3>
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Usuário: </label>
                            <input type="text" class="form-control" id="nome" readonly value="<?= $resultado['nm_login'] ?>">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Nome: </label>
                            <input type="text" class="form-control" id="data" readonly  value="<?= $resultado['nm_usuario'] ?>">
                        </div>
                    </div>

                </div>

            <?php } else { ?>
                <div class="alert alert-danger">
                    <?= isset($erro) ? $erro : "Erro ao exibir perfil" ?>
                </div>
            <?php } ?>
        </div>

    </div>
</div>

<?php include '../footer.php'; ?>


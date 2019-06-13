<?php
$title = "ALTERAR SENHA";

include '../../header.php';

require '../../conexao.php';

include 'carregarFoto.php';

if (isset($_POST['alterar']) && $_SESSION['tipo'] == 2) {
    $foto = carregarFoto(uniqid());

    if ($foto != 'erro') {
        try {
            $comando = $conexao->prepare("CALL mudarFoto(:email, :urlFoto);");
            $comando->bindParam(':email', $_SESSION['login']);
            $comando->bindParam(':urlFoto', $foto);

            if ($comando->execute()) {
                if ($comando->rowCount() <= 0){
                    $erro = "Não foi possível realizar a alteração";
                } else {
                    if ($retorno = $comando->fetch()) {
                        // Deleta a foto anterior
                        unlink("../../image/motofretistas/" . $retorno['urlFoto']);
                    }
                    ?>
                    <script>
                        window.location.href = '../motofretista.php';
                    </script>
                    <?php
                }
            } else {
                $erro = "Não foi possível realizar a alteração";
            }
        }
        catch (PDOException $excecao) {
            echo "Erro ao realizar a alteração";
        }
    }
}

try {
    if ($_SESSION['tipo'] == 2) { // Se for do tipo motofretista (2)
        $comando = $conexao->prepare("CALL buscarMotofretistaPorUsuario(:usuario)");
    } else {
        ?>
        <script>
            window.location.href = 'cliente.php';
        </script>
        <?php
    }

    $comando->bindParam(':usuario', $_SESSION['login']);

    if ($comando->execute()) {
        if ($comando->rowCount() <= 0){
            $erro = "Foto não encontrado";
        }
    } else {
        $erro = "Não foi possível exibir sua foto no momento";
    }
} catch (PDOException $excecao) {
    $erro = "Erro ao exibir foto";
} ?>

<style>
    .btn-foto {
        position: relative;
        overflow: hidden;
    }
    .btn-foto input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-uploaded {
        width: 18em;
        height: 12em;
    }
</style>

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
            <?php } ?>

            <form enctype="multipart/form-data" method="post" id="form" class="needs-validation" novalidate>
                <h3 class="card-title mb-4">ALTERAR FOTO</h3>

                <?php if ($resultado = $comando->fetch()) { ?>

                <div class="col text-center">
                    <div class="form-group">
                        <img alt="Foto do perfil" id='img-uploaded' src="../../image/motofretistas/<?= $resultado['urlFoto'] ?>" class="rounded mb-2"/>
                        <div class="input-group mt-1">
                            <span class="input-group-btn">
                                <span class="btn btn-outline-primary btn-foto">
                                    Escolher uma foto... <input type="file" name="foto" id="img-input" required>
                                </span>
                            </span>
                            <input value="<?= $resultado['urlFoto'] ?>" id="img-text" type="text" class="form-control somenteLeitura" autocomplete="off" onmousedown="return false" required>
                            <div class="invalid-feedback">
                                <span> É necessário enviar uma foto </span>
                            </div>
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

                <?php } else { ?>
                    <div class="alert alert-success">
                        Erro ao exibir as informações
                    </div>
                <?php } ?>
            </form>

        </div>

    </div>
</div>

<script>
    $(document).ready( () => {
        //teste de script para pegar imagem
        $(".somenteLeitura").keydown(function (e) {
            e.preventDefault();
        });

        $(".somenteLeitura").bind('cut copy paste', function (e) {
            e.preventDefault();
        });

        $("#img-input").change(() => {
            var input = $('#img-input')[0];

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = (e) => {
                    var url = input.files[0].name.toLowerCase();
                    console.log(url);
                    if (url.endsWith("jpg") || url.endsWith("jpeg") || url.endsWith("png")) {
                        console.log(input.files[0].name);
                        $('#img-uploaded').attr('src', e.target.result);
                        $('#img-text').val(input.files[0].name);
                        $("#img-input").get(0).setCustomValidity('');
                    } else {
                        $("#img-input").get(0).setCustomValidity('Inválido');
                    }
                };

                reader.readAsDataURL(input.files[0]);
            }
        });   //fim do script de pegar imagem
    });
</script>

<?php include '../../footer.php'; ?>
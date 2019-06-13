<?php

$title = "PERFIL";

include '../header.php';

require '../conexao.php';

try {
    if ($_SESSION['tipo'] == 2) { // Se for do tipo motofretista (2)
        $comando = $conexao->prepare("CALL buscarMotofretistaPorUsuario(:usuario)");
    } else if ($_SESSION['tipo'] == 1) {
        ?>
        <script>
            window.location.href = 'cliente.php';
        </script>
        <?php
    }else if ($_SESSION['tipo'] == 3) {
        ?>
        <script>
            window.location.href = 'admin.php';
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
    $erro = "Erro ao exibir perfil";
} ?>

<!-- Imagem -->
<style>
    #img-uploaded {
        width: 18em;
        height: 12em;
    }
</style>

<div class="container text-center mb-5">
    <h1 class="font-weight-light"> PERFIL </h1>

    <div class="card m-auto text-left" style="width: 54rem;">

        <?php
        if (isset($erro)) { ?>

            <div class="card-body">
                <div class="alert alert-danger">
                    <?= $erro ?>
                </div>
            </div>

        <?php } else if ($resultado = $comando->fetch()) { ?>

            <div class="card-body">

                <h3 class="card-title mb-4">SEUS DADOS PESSOAIS</h3>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" readonly value="<?= $resultado['nm_motofretista'] ?>">
                        </div>

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                    <input type="date" class="form-control" id="data" readonly value="<?= $resultado['dt_nascimento'] ?>">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="genero">Gênero: </label>
                                    <input type="text" class="form-control" id="genero" readonly value="<?= $resultado['ic_genero'] ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="cnpj">CNPJ: </label>
                                    <input type="text" class="form-control" id="cnpj" readonly value="<?= $resultado['id_cnpj'] ?>">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="mei">Possui MEI? </label>
                                    <input type="text" class="form-control" id="mei" readonly value="<?= $resultado['ic_mei'] ?>">
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col text-center">
                        <div class="row">
                            <div class="col text-center">
                                <img alt="Foto do perfil" id='img-uploaded' src="../../image/motofretistas/<?= $resultado['urlFoto'] ?>" class="rounded mb-2"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <a class="btn btn-outline-primary" href="editar/mudarFoto.php">Mudar foto</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="cpf">CPF: </label>
                            <input type="text" class="form-control" id="cpf" readonly value="<?= $resultado['id_cpf'] ?>">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="cnh">CNH: </label>
                            <input type=text class="form-control" id="cnh" readonly value="<?= $resultado['id_cnh'] ?>">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col">
                        <label>Suas regiões de atuação:</label>
                        <ul>
                            <?php
                            $regioes = explode(',', $resultado['nm_regiao']);
                            foreach ($regioes as $regiao) {
                            ?>
                                <li><?= $regiao ?></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>

            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <div class="card-body">
                <h3 class="card-title mb-4">SEUS DADOS PARA CONTATO </h3>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular/WhatsApp: </label> <!--WhatsApp para contato-->
                            <input type="tel" class="form-control" id="celular" readonly value="<?= $resultado['id_celular'] ?>">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="celularAlternativo"> Celular: </label> <!--Celular para emergência-->
                            <input type="tel" class="form-control" name="celularAlternativo" id="celularAlternativo" readonly value="<?= $resultado['id_telefone'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" id="email" readonly value="<?= $resultado['nm_email'] ?>">
                        </div>
                    </div>

                </div>

            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <div class="card-body">
                <h3 class="card-title mb-4">DADOS DO SEU VEÍCULO</h3>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="marca"> Marca: </label>
                            <input type="text" class="form-control" id="marca" readonly  value="<?= $resultado['nm_marca'] ?>">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="modelo"> Modelo: </label>
                            <input type="text" class="form-control" id="modelo" readonly  value="<?= $resultado['nm_modelo'] ?>">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="cor"> Cor: </label>
                            <input type="text" class="form-control" id="cor" readonly  value="<?= $resultado['nm_cor'] ?>">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="placa"> Placa: </label>
                            <input type="text" class="form-control" id="placa" readonly  value="<?= $resultado['id_placa'] ?>">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="renavam"> Renavam: </label>
                            <input type="text" class="form-control" id="renavam" readonly  value="<?= $resultado['id_renavam'] ?>">
                        </div>
                    </div>

                </div>

                <div class="row text-right m-3">
                    <div class="col">
                        <a class="btn btn-outline-info" href="editar/mudarSenha.php">Alterar senha</a>
                        <a class="btn btn-outline-warning" href="../perfil/editar/motofretista.php">Editar</a>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>
</div>
<script>
    $(document).ready( function() {
        <!-- Mascaras -->

        $("#celular").inputmask("(99)9999-9999[9]");
        $("#celularAlternativo").inputmask("(99)9999-9999[9]");
        $("#cpf").inputmask("999.999.999-99");
        $("#cnpj").inputmask("99.999.999/9999-99");
        $("#placa").inputmask("AAA-9999");

    });
</script>

<?php include '../footer.php'; ?>


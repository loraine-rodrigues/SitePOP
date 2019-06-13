<?php

$title = "EDITAR PERFIL";

include '../../header.php';

require '../../conexao.php';

if (isset($_POST['salvar'])) {
    foreach ($_POST as $campo) {
        if (empty($campo)) {
            $erro = "É necessário preencher todos os campos";
        }
    }

        $nome = $_POST ['nome'];
    $data = $_POST ['data'];
    $genero = $_POST ['genero'];
    $celular = $_POST ['celular'];
    $celularAlternativo = $_POST ['celularAlternativo'];
    if (isset($_POST['regiao'])) {
        $regiao = implode(",", $_POST ['regiao']);
    } else {
        $erro = "Informe ao menos uma cidade para a região de atuação";
    }
    $cpf = $_POST ['cpf'];
    $cnpj = $_POST ['cnpj'];
    $mei = $_POST ['mei'];
    $cnh = $_POST ['cnh'];
    $email = $_POST ['email'];
    $marca = $_POST ['marca'];
    $modelo = $_POST ['modelo'];
    $cor = $_POST ['cor'];
    $placa = $_POST ['placa'];
    $renavam = $_POST ['renavam'];

    if (empty($erro)) {
        try {
            $comando = $conexao->prepare("CALL editarMotofretista(:id, :nome, :celular, :celularAlternativo, :email, :cpf, :cnpj, :cnh, :genero, :regiao, :data, :mei, :placa, :renavam, :modelo, :cor, :marca)");
            $comando->bindParam(':id', $_SESSION['id']);
            $comando->bindParam(':nome', $nome);
            $comando->bindParam(':data', $data);
            $comando->bindParam(':genero', $genero);
            $comando->bindParam(':celular', $celular);
            $comando->bindParam(':celularAlternativo', $celularAlternativo);
            $comando->bindValue(':regiao', $regiao);
            $comando->bindParam(':cpf', $cpf);
            $comando->bindParam(':cnpj', $cnpj);
            $comando->bindParam(':mei', $mei);
            $comando->bindParam(':cnh', $cnh);
            $comando->bindParam(':email', $email);
            $comando->bindParam(':marca', $marca);
            $comando->bindParam(':modelo', $modelo);
            $comando->bindParam(':cor', $cor);
            $comando->bindParam(':placa', $placa);
            $comando->bindParam(':renavam', $renavam);

            if ($comando->execute()) {
                $mensagem = "Alteração realizada com sucesso";
                $_SESSION['nome'] = $nome;
                $_SESSION['login'] = $email;
                ?>
                <script>
                    $("#nome_sessao").text("<?= $nome ?>")
                </script>
                <?php
            } else {
                $erro = "Não foi possível realizar alteração";
            }
        } catch (PDOException $e) {
            $erro = "Erro ao realizar alteração";
        }
    }
}

try {
    if ($_SESSION['tipo'] == 2) { // Se for do tipo motofretista (2)
        $comando = $conexao->prepare("CALL buscarMotofretistaPorUsuario(:usuario)");
    } else if ($_SESSION['tipo'] == 1) { // Se for do tipo cliente (1)
        ?>
        <script>
            window.location.href = 'cliente.php';
        </script>
        <?php
    } else { // Se for do tipo admin (3)
        ?>
        <script>
            window.location.href = 'admin.php';
        </script>
        <?php
    }

    $comando->bindParam(':usuario', $_SESSION['login']);

    if ($comando->execute()) {
        if ($comando->rowCount() <= 0) {
            $erro = "Perfil não encontrado";
        }
    } else {
        $erro = "Não foi possível exibir seu perfil no momento";
    }
} catch (PDOException $excecao) {
    echo "Erro ao exibir perfil";
} ?>

<!-- Imagem -->
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

<div class="container text-center mb-5">
    <h1 class="font-weight-light"> PERFIL </h1>

    <div class="card m-auto text-left" style="width: 54rem;">



            <form id="form" method="post" class="needs-validation" novalidate>

                <div class="card-body">

                    <?php if (isset($erro)) { ?>
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

                    <h3 class="card-title mb-4">SEUS DADOS PESSOAIS</h3>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nome"> Nome: </label>
                                <input type="text" class="form-control" id="nome" name="nome" required
                                       value="<?= $resultado['nm_motofretista'] ?>">
                                <div class="invalid-feedback">
                                    Campo obrigatório
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                        <input type="text" class="form-control" id="data" name="data" required
                                               value="<?= date("d/m/Y", strtotime($resultado['dt_nascimento'])) ?>">
                                        <div class="invalid-feedback">
                                            <span id="feedbackData"> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="genero">Gênero: </label>
                                        <select class="form-control" id="genero" name="genero" required>
                                            <option value="Masculino" <?= $resultado['ic_genero'] == "Masculino" ? "selected" : "" ?>>
                                                Masculino
                                            </option>
                                            <option value="Feminino" <?= $resultado['ic_genero'] == "Feminino" ? "selected" : "" ?>>
                                                Feminino
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Campo obrigatório
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="cnpj">CNPJ: </label>
                                        <input type="text" class="form-control" id="cnpj" name="cnpj" required
                                               value="<?= $resultado['id_cnpj'] ?>">
                                        <div class="invalid-feedback">
                                            <span id="feedbackCnpj"> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="mei">Possui MEI? </label>
                                        <select class="form-control" id="mei" name="mei" required>
                                            <option value="Sim" <?= $resultado['ic_mei'] == "Sim" ? "selected" : "" ?>>
                                                Sim
                                            </option>
                                            <option value="Não" <?= $resultado['ic_mei'] == "Não" ? "selected" : "" ?>>
                                                Não
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <span id="feedbackMei"> </span>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label for="cpf">CPF: </label>
                                <input type="text" class="form-control" id="cpf" name="cpf" required
                                       value="<?= $resultado['id_cpf'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackCpf"> </span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="cnh">CNH: </label>
                                <input type=text class="form-control" id="cnh" name="cnh" required
                                       value="<?= $resultado['id_cnh'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackCnh"> </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <?php
                    function checarRegiao($regioesString, $regiaoAChecar)
                    {
                        $regioes = explode(',', $regioesString);
                        foreach ($regioes as $regiao) {
                            if ($regiao == $regiaoAChecar) {
                                return true;
                            }
                        }
                        return false;
                    }

                    ?>

                    <div class="row">
                        <div class="col">
                            <label>Selecione sua região de atuação:</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="Bertioga"
                                       id="bertioga" <?= checarRegiao($resultado['nm_regiao'], "Bertioga") ? "checked" : "" ?>>
                                <label class="form-check-label" for="bertioga">
                                    Bertioga
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="Cubatão"
                                       id="cubatao" <?= checarRegiao($resultado['nm_regiao'], "Bertioga") ? "checked" : "" ?>>
                                <label class="form-check-label" for="cubatao">
                                    Cubatão
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="Guarujá"
                                       id="guaruja" <?= checarRegiao($resultado['nm_regiao'], "Guarujá") ? "checked" : "" ?>>
                                <label class="form-check-label" for="guaruja">
                                    Guarujá
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="Itanhaém"
                                       id="itanhaem" <?= checarRegiao($resultado['nm_regiao'], "Itanhaém") ? "checked" : "" ?>>
                                <label class="form-check-label" for="itanhaem">
                                    Itanhaém
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="Mongaguá"
                                       id="mongagua" <?= checarRegiao($resultado['nm_regiao'], "Mongaguá") ? "checked" : "" ?>>
                                <label class="form-check-label" for="mongagua">
                                    Mongaguá
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="Peruíbe"
                                       id="peruibe" <?= checarRegiao($resultado['nm_regiao'], "Peruíbe") ? "checked" : "" ?>>
                                <label class="form-check-label" for="peruibe">
                                    Peruíbe
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="Praia Grande"
                                       id="praiaGrande" <?= checarRegiao($resultado['nm_regiao'], "Praia Grande") ? "checked" : "" ?>>
                                <label class="form-check-label" for="praiaGrande">
                                    Praia Grande
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="Santos"
                                       id="santos" <?= checarRegiao($resultado['nm_regiao'], "Santos") ? "checked" : "" ?>>
                                <label class="form-check-label" for="santos">
                                    Santos
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="regiao[]" value="São Vicente"
                                       id="saoVicente" <?= checarRegiao($resultado['nm_regiao'], "São Vicente") ? "checked" : "" ?>>
                                <label class="form-check-label" for="saoVicente">
                                    São Vicente
                                </label>
                            </div>
                        </div>
                    </div>


                </div>

                <hr style="width: 100%; color: black; height: 1px; background-color:black;"/>

                <div class="card-body">
                    <h3 class="card-title mb-4">SEUS DADOS PARA CONTATO </h3>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label for="celular"> Celular/WhatsApp: </label> <!--WhatsApp para contato-->
                                <input type="tel" class="form-control" id="celular" name="celular" required
                                       value="<?= $resultado['id_celular'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackMei"> </span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="celularAlternativo"> Celular: </label> <!--Celular para emergência-->
                                <input type="tel" class="form-control" name="celularAlternativo" id="celularAlternativo"
                                       required value="<?= $resultado['id_telefone'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackCelularAlternativo"> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label for="email"> Email: </label>
                                <input type="text" class="form-control" id="email" name="email" required
                                       value="<?= $resultado['nm_email'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackEmail"> </span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <hr style="width: 100%; color: black; height: 1px; background-color:black;"/>

                <div class="card-body">
                    <h3 class="card-title mb-4">DADOS DO SEU VEÍCULO</h3>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label for="marca"> Marca: </label>
                                <input type="text" class="form-control" id="marca" name="marca" required
                                       value="<?= $resultado['nm_marca'] ?>">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="modelo"> Modelo: </label>
                                <input type="text" class="form-control" id="modelo" name="modelo" required
                                       value="<?= $resultado['nm_modelo'] ?>">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="cor"> Cor: </label>
                                <input type="text" class="form-control" id="cor" name="cor" required
                                       value="<?= $resultado['nm_cor'] ?>">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label for="placa"> Placa: </label>
                                <input type="text" class="form-control" id="placa" name="placa" required
                                       value="<?= $resultado['id_placa'] ?>">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="renavam"> Renavam: </label>
                                <input type="text" class="form-control" id="renavam" name="renavam" required
                                       value="<?= $resultado['id_renavam'] ?>">
                                <div class="invalid-feedback">
                                    <span id="feedbackRenavam"> </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row text-right m-3">
                        <div class="col">
                            <a class="btn btn-outline-danger" href="../">Cancelar</a>
                            <input type="submit" class="btn btn-outline-success" name="salvar" value="Salvar"/>
                        </div>
                    </div>


            </form>

        <?php } ?>

    </div>

</div>

<script src="/scripts/validaCpf.js"></script>
<script src="/scripts/validaCnh.js"></script>
<script src="/scripts/validaCnpj.js"></script>
<script src="/scripts/validaRenavam.js"></script>
<script src="validacoesMotofretista.js"></script>

<?php include '../../footer.php'; ?>


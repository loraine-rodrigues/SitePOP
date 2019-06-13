<?php

require "../../conexao.php";

if (isset($_POST['excluir'])) { //Se clicar no botão excluir entra no if
    try {
        $comando = $conexao->prepare("CALL desativarMotofretista(:id)"); //Prepara o comando para excluir motofretista
        $comando->bindParam(':id', $_GET['id']); //Coloca o id no comando

        if ($comando->execute()) {
            header('Location: index.php');//redireciona para index
            exit();     //Se excluir, finaiza a execução da pagina
        }
    } catch (PDOException $excecao) {
        $erro = "Erro ao excluir o motofretista" . $excecao->getMessage();
    }
}

//Redireciona p index se nao receber um valor ou se esse valor nao for numero
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

try {
    $comando = $conexao->prepare("CALL buscarMotofretista(:id)"); //prepara o comando para buscar motofretista pelo ID
    $comando->bindParam(':id', $_GET['id']);
    if ($comando->execute()) {
        if ($comando->rowCount() <= 0) {     //se o numero de linhas retornadas for igual a 0, redireciona p index
            header('Location: index.php');
            exit();
        }
    } else {
        $erro = "Não foi possível mostrar o motofretista";
    }
} catch (PDOException $excecao) {
    $erro = "Erro ao buscar o motofretista";
}

$title = "EXCLUIR MOTOFRETISTA";

include "../../header.php";

?>
    <style>
        #img-upload {
            width: 18em;
            height: 12em;
        }
    </style>

    <div class="container text-center">


        <h1 class="font-weight-light">EXCLUIR MOTOFRETISTA</h1>

        <!--Div usada para formartar o card de login -->
        <div class="card mx-auto my-5 text-left" style="width: 54rem;">

            <?php if (isset($erro)) { ?>

                <div class="card-body">
                    <div class="alert alert-danger">
                        <?= $erro ?>
                    </div>
                    <div class="col text-center">
                        <a href="index.php" class="btn btn-outline-primary mx-5"><i class="fas fa-chevron-left"></i>
                            Voltar</a> <!--Botão voltar-->
                    </div>
                </div>

            <?php } else if ($resultado = $comando->fetch()) { // tenta pegar o resultado ?>

                <form method="post">

                    <div class="card-body">

                        <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
                        <div class="row">
                            <div class="col">

                                <!--Id motofretista-->
                                <div class="form-group">
                                    <label for="id"> Id: </label>
                                    <input type="text" class="form-control" name="id" id="id"
                                           value="<?= $resultado['id_motofretista'] ?>" readonly>
                                </div>

                                <!--Nome motofretista-->
                                <div class="form-group">
                                    <label for="nome"> Nome: </label>
                                    <input type="text" class="form-control" name="nome" id="nome"
                                           value="<?= $resultado['nm_motofretista'] ?>" readonly>
                                </div>

                                <!--Email que será usado para login-->
                                <div class="form-group">
                                    <label for="email"> Email: </label>
                                    <input type="text" class="form-control" name="email" id="email"
                                           value="<?= $resultado['nm_email'] ?>" readonly>
                                </div>

                            </div>

                            <!--Adicionar foto-->
                            <div class="col text-center">
                                <div class="form-group">
                                    <img alt="Foto de perfil" id='img-upload'
                                         src="../../image/motofretistas/<?= $resultado['urlFoto'] ?>"
                                         class="rounded mb-2"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                    <input type="text" class="form-control" name="data" id="data"
                                           value="<?= $resultado['dt_nascimento'] ?>" readonly>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="genero">Gênero: </label>
                                    <input type="text" class="form-control" name="genero" id="genero"
                                           value="<?= $resultado['ic_genero'] ?>" readonly>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="celular"> Celular/WhatsApp: </label> <!--WhatsApp para contato-->
                                    <input type="tel" class="form-control" name="celular" id="celular"
                                           value="<?= $resultado['id_celular'] ?>" readonly>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="celularAlternativo"> Celular: </label> <!--Celular para emergência-->
                                    <input type="tel" class="form-control" name="celularAlternativo"
                                           id="celularAlternativo" value="<?= $resultado['id_telefone'] ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <!--Checkboxes para seleção de região-->
                        <div class="row">

                            <div class="col">
                                <label>Região de atuação:</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="container">
                                    <ul class="row">
                                        <?php
                                        $regioes = explode(",", $resultado['nm_regiao']);
                                        foreach ($regioes as $regiao) { ?>
                                            <div style="border-radius: 20px"
                                                 class="col-xs p-1 m-1 bg-light border"><?= $regiao ?></div>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!--Cpf para confirmar identidade-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="cpf">CPF: </label>
                                    <input type="text" class="form-control" name="cpf" id="cpf"
                                           value="<?= $resultado['id_cpf'] ?>" readonly>
                                </div>
                            </div>

                            <!--Cnpj para confirmar autonomia-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="cnpj">CNPJ: </label>
                                    <input type="text" class="form-control" name="cnpj" id="cnpj"
                                           value="<?= $resultado['id_cnpj'] ?>" readonly>
                                </div>
                            </div>

                            <!--Opção de sexo, usado um select para aparecer as duas opções-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="mei">Possui MEI? </label>
                                    <input type="text" class="form-control" name="mei" id="mei"
                                           value="<?= $resultado['ic_mei'] ?>" readonly>
                                </div>
                            </div>

                            <!--Númeração da cnh para cofirmar autorização p dirigir-->
                            <div class="col">
                                <div class="form-group">
                                    <label for="cnh">CNH: </label>
                                    <input type=text class="form-control" name="cnh" id="cnh"
                                           value="<?= $resultado['id_cnh'] ?>" readonly>
                                </div>
                            </div>

                        </div>

                    </div>

                    <hr style="width: 100%; color: black; height: 1px; background-color:black;"/>

                    <div class="card-body">
                        <h3 class="card-title mb-4">DADOS DO VEÍCULO</h3>
                        <div class="row">

                            <!-- Marca do veículo -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="marca"> Marca: </label>
                                    <input type="text" class="form-control" name="marca" id="marca"
                                           value="<?= $resultado['nm_marca'] ?>" readonly>
                                </div>
                            </div>

                            <!-- Modelo do veículo -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="modelo"> Modelo: </label>     <!--Email que será usado para login-->
                                    <input type="text" class="form-control" name="modelo" id="modelo"
                                           value="<?= $resultado['nm_modelo'] ?>" readonly>
                                </div>
                            </div>

                            <!-- Cor do veículo -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="cor"> Cor: </label>
                                    <input type="text" class="form-control" name="cor" id="cor"
                                           value="<?= $resultado['nm_cor'] ?>" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Placa do veículo -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="placa"> Placa: </label>
                                    <input type="text" class="form-control" name="placa" id="placa"
                                           value="<?= $resultado['id_placa'] ?>" readonly>
                                </div>
                            </div>

                            <!-- Renavam do veículo -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="renavam"> Renavam: </label>
                                    <input type="text" class="form-control" name="renavam" id="renavam"
                                           value="<?= $resultado['id_renavam'] ?>" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-5">

                            <!-- Botão voltar-->
                            <div class="col">
                                <a href="index.php" class="btn btn-outline-warning float-left mx-5"><i
                                            class="fas fa-chevron-left"></i> Voltar</a> <!--Botão voltar-->
                            </div>

                            <!-- Botão de excluir cadastro-->
                            <div class="col">
                                <button type="submit" name="excluir" class="btn btn-outline-danger float-right mx-5">
                                    Excluir <i class="fas fa-times"></i></button> <!--Botão excluir-->
                            </div>

                        </div>

                    </div>

                </form>

            <?php } ?>

        </div>

    </div>

<?php
include "../../footer.php";
?>
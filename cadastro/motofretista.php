<?php
$title = "CADASTRO MOTOFRETISTA";

require '../conexao.php';

include '../header.php';

include 'carregarFoto.php';

if (isset($_POST['salvar'])) {
    foreach ($_POST as $campo) {
        if (empty($campo)) {
            $erro = "É necessário preencher todos os campos";
        }
    }

    if (empty($erro)) {
        $nome = $_POST ['nome'];
        $data = $_POST ['data'];
        $genero = $_POST ['genero'];
        $celular = $_POST ['celular'];
        $celularAlternativo = $_POST ['celularAlternativo'];
        if (isset($_POST['regiao'])) {
            $regiao = implode(",", $_POST ['regiao']);
        }
        else {
            $erro = "Informe ao menos uma cidade para atuar!";
        }
        $cpf = $_POST ['cpf'];
        $cnpj = $_POST ['cnpj'];
        $mei = $_POST ['mei'];
        $cnh = $_POST ['cnh'];
        $termos = $_POST ['termos'];
        $email = $_POST ['email'];
        $senha = $_POST ['senha'];
        $confirmarSenha = $_POST ['confirmarSenha'];
        if ($senha != $confirmarSenha) {
            $erro = 'As senhas estão diferentes';
        }
        $marca = $_POST ['marca'];
        $modelo = $_POST ['modelo'];
        $cor = $_POST ['cor'];
        $placa = $_POST ['placa'];
        $renavam = $_POST ['renavam'];

        try {
            $foto = carregarFoto(uniqid());

            if ($foto != 'erro') {
                $comando = $conexao->prepare("CALL cadastrarMotofretista(:nome, :celular, :celularAlternativo, :email, :cpf, :cnpj, :cnh, :genero, :regiao, :data, :mei, :placa, :renavam, :modelo, :cor, :marca, :senha, :foto)");
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
                $comando->bindParam(':senha', $senha);
                $comando->bindParam(':marca', $marca);
                $comando->bindParam(':modelo', $modelo);
                $comando->bindParam(':cor', $cor);
                $comando->bindParam(':placa', $placa);
                $comando->bindParam(':renavam', $renavam);
                $comando->bindParam(':foto', $foto);
                $comando->execute();

                $mensagem = "Motofretista cadastrado com sucesso<br/>Clique <a href='../home.php'>aqui</a> para efetuar login";
            } else {
                $erro = 'Não foi possível realizador o cadastro';
            }
        }
        catch (PDOException $excecao) {
            $erro = "Erro ao cadastrar";
        }
    }
}
?>

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

<div class="container text-center">
    <h1 class=" ml-5">CADASTRO MOTOFRETISTA</h1>
    <form enctype="multipart/form-data" method="post" id="form" class="needs-validation" novalidate>

        <!--Div usada para formartar o card de login -->
        <div class="card mx-auto my-5 text-left" style="width: 54rem;">
            <div class="card-body">
                <?php
                if (isset($erro)):     //Mensagem de erro no cadastro
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $erro; ?>
                    </div>
                <?php
                endif;
                ?>

                <?php
                if (isset($mensagem)):   //Mensagem de sucesso no cadastro
                    ?>
                    <div class="alert alert-success">
                        <?php echo $mensagem; ?>
                    </div>
                <?php
                endif;
                ?>

                <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
                <div class="row">

                    <!--Nome motofretista-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe seu nome completo">
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                    <input type="text" class="form-control" name="data" id="data" placeholder="Informe sua data de nascimento" required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackData"> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="genero">Gênero: </label>
                                    <select class="form-control" name="genero" id="genero" required> <!--Opção de sexo, usado um select para aparecer as duas opções-->
                                        <option value=""> Selecione </option>
                                        <option> Masculino </option>
                                        <option> Feminino </option>
                                        <option> Outro </option>
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
                                    <label for="celular"> Celular/WhatsApp: </label> <!--WhatsApp para contato-->
                                    <input type="tel" class="form-control" name="celular" id="celular" placeholder="Celular para contato" required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackCelular"> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="celularAlternativo"> Celular: </label> <!--Celular para emergência-->
                                    <input type="tel" class="form-control" name="celularAlternativo" id="celularAlternativo" placeholder="Celular alternativo" required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackCelularAlternativo"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!--Adicionar foto-->
                    <div class="col text-center">
                        <div class="form-group">
                            <img id='img-uploaded' src="../image/avatar.svg" class="rounded mb-2"/>
                            <div class="input-group mt-1">
                                    <span class="input-group-btn">
                                        <span class="btn btn-outline-primary btn-foto">
                                            Escolher uma foto... <input type="file" name="foto" id="img-input" required>
                                        </span>
                                    </span>
                                <input id="img-text" type="text" class="form-control somenteLeitura" autocomplete="off" onmousedown="return false" required>
                                <div class="invalid-feedback">
                                    <span> É necessário enviar uma foto </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Checkboxes para seleção de região-->
                <div class="row">
                    <div class="col">
                        <label>Selecione sua região de atuação:</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Bertioga" id="bertioga" >
                            <label class="form-check-label" for="bertioga">
                                Bertioga
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Cubatão" id="cubatao" >
                            <label class="form-check-label" for="cubatao">
                                Cubatão
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Guarujá" id="guaruja" >
                            <label class="form-check-label" for="guaruja">
                                Guarujá
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Itanhaém" id="itanhaem" >
                            <label class="form-check-label" for="itanhaem">
                                Itanhaém
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Mongaguá" id="mongagua" >
                            <label class="form-check-label" for="mongagua">
                                Mongaguá
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Peruíbe" id="peruibe" >
                            <label class="form-check-label" for="peruibe">
                                Peruíbe
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Praia Grande" id="praiaGrande" >
                            <label class="form-check-label" for="praiaGrande">
                                Praia Grande
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Santos" id="santos" >
                            <label class="form-check-label" for="santos">
                                Santos
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="São Vicente" id="saoVicente">
                            <label class="form-check-label" for="saoVicente">
                                São Vicente
                            </label>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!--Cpf para confirmar identidade-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cpf">CPF: </label>
                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Informe seu cpf" required>
                            <div class="invalid-feedback">
                                <span id="feedbackCpf"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Cnpj para confirmar autonomia-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cnpj">CNPJ: </label>
                            <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="Informe seu cpf" required>
                            <div class="invalid-feedback">
                                <span id="feedbackCnpj"> </span>
                            </div>
                        </div>
                    </div>

                    <!-- Opção de MEI, usado um select para aparecer as opções -->
                    <div class="col">
                        <div class="form-group">
                            <label for="mei">Possui MEI? </label>
                            <select class="form-control" name="mei" id="mei" required>
                                <option value=""> Selecione </option>
                                <option value="Sim"> SIM </option>
                                <option value="Não"> NÃO </option>
                            </select>
                            <div class="invalid-feedback">
                                <span id="feedbackMei"> </span>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de alerta MEI -->
                    <div class="modal fade" tabindex="-1" id="modalMei" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                            <div class="modal-content">

                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title text-white">Alerta</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    É necessário possuir MEI para efetuar cadastro
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Númeração da cnh para cofirmar autorização p dirigir-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cnh">CNH: </label>
                            <input type=text class="form-control" name="cnh" id="cnh" placeholder="Informe o número da cnh" required>
                            <div class="invalid-feedback">
                                <span id="feedbackCnh"> </span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Informe seu email para login" required>
                            <div class="invalid-feedback">
                                <span id="feedbackEmail"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Escolha uma senha que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Informe uma senha para login" required>
                            <div class="invalid-feedback">
                                <span id="feedbackSenha"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Confirme a senha que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="confirmarSenha"> Confirmar senha: </label>
                            <input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" placeholder="Informe uma senha para login" required>
                            <div class="invalid-feedback">
                                <span id="feedbackConfirmarSenha"> </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <div class="card-body">
                <h3 class="card-title mb-4">DADOS DO VEÍCULO</h3>
                <div class="row">

                    <!-- Marca do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="marca"> Marca: </label>
                            <input type="text" class="form-control" name="marca" id="marca" placeholder="Informe a marca do veiculo" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>

                    <!-- Modelo do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="modelo"> Modelo: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Informe o modelo do veículo" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>

                    <!-- Cor do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="cor"> Cor: </label>
                            <input type="text" class="form-control" name="cor" id="cor" placeholder="Informe a cor do veiculo" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Placa do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="placa"> Placa: </label>
                            <input type="text" class="form-control" name="placa" id="placa" placeholder="Informe a placa do veiculo" required>
                            <div class="invalid-feedback">
                                <span id="feedbackPlaca"> </span>
                            </div>
                        </div>
                    </div>

                    <!-- Renavam do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="renavam"> Renavam: </label>
                            <input type="text" class="form-control" name="renavam" id="renavam" placeholder="Informe o número do renavam" required>
                            <div class="invalid-feedback">
                                <span id="feedbackRenavam"> </span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-5">

                    <!-- Termos de uso -->
                    <div class="col">
                        <div class="form-group form-check">
                            <input type="checkbox" name="termos" value="true" class="form-check-input" id="checkTermos" required>
                            <label for="termos">Eu li e aceito os </label>
                            <label class="form-check-label" for="checkTermos"><a href="#" data-toggle="modal" data-target="#modal">termos de uso</a></label>
                            <div class="invalid-feedback">
                                É necessário aceitar os termos de uso
                            </div>
                        </div>
                    </div>

                    <!-- Botão confirmar -->
                    <div class="col">
                        <input type="submit" name="salvar" value="Confirmar" class="btn btn-outline-success float-right mx-5"> <!--Botão entrar-->
                    </div>

                </div>

            </div>
        </div>
    </form>
</div>


<script src="/scripts/validaCnh.js"></script>
<script src="/scripts/validaCpf.js"></script>
<script src="/scripts/validaCnpj.js"></script>
<script src="/scripts/validaRenavam.js"></script>
<script src="validacoesMotofretista.js"></script>


<?php
include 'modalTermos.php';
include '../footer.php';
?>

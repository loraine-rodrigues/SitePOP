<?php
$title = "CADASTRO MOTOFRETISTA";

require '../conexao.php';

include '../header.php';

if (isset($_POST['confirmarCadastro'])) {
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

    if ($senha == $confirmarSenha && $termos == TRUE && !isset($erro)) {
        try {
            $comando = $conexao->prepare("CALL cadastrarMotofretista(:nome, :celular, :celularAlternativo, :email, :cpf, :cnpj, :cnh, :genero, :regiao, :data, :mei, :placa, :renavam, :modelo, :cor, :marca, :senha)");
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
            $comando->execute();

            $mensagem = "Motofretista cadastrado com sucesso<br/>Clique <a href='../index.php'>aqui</a> para efetuar login";
        }
        catch (PDOException $excecao) {
            $erro = "Erro ao cadastrar";
        }
    }
}
?>

<!-- Imagem -->
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
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

    #img-upload {
        width: 18em;
        height: 12em;
    }
</style>

<div class="container text-center">
    <h1 class="font-weight-light text-white mb-5">CADASTRO MOTOFRETISTA</h1>
    <form method="post">

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
                if (isset($mensagem)):   //Mensagem de sucessp no cadastro
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
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe seu nome completo" required>
                        </div>

                        <div class="row">
                             <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                    <input type="text" class="form-control" name="data" id="data" placeholder="Informe sua data de nascimento" required>
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
                                </div>
                             </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="celular"> Celular/WhatsApp: </label> <!--WhatsApp para contato-->
                                    <input type="tel" class="form-control" name="celular" id="celular" placeholder="Celular para contato" required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="celularAlternativo"> Celular: </label> <!--Celular para emergência-->
                                    <input type="tel" class="form-control" name="celularAlternativo" id="celularAlternativo" placeholder="Celular alternativo" required>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!--Adicionar foto-->
                    <div class="col text-center">
                        <div class="form-group">
                            <img id='img-upload' src="../avatar.svg" class="rounded mb-2"/>
                            <div class="input-group mt-1">
                                <span class="input-group-btn">
                                    <span class="btn btn-outline-primary btn-file">
                                        Escolher uma foto... <input type="file" id="imgInp">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
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
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Bertioga" id="defaultCheck1" >
                            <label class="form-check-label" for="defaultCheck1">
                                Bertioga
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Cubatão" id="defaultCheck2" >
                            <label class="form-check-label" for="defaultCheck2">
                                Cubatão
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Guarujá" id="defaultCheck1" >
                            <label class="form-check-label" for="defaultCheck1">
                                Guarujá
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Itanhaém" id="defaultCheck2" >
                            <label class="form-check-label" for="defaultCheck2">
                                Itanhaém
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Mongaguá" id="defaultCheck1" >
                            <label class="form-check-label" for="defaultCheck1">
                                Mongaguá
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Peruíbe" id="defaultCheck2" >
                            <label class="form-check-label" for="defaultCheck2">
                                Peruíbe
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Praia Grande" id="defaultCheck1" >
                            <label class="form-check-label" for="defaultCheck1">
                                Praia Grande
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="Santos" id="defaultCheck2" >
                            <label class="form-check-label" for="defaultCheck2">
                                Santos
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="regiao[]" value="São Vicente" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
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
                            </div>
                    </div>

                    <!--Cnpj para confirmar autonomia-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cnpj">CNPJ: </label>
                            <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="Informe seu cpf" required>
                        </div>
                    </div>

                    <!--Opção de sexo, usado um select para aparecer as duas opções-->
                    <div class="col">
                        <div class="form-group">
                            <label for="mei">Possui MEI? </label>
                            <select class="form-control" name="mei" id="mei" required>
                                <option value=""> Selecione </option>
                                <option value="Sim"> SIM </option>
                                <option value="Não"> NÃO </option>
                            </select>
                        </div>
                    </div>

                    <!--Númeração da cnh para cofirmar autorização p dirigir-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cnh">CNH: </label>
                            <input type=text class="form-control" name="cnh" id="cnh" placeholder="Informe o número da cnh" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Informe seu email para login" required>
                        </div>
                    </div>

                    <!--Escolha uma senha que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Informe uma senha para login" required>
                        </div>
                    </div>

                    <!--Confirme a senha que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="confirmarSenha"> Confirmar senha: </label>
                            <input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" placeholder="Informe uma senha para login" required>
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
                            </div>
                        </div>

                        <!-- Modelo do veículo -->
                        <div class="col">
                            <div class="form-group">
                                <label for="modelo"> Modelo: </label>     <!--Email que será usado para login-->
                                <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Informe o modelo do veículo" required>
                            </div>
                        </div>

                        <!-- Cor do veículo -->
                        <div class="col">
                            <div class="form-group">
                                <label for="cor"> Cor: </label>
                                <input type="text" class="form-control" name="cor" id="cor" placeholder="Informe a cor do veiculo" required>
                            </div>
                        </div>

                    </div>

                <div class="row">

                    <!-- Placa do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="placa"> Placa: </label>
                            <input type="text" class="form-control" name="placa" id="placa" placeholder="Informe a placa do veiculo" required>
                        </div>
                    </div>

                    <!-- Renavam do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="renavam"> Renavam: </label>
                            <input type="text" class="form-control" name="renavam" id="renavam" placeholder="Informe o número do renavam" required>
                        </div>
                    </div>



                </div>

                <div class="row mt-5">

                    <!-- Termos de uso -->
                    <div class="col">
                        <div class="form-group form-check">
                            <input type="checkbox" name="termos" value="true" class="form-check-input" id="checkTermo" required>
                            <label class="form-check-label" for="checkTermo"><a href="../termos.php">Ler termos de uso</a></label>
                        </div>
                    </div>

                    <!-- Botão confirmar -->
                    <div class="col">
                        <button type="submit" name="confirmarCadastro" class="btn btn-outline-success float-right mx-5">Confirmar </button> <!--Botão entrar-->
                    </div>

                </div>

            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready( function() {
        //teste de script para pegar imagem

        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });   //fim do script de pegar imagem


        <!-- Máscaras dos inputs -->

        $("#celular").inputmask("(99)9999-9999[9]", {removeMaskOnSubmit: true, clearIncomplete: true});
        $("#celularAlternativo").inputmask("(99)9999-9999[9]", {removeMaskOnSubmit: true, clearIncomplete: true});
        $("#cpf").inputmask("999.999.999-99", {removeMaskOnSubmit: true, clearIncomplete: true});
        $("#cnpj").inputmask("99.999.999/9999-99", {removeMaskOnSubmit: true, clearIncomplete: true});
        $("#cnh").inputmask("99999999999", { clearIncomplete: true});
        $("#renavam").inputmask("99999999999", { clearIncomplete: true});
        $("#placa").inputmask("AAA-9999", {removeMaskOnSubmit: true, clearIncomplete: true});
        $("#email").inputmask("email", { clearIncomplete: true});
        $("#nome").inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});
        $("#data").inputmask("datetime", {inputFormat: "dd/mm/yyyy", max: "01/01/1998", outputFormat: "yyyy-mm-dd", removeMaskOnSubmit: true});
        $("#marca").inputmask({regex: "[a-zà-úA-ZÀ-Ú- ]*", placeholder: ""});
        $("#modelo").inputmask({regex: "[a-zà-úA-ZÀ-Ú0-9- ]*", placeholder: ""});
        $("#cor").inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});



    });
</script>

<?php include '../footer.php' ?>


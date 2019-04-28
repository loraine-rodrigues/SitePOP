<?php
$title = "CADASTRO MOTOFRETISTA";

include '../header.php';
require '../conexao.php';

if (isset($_POST['confirmarCadastro'])) {
    $nome = $_POST ['nome'];
    $cel = $_POST ['cel'];
    $tel = $_POST ['tel'];
    $email = $_POST ['email'];
    $cpf = $_POST ['cpf'];
    $cnpj = $_POST ['cnpj'];
    $cnh = $_POST ['cnh'];
    $genero = $_POST ['genero'];
    $regiao = $_POST ['regiao'];
    $nasc = $_POST ['nasc'];

    $mei = $_POST ['mei'];
   
    $placa = $_POST ['placa'];
    $renavam = $_POST ['renavam'];
    $modelo = $_POST ['modelo'];
    $cor = $_POST ['cor'];
    $marca = $_POST ['marca'];
    $senha = $_POST ['senha'];
    $confirmarSenha = $_POST ['confirmarSenha'];   

    $termos = $_POST ['termos'];

    if ($senha == $confirmarSenha && $termos == TRUE) {
        try {
            $comando = $conexao->prepare("CALL cadastrarMotofretista(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $comando->bindParam(1, $nome);
            $comando->bindParam(2, $cel);
            $comando->bindParam(3, $tel);
            $comando->bindParam(4, $email);
            $comando->bindParam(5, $cpf);
            $comando->bindParam(6, $cnpj);

            $comando->bindParam(7, $cnh);
            $comando->bindParam(8, $genero);
            $comando->bindParam(9, $regiao);
            $comando->bindParam(10, $nasc);
            $comando->bindParam(11, $mei);
            $comando->bindParam(12, $placa);

            $comando->bindParam(13, $renavam);
            $comando->bindParam(14, $modelo);
            $comando->bindParam(15, $cor);
            $comando->bindParam(16, $marca);
            $comando->bindParam(17, $senha);
          

            $comando->execute();

            echo "Motofretista cadastrado!";
        }
        catch (PDOException $excecao) {
            echo "Erro ao cadastrar motofretista: " . $excecao->getMessage();
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
    <h1 class="font-weight-light text-white">CADASTRO MOTOFRETISTA</h1>
    <br>
    <form>

        <!--Div usada para formartar o card de login -->
        <div class="card m-auto text-left" style="width: 54rem;">
            <div class="card-body">
                <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
                <div class="row">

                    <!--Nome motofretista-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe seu nome completo">
                        </div>

                        <div class="row">
                             <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                    <input type="date" class="form-control" name="nasc" id="data" placeholder="Informe sua data de nascimento">
                                </div>
                             </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="sexo">Gênero: </label>
                                    <select class="form-control" name="genero" id="sexo"> <!--Opção de sexo, usado um select para aparecer as duas opções-->
                                        <option> Selecione </option>
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
                                    <input type="tel" class="form-control" name="cel" id="celular" placeholder="Celular para contato">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="celularAlternativo"> Celular: </label> <!--Celular para emergência-->
                                    <input type="tel" class="form-control" name="tel" id="celularAlternativo" placeholder="Celular alternativo">
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

                <div class="row">

                    <!--Cpf para confirmar identidade-->
                    <div class="col">
                            <div class="form-group">
                                <label for="cpf">CPF: </label>
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Informe seu cpf">
                            </div>
                    </div>

                    <!--Cnpj para confirmar autonomia-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cnpj">CNPJ: </label>
                            <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="Informe seu cpf">
                        </div>
                    </div>

                    <!--Opção de sexo, usado um select para aparecer as duas opções-->
                    <div class="col">
                        <div class="form-group">
                            <label for="sexo">Possui MEI? </label>
                            <select class="form-control" name="mei" id="mei">
                                <option> Selecione </option>
                                <option> SIM </option>
                                <option> NÃO </option>
                            </select>
                        </div>
                    </div>

                    <!--Númeração da cnh para cofirmar autorização p dirigir-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cnh">CNH: </label>
                            <input type=text class="form-control" name="cnh" id="cnh" placeholder="Informe o número da cnh">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Informe seu email para login">
                        </div>
                    </div>

                    <!--Escolha uma senha que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Informe uma senha para login">
                        </div>
                    </div>

                    <!--Confirme a senha que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Confirmar senha: </label>
                            <input type="password" class="form-control" name="confirmarSenha" id="senha" placeholder="Informe uma senha para login">
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
                            <input type="text" class="form-control" name="marca" id="marca" placeholder="Informe a marca do veiculo">
                        </div>
                    </div>

                     <!-- Modelo do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="modelo"> Modelo: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Informe o modelo do veículo">
                        </div>
                    </div>

                     <!-- Cor do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="cor"> Cor: </label>
                            <input type="text" class="form-control" name="cor" id="cor" placeholder="Informe a cor do veiculo">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Placa do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="placa"> Placa: </label>
                            <input type="text" class="form-control" name="placa" id="placa" placeholder="Informe a placa do veiculo">
                        </div>
                    </div>

                    <!-- Renavam do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="renavam"> Renavam: </label>
                            <input type="text" class="form-control" name="renavam" id="renavam" placeholder="Informe o número do renavam">
                        </div>
                    </div>

                    <!-- UF do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="renavam"> UF: </label>
                            <input type="text" class="form-control" id="renavam" placeholder="Digite a UF do veículo">
                        </div>
                    </div>

                </div>

                <div class="row mt-5">

                    <!-- Termos de uso -->
                    <div class="col">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="checkTermo">
                            <label class="form-check-label" for="checkTermo"><a href="../termos.php">Ler termos de uso</a></label>
                        </div>
                    </div>

                    <!-- Botão confirmar -->
                    <div class="col">
                        <button type="submit" class="btn btn-outline-success float-right mx-5">Confirmar </button> <!--Botão entrar-->
                    </div>

                </div>

            </div>
        </div>
    </form>
    <br>
</div>

<script>
    $(document).ready( function() {
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
        });
    });
</script>

<?php include '../footer.php' ?>


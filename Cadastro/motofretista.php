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
            echo $excecao->getMessage();
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
    <form method="post" id="form" class="needs-validation" novalidate>

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

                    <!--Opção de sexo, usado um select para aparecer as duas opções-->
                    <div class="col">
                        <div class="form-group">
                            <label for="mei">Possui MEI? </label>
                            <select class="form-control" name="mei" id="mei" required>
                                <option value=""> Selecione </option>
                                <option value="Sim"> SIM </option>
                                <option value="Não"> NÃO </option>
                            </select>
                            <div class="invalid-feedback">
                                Escolha uma da opções
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
                            <input type="checkbox" name="termos" value="true" class="form-check-input" id="checkTermo" required>
                            <label for="termos">Eu li e aceito os </label>
                            <label class="form-check-label" for="checkTermos"><a href="../termos.php">termos de uso</a></label>
                            <div class="invalid-feedback">
                                É necessário aceitar os termos de uso
                            </div>
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
    $(document).ready( () => {
        //teste de script para pegar imagem

        $(document).on('change', '.btn-file :file', () => {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', (event, label) => {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
        var readURL = (input) => {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = (e) => {
                    $('#img-upload').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(() => {
            readURL(this);
        });   //fim do script de pegar imagem

        var form = $("#form");
        var nome = $("#nome");
        var data = $("#data");
        var genero = $("#genero");
        var celular = $("#celular");
        var celularAlternativo = $("#celularAlternativo");
        var cpf = $("#cpf");
        var cnpj = $("#cnpj");
        var mei = $("#mei");
        var cnh = $("#cnh");
        var email = $("#email");
        var senha = $("#senha");
        var feedbackSenha = $("#feedbackSenha");
        var confirmarSenha = $("#confirmarSenha");
        var feedbackConfirmarSenha = $("#feedbackConfirmarSenha");
        var marca = $("#marca");
        var modelo = $("#modelo");
        var cor = $("#cor");
        var placa = $("#placa");
        var renavam = $("#renavam");

        //Validação ao digitar no campo

        nome.keyup(() => {
            if (nome.val().length > 0) {
                nome.get(0).setCustomValidity('');
            } else {
                nome.get(0).setCustomValidity('Inválido');
            }
        });

        data.keyup(() => {
            data = $("#data");
            var feedbackData = $("#feedbackData");
            if (data.val().length > 0) {
                if (Inputmask.isValid(data.val(), {alias: "datetime", inputFormat: "dd/mm/yyyy"})) {
                    data.get(0).setCustomValidity('');
                    feedbackData.text("");
                } else {
                    feedbackData.text("Digite uma data válida");
                    data.get(0).setCustomValidity('Inválido');
                }
            } else{
                feedbackData.text("Campo obrigatório");
                data.get(0).setCustomValidity('Inválido');
            }
        });

        cpf.keyup(() => {
            cpf = $("#cpf");
            var feedbackCpf = $("#feedbackCpf");
            if (cpf.val().length > 0) {
                if (validarCPF(cpf.val())) {
                    cpf.get(0).setCustomValidity('');
                    feedbackCpf.text("");
                } else {
                    feedbackCpf.text("Digite um CPF válido");
                    cpf.get(0).setCustomValidity('Inválido');
                }
            } else{
                feedbackCpf.text("Campo obrigatório");
                cpf.get(0).setCustomValidity('Inválido');
            }
        });

        cnpj.keyup(() => {
            cnpj = $("#cnpj");
            if (validarCPF(cnpj.val())) {
                cnpj.get(0).setCustomValidity('');
            } else {
                cnpj.get(0).setCustomValidity('Inválido');
            }
        });

        cnh.keyup(() => {
            cnh = $("#cnh");
            if (validarCPF(cnh.val())) {
                cnh.get(0).setCustomValidity('');
            } else {
                cnh.get(0).setCustomValidity('Inválido');
            }
        });

        celular.keyup(() => {
            celular = $("#celular");
            var feedbackCelular = $("#feedbackCelular");
            if (celular.val().length > 0) {
                if (Inputmask.isValid(celular.val(), "(99)9999-9999[9]")) {
                    celular.get(0).setCustomValidity('');
                    feedbackCelular.text("");
                } else {
                    feedbackCelular.text("Digite um celular válido");
                    celular.get(0).setCustomValidity('Inválido');
                }
            } else{
                feedbackCelular.text("Campo obrigatório");
                celular.get(0).setCustomValidity('Inválido');
            }
        });

        celularAlternativo.keyup(() => {
            celularAlternativo = $("#celularAlternativo");
            var feedbackCelularAlternativo = $("#feedbackCelularAlternativo");
            if (celularAlternativo.val().length > 0) {
                if (Inputmask.isValid(celularAlternativo.val(), "(99)9999-9999[9]")) {
                    celularAlternativo.get(0).setCustomValidity('');
                    feedbackCelularAlternativo.text("");
                } else {
                    feedbackCelularAlternativo.text("Digite um celular válido");
                    celularAlternativo.get(0).setCustomValidity('Inválido');
                }
            } else{
                feedbackCelularAlternativo.text("Campo obrigatório");
                celularAlternativo.get(0).setCustomValidity('Inválido');
            }
        });

        email.keyup(() => {
            email = $("#email");
            var feedbackEmail = $("#feedbackEmail");
            if (email.val().length > 0) {
                if (Inputmask.isValid(email.val(), {alias: "email"})) {
                    email.get(0).setCustomValidity('');
                    feedbackEmail.text("");
                } else {
                    email.get(0).setCustomValidity('Inválido');
                    feedbackEmail.text("Digite um email válido");
                }
            } else {
                feedbackEmail.text("Campo obrigatório");
                email.get(0).setCustomValidity('Inválido');
            }
        });

        senha.keyup(() => {
            senha = $("#senha");
            confirmarSenha = $("#confirmarSenha");
            feedbackSenha = $("#feedbackSenha");
            feedbackConfirmarSenha = $("#feedbackConfirmarSenha");
            if (senha.val().length > 0) {
                feedbackSenha.text("");
                if (senha.val() === confirmarSenha.val()) {
                    senha.get(0).setCustomValidity('');
                    confirmarSenha.get(0).setCustomValidity('');
                    feedbackConfirmarSenha.text("");
                } else {
                    senha.get(0).setCustomValidity('Inválido');
                    confirmarSenha.get(0).setCustomValidity('Inválida');
                    feedbackConfirmarSenha.text("Senhas não conferem");
                }
            } else {
                senha.get(0).setCustomValidity('Inválido');
                confirmarSenha.get(0).setCustomValidity('Inválida');
                feedbackSenha.text("Campo obrigatório");
            }
        });

        confirmarSenha.keyup(() => {
            senha = $("#senha");
            confirmarSenha = $("#confirmarSenha");
            feedbackSenha = $("#feedbackSenha");
            feedbackConfirmarSenha = $("#feedbackConfirmarSenha");
            if (confirmarSenha.val().length > 0) {
                if (senha.val() === confirmarSenha.val()) {
                    senha.get(0).setCustomValidity('');
                    confirmarSenha.get(0).setCustomValidity('');
                    feedbackConfirmarSenha.text("");
                } else {
                    senha.get(0).setCustomValidity('Inválido');
                    confirmarSenha.get(0).setCustomValidity('Inválida');
                    feedbackConfirmarSenha.text("Senhas não conferem");
                }
            } else {
                senha.get(0).setCustomValidity('Inválido');
                confirmarSenha.get(0).setCustomValidity('Inválida');
                feedbackConfirmarSenha.text("Este campo é obrigatório");
            }
        });

        marca.keyup(() => {
            if (marca.val().length > 0) {
                marca.get(0).setCustomValidity('');
            } else {
                marca.get(0).setCustomValidity('Inválido');
            }
        });

        modelo.keyup(() => {
            if (modelo.val().length > 0) {
                modelo.get(0).setCustomValidity('');
            } else {
                modelo.get(0).setCustomValidity('Inválido');
            }
        });

        cor.keyup(() => {
            if (cor.val().length > 0) {
                cor.get(0).setCustomValidity('');
            } else {
                cor.get(0).setCustomValidity('Inválido');
            }
        });

        placa.keyup(() => {
            if (placa.val().length > 0) {
                placa.get(0).setCustomValidity('');
            } else {
                placa.get(0).setCustomValidity('Inválido');
            }
        });

        renavam.keyup(() => {
            if (renavam.val().length > 0) {
                renavam.get(0).setCustomValidity('');
            } else {
                renavam.get(0).setCustomValidity('Inválido');
            }
        });


        //Validação quando o formulario é confirmado

        form.submit(() => {
            nome = $("#nome");
            data = $("#data");
            genero = $("#genero");
            var dataValida = Inputmask.isValid(data.val(), {alias: "datetime", inputFormat: "dd/mm/yyyy" });
            celular = $("#celular");
            var celularValido = Inputmask.isValid(celular.val(), "(99)9999-9999[9]");
            celularAlternativo = $("#celularAlternativo");
            var celularAlternativoValido = Inputmask.isValid(celularAlternativo.val(), "(99)9999-9999[9]");
            cpf = $("#cpf");
            var cpfValido = validarCPF(cpf.val());
            cnpj = $("#cnpj");
            // var cnpjValido = validarCNPJ(cnpj.val());
            mei = $("#mei");
            // var meiValido = validarMEI(mei.val());
            cnh = $("#cnh");
            // var cnhValida = validarCNH(cnh.val());
            email = $("#email");
            var emailValido = Inputmask.isValid(email.val(),{alias: "email"});
            senha = $("#senha");
            confirmarSenha = $("#confirmarSenha");
            marca = $("#marca");
            modelo = $("#modelo");
            cor = $("#cor");
            placa = $("#placa");
            var placaValida = Inputmask.isValid(placa.val(),{mask:"AAA-9999"});
            renavam = $("#renavam");
            var renavamValido = Inputmask.isValid(renavam.val(),{mask:"99999999999"});

            if (nome.val().length > 0){
                nome.get(0).setCustomValidity('');
            } else {
                nome.get(0).setCustomValidity('Inválido');
            }

            var feedbackData = $("#feedbackData");
            if (data.val().length > 0) {
                if (dataValida) {
                    feedbackData.text("");
                    data.get(0).setCustomValidity('');
                } else {
                    feedbackData.text("Digite um CPF válido");
                    data.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackData.text("Campo obrigatório");
                data.get(0).setCustomValidity('Inválido');
            }

            var feedbackCpf = $("#feedbackCpf");
            if (cpf.val().length > 0) {
                if (cpfValido) {
                    feedbackCpf.text("");
                    cpf.get(0).setCustomValidity('');
                } else {
                    feedbackCpf.text("Digite um CPF válido");
                    cpf.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackCpf.text("Campo obrigatório");
                cpf.get(0).setCustomValidity('Inválido');
            }

            // if (cnpjValido) {
            //     cnpj.get(0).setCustomValidity('');
            // } else {
            //     cnpj.get(0).setCustomValidity('Inválido');
            // }

            // if (cnhValida) {
            //     cnh.get(0).setCustomValidity('');
            // } else {
            //     cnh.get(0).setCustomValidity('Inválido');
            // }

            var feedbackCelular = $("#feedbackCelular");
            if (celular.val().length > 0) {
                if (celularValido) {
                    feedbackCelular.text("");
                    celular.get(0).setCustomValidity('');
                } else {
                    feedbackCelular.text("Digite um celular válido");
                    celular.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackCelular.text("Campo obrigatório");
                celular.get(0).setCustomValidity('Inválido');
            }

            var feedbackCelularAlternativo = $("#feedbackCelularAlternativo");
            if (celularAlternativo.val().length > 0) {
                if (celularAlternativoValido) {
                    feedbackCelularAlternativo.text("");
                    celularAlternativo.get(0).setCustomValidity('');
                } else {
                    feedbackCelularAlternativo.text("Digite um celular válido");
                    celularAlternativo.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackCelularAlternativo.text("Campo obrigatório");
                celularAlternativo.get(0).setCustomValidity('Inválido');
            }

            var feedbackEmail = $("#feedbackEmail");
            if (email.val().length > 0) {
                if (emailValido) {
                    feedbackEmail.text("");
                    email.get(0).setCustomValidity('');
                } else {
                    feedbackEmail.text("Digite um email válido");
                    email.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackEmail.text("Campo obrigatório");
                email.get(0).setCustomValidity('Inválido');
            }

            feedbackSenha = $("#feedbackSenha");
            feedbackConfirmarSenha = $("#feedbackConfirmarSenha");
            if (senha.val().length > 0) {
                feedbackSenha.text("");
                if (confirmarSenha.val().length > 0) {
                    if (senha.val() === confirmarSenha.val()) {
                        senha.get(0).setCustomValidity('');
                        confirmarSenha.get(0).setCustomValidity('');
                        feedbackConfirmarSenha.text("");
                    } else {
                        senha.get(0).setCustomValidity('Inválido');
                        confirmarSenha.get(0).setCustomValidity('Inválida');
                        feedbackConfirmarSenha.text("Senhas não conferem");
                    }
                } else {
                    senha.get(0).setCustomValidity('Inválido');
                    confirmarSenha.get(0).setCustomValidity('Inválida');
                    feedbackConfirmarSenha.text("Campo obrigatório")
                }
            } else {
                senha.get(0).setCustomValidity('Inválido');
                confirmarSenha.get(0).setCustomValidity('Inválida');
                feedbackSenha.text("Campo obrigatório");
                if (confirmarSenha.val().length <= 0) {
                    feedbackConfirmarSenha.text("Campo obrigatório")
                }
            }

            if (placaValida) {
                placa.get(0).setCustomValidity('');
            } else {
                placa.get(0).setCustomValidity('Inválido');
            }

            if (renavamValido) {
                renavam.get(0).setCustomValidity('');
            } else {
                renavam.get(0).setCustomValidity('Inválido');
            }

            form.addClass('was-validated');
            return false;


        });



        <!-- Formato das máscaras dos inputs -->

        celular.inputmask("(99)9999-9999[9]", {removeMaskOnSubmit:true});
        celularAlternativo.inputmask("(99)9999-9999[9]", {removeMaskOnSubmit:true});
        cpf.inputmask("999.999.999-99", {removeMaskOnSubmit:true});
        cnpj.inputmask("99.999.999/9999-99", {removeMaskOnSubmit:true});
        cnh.inputmask("99999999999", {removeMaskOnSubmit: true});
        renavam.inputmask("99999999999", {removeMaskOnSubmit: true});
        placa.inputmask("AAA-9999", {removeMaskOnSubmit: true});
        email.inputmask("email");
        nome.inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});
        data.inputmask("datetime", {placeholder: "DD/MM/AAAA", inputFormat: "dd/mm/yyyy", max: "01/01/1998", min: "01/01/1919", outputFormat: "yyyy-mm-dd", removeMaskOnSubmit: true});
        marca.inputmask({regex: "[a-zà-úA-ZÀ-Ú- ]*", placeholder: ""});
        modelo.inputmask({regex: "[a-zà-úA-ZÀ-Ú0-9- ]*", placeholder: ""});
        cor.inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});

            //Validação de CPF

            var validarCPF = (cpf) =>  {
                cpf = cpf.replace(/[^\d]+/g,'');
                if(cpf == '') return false;
                // Elimina CPFs invalidos conhecidos
                if (cpf.length != 11 ||
                    cpf == "00000000000" ||
                    cpf == "11111111111" ||
                    cpf == "22222222222" ||
                    cpf == "33333333333" ||
                    cpf == "44444444444" ||
                    cpf == "55555555555" ||
                    cpf == "66666666666" ||
                    cpf == "77777777777" ||
                    cpf == "88888888888" ||
                    cpf == "99999999999")
                    return false;
                // Valida 1o digito
                add = 0;
                for (i=0; i < 9; i ++)
                    add += parseInt(cpf.charAt(i)) * (10 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(9)))
                    return false;
                // Valida 2o digito
                add = 0;
                for (i = 0; i < 10; i ++)
                    add += parseInt(cpf.charAt(i)) * (11 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(10)))
                    return false;
                return true;
            }

    });
</script>

<?php include '../footer.php' ?>


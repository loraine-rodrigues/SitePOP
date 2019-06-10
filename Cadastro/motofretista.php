<?php
$title = "CADASTRO MOTOFRETISTA";

require '../conexao.php';

include '../header.php';

function carregarFoto($uuid) {
    $pasta_destino = "../image/motofretistas/";
    $caminho_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $tipo_arquivo = strtolower(pathinfo($caminho_destino,PATHINFO_EXTENSION));
    $caminho_destino = $pasta_destino . $uuid . "." . $tipo_arquivo;
// Verifique se o arquivo de imagem é uma imagem real ou uma imagem falsa
    if(isset($_POST["confirmarCadastro"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
//            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Verifique se o arquivo já existe
    if (file_exists($caminho_destino)) {
// echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

// Verifique o tamanho do arquivo
    if ($_FILES["foto"]["size"] > 500000) {
// echo "Desculpe, seu arquivo é muito grande.";
        $uploadOk = 0;
    }
// Permitir determinados formatos de arquivo
    if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg") {
// echo "Desculpe, apenas arquivos JPG, JPEG e PNG são permitidos.";
        $uploadOk = 0;
    }
// Verifique se $ uploadOk está definido como 0 por um erro
    if ($uploadOk == 0) {
// echo "Desculpe, seu arquivo não foi enviado.";
        return 'erro';
// se tudo estiver ok, tente fazer o upload do arquivo
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho_destino)) {
// echo "O arquivo". basename ($ _FILES ["foto"] ["nome"]). "foi carregado";
            return $uuid . "." . $tipo_arquivo;
        } else {
// echo "Desculpe, houve um erro ao fazer o upload do seu arquivo.";
            return 'erro';
        }
    }
}

if (isset($_POST['confirmarCadastro'])) {
    foreach ($_POST as $campo) {
        if (empty($campo)) {
            $erro = "É necessário preencher todos os campos";
        }
    }

    if (isset($_POST['regiao'])) {
        $regiao = implode(",", $_POST ['regiao']);
    }
    else {
        $erro = "Informe ao menos uma cidade para atuar!";
    }

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
                $erro = 'Erro ao cadastrar';
            }
        }
        catch (PDOException $excecao) {
            $erro = "Erro ao cadastrar";
//            echo $excecao->getMessage();
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

    #img-uploaded {
        width: 18em;
        height: 12em;
    }

    .toast-top-center {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: 0 auto;
        z-index: 99999;
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
                            <img id='img-uploaded' src="../avatar.svg" class="rounded mb-2"/>
                            <div class="input-group mt-1">
                                    <span class="input-group-btn">
                                        <span class="btn btn-outline-primary btn-file">
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
                        <button type="submit" name="confirmarCadastro" value="ok" class="btn btn-outline-success float-right mx-5">Confirmar </button> <!--Botão entrar-->
                    </div>

                </div>

            </div>
        </div>
    </form>
</div>



<script>
    $(document).ready( () => {
        //teste de script para pegar imagem
        $(".somenteLeitura").keydown(function(e){
            e.preventDefault();
        });

        $(".somenteLeitura").bind('cut copy paste', function (e){
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

        var form = $("#form");
        var nome = $("#nome");
        var data = $("#data");
        var feedbackData = $("#feedbackData");
        var genero = $("#genero");
        var celular = $("#celular");
        var celularAlternativo = $("#celularAlternativo");
        var regioes = $("input[name^='regiao']");
        var regioesValidas = false;
        regioes.each((regiao) => {
            if (regioes.get(regiao).checked) {
                regioesValidas = true;
            }
        });
        var cpf = $("#cpf");
        var feedbackCpf = $("#feedbackCpf");
        var cnpj = $("#cnpj");
        var feedbackCnpj = $("#feedbackCnpj");
        var mei = $("#mei");
        var feedbackMei = $("#feedbackMei");
        var cnh = $("#cnh");
        var feedbackCnh = $("#feedbackCnh");
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
        var feedbackRenavam = $("#feedbackRenavam");

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
            if (cnpj.val().length > 0) {
                if (validarCNPJ(cnpj.val())) {
                    cnpj.get(0).setCustomValidity('');
                    feedbackCnpj.text("");
                } else {
                    cnpj.get(0).setCustomValidity('Inválido');
                    feedbackCnpj.text("Digite um CNPJ válido");
                }
            } else {
                cnpj.get(0).setCustomValidity('Inválido');
                feedbackCnpj.text("Campo obrigatório");
            }
        });

        cnh.keyup(() => {
            cnh = $("#cnh");
            if (cnh.val().length > 0) {
                if (validarCNH(cnh.val())) {
                    cnh.get(0).setCustomValidity('');
                    feedbackCnh.text("");
                } else {
                    cnh.get(0).setCustomValidity('Inválido');
                    feedbackCnh.text("Digite uma CNH válida");
                }
            } else {
                cnh.get(0).setCustomValidity('Inválido');
                feedbackCnh.text("Campo obrigatório");
            }

        });

        mei.on('change', () => {
            if (mei.val().length > 0) {
                if (mei.val() == "Sim") {
                    mei.get(0).setCustomValidity('');
                    feedbackMei.text("")
                } else {
                    $('#modalMei').modal({});
                    mei.get(0).setCustomValidity('Inválido');
                    feedbackMei.text("É necessário possuir MEI para efetuar cadastro")
                }
            } else {
                mei.get(0).setCustomValidity('Inválido');
                feedbackMei.text("Campo obrigatório")
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

        regioes.change(() => {
            regioesValidas = false;
            regioes.each((regiao) => {
                if (regioes.get(regiao).checked) {
                    regioesValidas = true;
                }
            });

            if (regioesValidas) {
                regioes.each((regiao) => {
                    regioes.get(regiao).setCustomValidity('');
                });
            } else {
                regioes.each((regiao) => {
                    regioes.get(regiao).setCustomValidity('Inválido');
                });
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
            placa = $("#placa");
            var feedbackPlaca = $("#feedbackPlaca");
            if (placa.val().length > 0) {
                if (Inputmask.isValid(placa.val(), "AAA-9999")) {
                    placa.get(0).setCustomValidity('');
                    feedbackPlaca.text("");
                } else {
                    feedbackPlaca.text("Digite uma placa válida");
                    placa.get(0).setCustomValidity('Inválido');
                }
            } else{
                feedbackPlaca.text("Campo obrigatório");
                placa.get(0).setCustomValidity('Inválido');
            }
        });

        renavam.keyup(() => {
            if (renavam.val().length > 0) {
                if (validarRENAVAM(renavam.val())) {
                    renavam.get(0).setCustomValidity('');
                    feedbackRenavam.text("");
                } else {
                    renavam.get(0).setCustomValidity('Inválido');
                    feedbackRenavam.text("Digite um RENAVAM válido");
                }
            } else {
                renavam.get(0).setCustomValidity('Inválido');
                feedbackRenavam.text("Campo obrigatório");
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
            regioes = $("input[name^='regiao']");
            regioesValidas = false;
            cpf = $("#cpf");
            var cpfValido = validarCPF(cpf.val());
            cnpj = $("#cnpj");
            var cnpjValido = validarCNPJ(cnpj.val());
            mei = $("#mei");
            cnh = $("#cnh");
            var cnhValida = validarCNH(cnh.val());
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
            var renavamValido = validarRENAVAM(renavam.val());

            if (nome.val().length > 0){
                nome.get(0).setCustomValidity('');
            } else {
                nome.get(0).setCustomValidity('Inválido');
            }

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

            if (cnpj.val().length > 0) {
                if (cnpjValido) {
                    cnpj.get(0).setCustomValidity('');
                    feedbackCnpj.text("");
                } else {
                    cnpj.get(0).setCustomValidity('Inválido');
                    feedbackCnpj.text("Digite um CNPJ válido");
                }
            } else {
                cnpj.get(0).setCustomValidity('Inválido');
                feedbackCnpj.text("Campo obrigatório");
            }

            if (cnh.val().length > 0) {
                if (cnhValida) {
                    cnh.get(0).setCustomValidity('');
                    feedbackCnh.text("");
                } else {
                    cnh.get(0).setCustomValidity('Inválido');
                    feedbackCnh.text("Digite uma CNH válida");
                }
            } else {
                cnh.get(0).setCustomValidity('Inválido');
                feedbackCnh.text("Campo obrigatório");
            }

            if (mei.val().length > 0) {
                if (mei.val() == "Sim") {
                    mei.get(0).setCustomValidity('');
                    feedbackMei.text("")
                } else {
                    mei.get(0).setCustomValidity('Inválido');
                    feedbackMei.text("É necessário possuir MEI para efetuar cadastro")
                }
            } else {
                mei.get(0).setCustomValidity('Inválido');
                feedbackMei.text("Campo obrigatório")
            }

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

            var feedbackPlaca = $("#feedbackPlaca");
            if (placaValida) {
                placa.get(0).setCustomValidity('');
                if (placaValida) {
                    feedbackPlaca.text("");
                    placa.get(0).setCustomValidity('');
                } else {
                    feedbackPlaca.text("Digite uma placa válida");
                    placa.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackPlaca.text("Campo obrigatório");
                placa.get(0).setCustomValidity('Inválido');
            }

            if (renavam.val().length > 0) {
                if (renavamValido) {
                    renavam.get(0).setCustomValidity('');
                    feedbackRenavam.text("");
                } else {
                    renavam.get(0).setCustomValidity('Inválido');
                    feedbackRenavam.text("Digite um RENAVAM válido");
                }
            } else {
                renavam.get(0).setCustomValidity('Inválido');
                feedbackRenavam.text("Campo obrigatório");
            }

            regioes.each((regiao) => {
                if (regioes.get(regiao).checked) {
                    regioesValidas = true;
                }
            });

            if (regioesValidas) {
                regioes.each((regiao) => {
                    regioes.get(regiao).setCustomValidity('');
                });
            } else {
                regioes.each((regiao) => {
                    regioes.get(regiao).setCustomValidity('Inválido');
                });
            }

            form.addClass('was-validated');

            return form[0].checkValidity();
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
            if (cpf.charAt(0).repeat(11) == cpf)
                return false;
            // if (cpf.length != 11 ||
            //     cpf == "00000000000" ||
            //     cpf == "11111111111" ||
            //     cpf == "22222222222" ||
            //     cpf == "33333333333" ||
            //     cpf == "44444444444" ||
            //     cpf == "55555555555" ||
            //     cpf == "66666666666" ||
            //     cpf == "77777777777" ||
            //     cpf == "88888888888" ||
            //     cpf == "99999999999")
            //     return false;

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
        };

        var validarCNPJ = (cnpj) => {

            cnpj = cnpj.replace(/[^\d]+/g,'');

            if(cnpj == '') return false;

            if (cnpj.length != 14)
                return false;

            // Elimina CNPJs invalidos conhecidos
            if (cnpj.charAt(0).repeat(14) == cnpj)
                return false;
            // if (cnpj == "00000000000000" ||
            //     cnpj == "11111111111111" ||
            //     cnpj == "22222222222222" ||
            //     cnpj == "33333333333333" ||
            //     cnpj == "44444444444444" ||
            //     cnpj == "55555555555555" ||
            //     cnpj == "66666666666666" ||
            //     cnpj == "77777777777777" ||
            //     cnpj == "88888888888888" ||
            //     cnpj == "99999999999999")
            //     return false;

            // Valida DVs
            tamanho = cnpj.length - 2;
            numeros = cnpj.substring(0,tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;

            tamanho = tamanho + 1;
            numeros = cnpj.substring(0,tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;

            return true;

        };

        var validarCNH = (cnh) => {
            var char1 = cnh.charAt(0);

            if (cnh.replace(/[^\d]/g, '').length !== 11 || char1.repeat(11) === cnh) {
                return false;
            }

            for (var i = 0, j = 9, v = 0; i < 9; ++i, --j) {
                v += +(cnh.charAt(i) * j);
            }

            var dsc = 0,
                vl1 = v % 11;

            if (vl1 >= 10) {
                vl1 = 0;
                dsc = 2;
            }

            for (i = 0, j = 1, v = 0; i < 9; ++i, ++j) {
                v += +(cnh.charAt(i) * j);
            }

            var x = v % 11;
            var vl2 = (x >= 10) ? 0 : x - dsc;

            return ('' + vl1 + vl2) === cnh.substr(-2);
        };

        var validarRENAVAM = (renavam) => {
            if( !renavam.match("[0-9]{11}") ){
                return false;
            }

            var renavamSemDigito = renavam.substring(0, 10);

            var renavamReversoSemDigito = renavamSemDigito.split("").reverse().join("");

            var soma = 0;
            var multiplicador = 2;
            for (var i=0; i<10; i++){
                var algarismo = renavamReversoSemDigito.substring(i, i+1);
                soma += algarismo * multiplicador;

                if( multiplicador >= 9 ){
                    multiplicador = 2;
                }else{
                    multiplicador++;
                }
            }

            var mod11 = soma % 11;

            var ultimoDigitoCalculado = 11 - mod11;

            ultimoDigitoCalculado = (ultimoDigitoCalculado >= 10 ? 0 : ultimoDigitoCalculado);

            var digitoRealInformado = parseInt(renavam.substring(renavam.length - 1, renavam.length));

            return ultimoDigitoCalculado === digitoRealInformado;
        };
    });
</script>

<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Titulo do modal -->
            <div class="modal-header text-center">
                <h2 class="modal-title">TERMOS DE USO</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Conteúdo do modal -->
            <div class="modal-body">
                <p>O presente termo regulará as operações e prestações de serviços entre a POP! Motofrete, seus usuários e associados, pessoas jurídicas ou físicas, em todo território nacional, sendo a sua observância obrigatória para fruição do sistema.</p>

                <h4>1 – PROPOSTA DO SISTEMA</h4>
                <p>O POP! Motofrete disponibilizará o seu sistema aos seus usuários e associados para fins de contratação do serviço de motofrete, por meio de seleção do motofretista e cotação, feito externamente através  dos contatos profissionais fornecidos pelo prestador de serviço na plataforma.</p>
                <p>Mediante a escolha do perfil dos cadastrados, pelos usuários e pelos associados, ambos terão a possibilidade de negociarem a  cotação com diversos participantes, cujo resultado  será a os ajustes de acordo a necessidade de cada entrega e cada cliente.</p>

                <h5>1. 1 PRINCIPAIS CARACTERÍSTICAS DO SISTEMA:</h5>
                <p>Perfil completo dos prestadores de transportes, dados do veículo,  localidades atendidas, bem como os meio para contato: telefone com aplicativo para mensagens instantâneas (whats’app) e telefone de emergência.</p>
                <p>Diversos clientes cadastrados e com interesse na contratação de serviços, disponibilizando as principais informações de nome e telefone.</p>

                <h5>1.2 ALGUMAS VANTAGENS DO SISTEMA</h5>
                <p>O sistema irá exibir os dados do motofretista de acordo com o filtro de região que o usuário selecionar, possibilitando aos usuários e aos associados traçar o perfil do proponente para fins de pesquisa no nosso vasto banco de dados, contando com diversos  prestadores de serviços.
                <p>As propostas serão enviadas pelo cliente ao motofretista, por meio do contato fornecido no perfil, de forma que ambos podem ajustar as necessidades de acordo com cada cliente e entrega, sem que haja intermediadores ou regras impostas pela plataforma.</p>
                <p>O sistema  não irá interferir nas cotações, valores e formas de pagamento. Ficando assim estabelecido que cliente e motofretista acordem entre si as métricas da proposta de serviço.</p>
                <p>No caso do usuário fazer o pagamento pontual e diretamente ao prestador de serviço, o POP! Motofrete não terá nenhuma responsabilidade, inclusive de natureza tributária e fiscal. Nesta modalidade de contratação, tanto prestador de serviços quanto cliente ficam responsáveis por acordarem o local, formas de pagamento, valores, e se houver,  taxas e juros pela cobrança da conclusão do serviço de entregas.</p>
                <p>O sistema possui restrições para o cadastro dos usuários e dos associados, o que garantirá aos interessados uma seleção de clientes e de prestadores de serviços com qualidade e credibilidade.</p>
                <p>A indicação  e divulgação do proponente dos serviços ao cliente não configura nenhuma contratação, sendo está efetivada somente após o aceite do contrato celebrado entre as partes.</p>

                <h4>2 – MANUTENÇÃO DO SISTEMA</h4>
                <p>O sistema será periodicamente revisado para melhoria da sua funcionalidade, por esta razão, poderão ocorrer paralizações para manutenção, fora do horário comercial, sem prévio aviso.</p>

                <h4>3 – UTILIZAÇÃO DO SISTEMA</h4>
                <p>Os participantes do sistema, usuário ou associado, aceitam todos os termos e as condições aqui estabelecidas de forma livre e espontânea vontade, sendo, exclusivamente, responsáveis pelas informações prestadas, bem como pelos compromissos assumidos de seleção, negociação e recebimento de valores e itens.</p>
                <p>Os usuários e os participantes se comprometem a utilizar o sistema com observância dos termos e das condições aqui pactuadas, devendo proteger integralmente os direitos de terceiros e do POP! Motofrete.</p>
                <p>É terminantemente proibido, ao usuário e ao associado, ao uso indevido das informações obtidas no sistema, bem como a cópia e a reprodução, incluindo a distribuição ou divulgação, de conteúdo do site.</p>
                <p>O usuário prestador do serviço poderá, por meio do seu perfil gerado com as informações fornecidas por ele, alterar informações sobre seu cadastro e veículo. No entanto, os dados do veículo passarão por solicitação da documentação atual e revalidação pelo  POP! Motofrete.</p>

                <h4>4 – DIREITOS AUTORAIS E MARCAS RESERVADOS AO POP! Motofrete</h4>
                <p>O sistema é protegido pela Lei nº 9.610/98, sendo as suas informações e produtos de uso exclusivo do  POP! Motofrete, sendo, em caso de desrespeito a esta Lei, passível de sanção cível e penal.</p>
                <p>A proprietária do sistema não cede ou transferência nenhuma autorização uso ou exploração dos direitos reservados a ela.</p>

                <h4>5 – DISPONIBILIDADE DO SISTEMA E DOS SEUS CONTEÚDOS</h4>
                <p>A proprietária poderá interromper os serviços em caso de manutenção ou fatores alheios à sua vontade, não gerando ao usuário ou ao associado qualquer direito à indenização, seja a que título for.</p>

                <h4>6 – PROTEÇÃO DO SISTEMA</h4>
                <p>Para evitar qualquer dano ao sistema, os usuários e os associados se comprometem a utilizar antivírus, versão mais atualizada. Além de manterem suas informações restritas apenas ao seu uso pessoal, não fornecendo sua senha e e-mail para terceiros.</p>

                <h4>7 – RESPONSABILIDADE</h4>
                <p>O uso das informações disponibilizadas no sistema não dará direito à indenização de qualquer natureza, seja a que título for e em qualquer tempo.</p>
                <p>O POP! Motofrete não se responsabilizará pelos negócios gerados pelo sistema entre o prestador se serviços e o contratante nem a carga transportada. Já que toda a negociação se passa externamente, sem que haja qualquer fator que relacione dependência da plataforma para verificação da entrega.</p>

                <h4>8 – GARANTIA DE ENTREGA</h4>
                <p>A plataforma se isenta de oferecer  serviço de garantia de entrega, na qual o POP! Motofrete não se responsabilizará por eventuais perdas ocorridas.</p>
                <p>Colaboraremos com eventuais consultas de dados e informações sobre o cadastro do motofretista para que haja transparência e ausência de equívocos no ínterim da entrega. Para que assim, seja evitado danos por insuficiência de informações do prestador de serviço.</p>

                <h4>9 – RESTRIÇÃO AO USO DESTE WEBSITE</h4>
                <p>O POP! Motofrete, em função de uso irregular do sistema e dos seus conteúdos, reserva-se no direito de recusar ou retirar o acesso do usuário ou do associado, sem aviso prévio, em caso de fraude, simulação, determinação judicial ou identificação de atividades irregulares.</p>

                <h4>10 – VIGÊNCIA</h4>
                <p>O prazo de duração deste sistema é indeterminado.</p>

                <h4>11 –PLANO PREMIUM(monetização do site - Forma 1)</h4>
                Em elaboração
                <p>Em caso de opção do usuário pela contratação do PLANO PREMIUM que oferece recursos extras na plataforma como: xxx xxx xxx xxxx xxx , será selecionado o  sistema de pagamento mensal ao  POP! Motofrete por meio de ______________  todo dia _____.</p>
                <p>O valor da taxa de serviço Premium pelo uso do sistema do POP! Motofrete poderá ser conferido antes do aceite do serviço de cadastro nessa modalidade, sendo da sua única e exclusiva vontade acerca da aceitação ou não proposta de serviços. Esse valor também poderá sofrer alterações e /ou promoções com aviso prévio ao usuário cadastrado no plano para que fique ciente de qualquer mudança.</p>
                <p>O usuário poderá cancelar a qualquer momento o Plano Premium, ou acrescentar novos recursos. Em caso de escolha das opções de cancelamento ou migração o usuário se compromete a efetuar o pagamento do período utilizado.</p>
                <br>
                <h4>12 – DISPOSIÇÕES GERAIS</h4>
                <p>O uso do sistema não gera qualquer relação de dependência entre os usuários ou com o POP! Motofrete, nem vínculo de emprego.</p>

                <h4>13 – FORO DE ELEIÇÃO</h4>
                <p>O usuário e o associado aceita a eleição do Foro Central da Comarca da Capital do Estado de São Paulo, com exclusão de qualquer outro por mais privilegiado que seja.</p>
            </div>
        </div>
    </div>


    <?php include '../footer.php' ?>

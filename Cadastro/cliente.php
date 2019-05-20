<?php
$title = "CADASTRO CLIENTE";

include '../header.php';
require '../conexao.php';

if (isset($_POST['confirmarCadastro'])) {
    $nome = $_POST ['nome'];
    $nascimento = $_POST ['nascimento'];
    $cpf = $_POST ['cpf'];
    $celular = $_POST ['celular'];
    $email = $_POST ['email'];
    $senha = $_POST ['senha'];
    $confirmarSenha = $_POST ['confirmarSenha'];
    $termos = $_POST ['termos'];

    if ($senha == $confirmarSenha && $termos == TRUE) {
        try {
            $comando = $conexao->prepare("CALL cadastrarCliente(?, ?, ?, ?, ?, ?)");
            $comando->bindParam(1, $nome);
            $comando->bindParam(2, $nascimento);
            $comando->bindParam(3, $cpf);
            $comando->bindParam(4, $email);
            $comando->bindParam(5, $celular);
            $comando->bindParam(6, $senha);
            $comando->execute();

            echo "Cliente cadastrado!";
        }
        catch (PDOException $excecao) {
            echo "Erro ao cadastrar clientes: " . $excecao->getMessage();
        }
    }
}
?>

<div class="container text-center">
    <h1 class="font-weight-light text-white">CADASTRO CLIENTE</h1>
    <div class="card mx-auto my-5 text-left" style="width: 54rem;"> <!--Div usada para formartar o card de login -->
        <div class="card-body">
            <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
            <form method="post" id="form" class="needs-validation" novalidate>
                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe seu nome completo" required>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Data de nascimento: </label>
                            <input type="text" class="form-control" id="data" name="nascimento" placeholder="Informe sua data de nascimento" required>
                            <div class="invalid-feedback">
                                <span id="feedbackData"> </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--CPF-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cpf"> CPF: </label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe seu CPF" required>
                            <div class="invalid-feedback">
                                <span id="feedbackCpf"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Celular para contato de emergência-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular: </label>
                            <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular para contato" required>
                            <div class="invalid-feedback">
                                <span id="feedbackCelular"> </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Informe seu email para login" required>
                            <div class="invalid-feedback">
                                <span id="feedbackEmail"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe uma senha para login" required>
                            <div class="invalid-feedback">
                                <span id="feedbackSenha"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Confirmar senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="confirmarSenha"> Confirmar senha: </label>
                            <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" placeholder="Confirme a senha para login" required>
                            <div class="invalid-feedback">
                                <span id="feedbackConfirmarSenha"> </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row mt-5">

                    <!-- Termos de uso -->
                    <div class="col">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="checkTermo" name="termos" required>
                            <label for="termos">Eu li e aceito os </label>
                            <label class="form-check-label" for="checkTermo" ><a href="../termos.php">termos de uso</a></label>
                            <div class="invalid-feedback">
                                É necessário aceitar os termos de uso
                            </div>
                        </div>                                                 <!-- Link para página de termos de uso-->
                    </div>

                        <!-- Botão de confirmar cadastro-->
                    <div class="col">
                        <button type="submit" name="confirmarCadastro" class="btn btn-outline-success float-right mx-5">Confirmar </button> <!--Botão entrar-->
                    </div>
                </div>
            </form>
        </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        var form = $("#form");
        var nome = $("#nome");
        var data = $("#data");
        var cpf = $("#cpf");
        var celular = $("#celular");
        var email = $("#email");
        var senha = $("#senha");
        var feedbackSenha = $("#feedbackSenha");
        var confirmarSenha = $("#confirmarSenha");
        var feedbackConfirmarSenha = $("#feedbackConfirmarSenha");



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
                feedbackConfirmarSenha.text("Campo obrigatório");
            }
        });

        //Validação quando o formulario é confirmado

        form.submit(() => {

            nome = $("#nome");
            data = $("#data");
            var dataValida = Inputmask.isValid(data.val(), {alias: "datetime", inputFormat: "dd/mm/yyyy" });
            cpf = $("#cpf");
            var cpfValido = validarCPF(cpf.val());
            celular = $("#celular");
            var celularValido = Inputmask.isValid(celular.val(), "(99)9999-9999[9]");
            email = $("#email");
            var emailValido = Inputmask.isValid(email.val(),{alias: "email"});
            senha = $("#senha");
            confirmarSenha = $("#confirmarSenha");


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
                    feedbackConfirmarSenha.text("Este campo é obrigatório")
                }
            } else {
                senha.get(0).setCustomValidity('Inválido');
                confirmarSenha.get(0).setCustomValidity('Inválida');
                feedbackSenha.text("Campo obrigatório");
                if (confirmarSenha.val().length <= 0) {
                    feedbackConfirmarSenha.text("Campo obrigatório")
                }
            }

            form.addClass('was-validated');
            return false;

        });

        //Formato das mascaras

        celular.inputmask("(99)9999-9999[9]", {removeMaskOnSubmit: true});
        cpf.inputmask("999.999.999-99", {removeMaskOnSubmit: true});
        email.inputmask("email");
        nome.inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});
        data.inputmask("datetime", {placeholder: "DD/MM/AAAA", inputFormat: "dd/mm/yyyy", max: "01/01/1998", min: "01/01/1919", outputFormat: "yyyy-mm-dd", removeMaskOnSubmit: true});

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
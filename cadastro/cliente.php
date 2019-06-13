<?php
$title = "CADASTRO CLIENTE";

include '../header.php';
require '../conexao.php';

if (isset($_POST['confirmarCadastro'])) {
    foreach ($_POST as $campo) {
        if (empty($campo)) {
            $erro = "<li>É necessário preencher todos os campos</li>";
        }
    }

    if ($_POST ['senha'] != $_POST ['confirmarSenha']) {
        $erro .= "<li>As senhas estão diferentes</li>";
    }

    if ($_POST['termos'] != TRUE) {
        $erro .= "<li>É necessário ler e aceitar os termos para prosseguir</li>";
    }

    if (empty($erro)) {
        try {
            $nome = $_POST ['nome'];
            $nascimento = $_POST ['nascimento'];
            $cpf = $_POST ['cpf'];
            $celular = $_POST ['celular'];
            $email = $_POST ['email'];
            $senha = $_POST ['senha'];
            $confirmarSenha = $_POST ['confirmarSenha'];
            $termos = $_POST ['termos'];

            $comando = $conexao->prepare("CALL cadastrarCliente(?, ?, ?, ?, ?, ?)");
            $comando->bindParam(1, $nome);
            $comando->bindParam(2, $nascimento);
            $comando->bindParam(3, $cpf);
            $comando->bindParam(4, $email);
            $comando->bindParam(5, $celular);
            $comando->bindParam(6, $senha);
            $comando->execute();

            $mensagem = "Cliente cadastrado com sucesso<br/>Clique <a href='../home.php'>aqui</a> para efetuar login";
        } catch (PDOException $excecao) {
            $erro = "Erro ao cadastrar clientes";
        }
    }
}
?>

<div class="container text-center">
    <h1 class=" ml-5">CADASTRO CLIENTE</h1>
    <div class="card mx-auto my-5 text-left" style="width: 54rem;"> <!--Div usada para formartar o card de login -->
        <div class="card-body">

            <?php
            if (isset($erro)) {     //Mensagem de erro no cadastro ?>
                <div class="alert alert-danger">
                    <?php echo "<ul style='margin-bottom: 0 !important;'>" . $erro . "</ul>" ?>
                </div>
            <?php } ?>

            <?php
            if (isset($mensagem)) {   //Mensagem de sucesso no cadastro ?>
                <div class="alert alert-success">
                    <?= $mensagem ?>
                </div>
            <?php } ?>

            <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
            <form method="post" id="form" class="needs-validation">
                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" name="nome"
                                   placeholder="Informe seu nome completo">
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Data de nascimento: </label>
                            <input type="text" class="form-control" id="data" name="nascimento"
                                   placeholder="Informe sua data de nascimento">
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
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe seu CPF">
                            <div class="invalid-feedback">
                                <span id="feedbackCpf"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Celular para contato de emergência-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular: </label>
                            <input type="text" class="form-control" id="celular" name="celular"
                                   placeholder="Celular para contato">
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
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="Informe seu email para login">
                            <div class="invalid-feedback">
                                <span id="feedbackEmail"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" id="senha" name="senha"
                                   placeholder="Informe uma senha para login">
                            <div class="invalid-feedback">
                                <span id="feedbackSenha"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Confirmar senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="confirmarSenha"> Confirmar senha: </label>
                            <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha"
                                   placeholder="Confirme a senha para login">
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
                            <input type="checkbox" class="form-check-input" id="checkTermo" name="termos">
                            <label for="termos">Eu li e aceito os </label>
                            <label class="form-check-label" for="checkTermo"><a href="#" data-toggle="modal"
                                                                                data-target="#modal">termos de
                                    uso</a></label>
                            <div class="invalid-feedback">
                                É necessário aceitar os termos de uso
                            </div>
                        </div>                                                 <!-- Link para página de termos de uso-->
                    </div>

                    <!-- Botão de confirmar cadastro-->
                    <div class="col">
                        <button type="submit" name="confirmarCadastro" value="ok" class="btn btn-outline-success float-right mx-5">
                            Confirmar
                        </button> <!--Botão entrar-->
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
</div>

<script src="../scripts/validaCpf.js"></script>
<script src="validacoesCliente.js"></script>



<?php
include 'modalTermos.php';
include '../footer.php';
?>

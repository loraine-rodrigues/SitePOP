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
            $comando->bind_param(1, $nome);
            $comando->bind_param(2, $nascimento);
            $comando->bind_param(3, $cpf);
            $comando->bind_param(4, $celular);
            $comando->bind_param(5, $email);
            $comando->bind_param(6, $senha);
            $comando->execute();

            echo "Cliente cadastrado!";
        }
        catch (PDOException $excecao) {
            echo "Erro: $excecao->errorInfo";
        }
    }
}
?>



<div class="container text-center">
    <h1 class="font-weight-light text-white">CADASTRO CLIENTE</h1>
    <br>
    <div class="card m-auto text-left" style="width: 54rem;"> <!--Div usada para formartar o card de login -->
        <div class="card-body">
            <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
            <form method="post">
                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                                <div class="form-group">
                                    <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe seu nome completo" required>
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Data de nascimento: </label>
                            <input type="date" class="form-control" id="data" name="nascimento" placeholder="Informe sua data de nascimento" required>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--CPF-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> CPF: </label>
                            <input type="tel" class="form-control" id="celular" name="cpf" placeholder="Celular para contato" required>
                        </div>
                    </div>

                    <!--Celular para contato de emergência-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular: </label>
                            <input type="tel" class="form-control" id="celular" name="celular" placeholder="Celular para contato" required>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Informe seu email para login" required>
                        </div>
                    </div>

                    <!--Senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe uma senha para login" required>
                        </div>
                    </div>

                    <!--Confirmar senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="confirmarSenha"> Confirmar senha: </label>
                            <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" placeholder="Confirme a senha para login" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">

                    <!-- Termos de uso -->
                    <div class="col">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="checkTermo" name="termos" required>
                            <label class="form-check-label" for="checkTermo"><a href="../termos.php">Ler termos de uso</a></label>
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
    <br>
</div>

<?php include '../footer.php' ?>


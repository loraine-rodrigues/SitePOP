<?php

include_once 'conecta.php';
$conn= new conecta();
if (isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $email= preg_replace('/[^[:alnum:]_--@]/','',$email);
    $senha= addslashes($senha);
    try {
        $comando = $conexao->prepare("CALL verificaLogin(?, ?)");
        $comando->bindParam(1, $email);
        $comando->bindParam(2, $senha);
        $comando->execute();
        if ($comando->rowCount() > 0) {

            while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['id'] = $resultado['id_login'];
                $_SESSION['nome'] = $resultado['nm_usuario'];
                $_SESSION['tipo'] = $resultado['id_tipo_login'];
            }
            $_SESSION['logado'] = TRUE;
            header('Location: home.php');
            exit();
        } else {
            $_SESSION['erro'] = "Email e/ou senha incorretos";
        }
    } catch (PDOException $excecao) {
        echo "Erro ao logar: " . $excecao->getMessage();
    }
}
 ?>
<style type="text/css">
    .btn-home {
        color: white;
        font-weight: bold;
    }

    .botaoLog {
        background: black;
        line-height: 40px;
        border: 2px solid;
        cursor: pointer;
        position: absolute;
        top: 50%;
        right: 70%;
        transform: translate(-50%, -50%);
        float: right;
        padding: 5px 20px;
        vertical-align: middle;
        ;

    }

    .botao {
        background: black;
        line-height: 40px;
        border: 2px solid;
        cursor: pointer;
        padding: 5px 20px;
        position: absolute;
        top: 50%;
        left: 60%;
        transform: translate(-50%, -50%);
        opacity: 0.6;
        float: center;
        text-decoration: none
    }

    body {
        width: 100%;
        background-image: url(image/home1.jpg) !important;
        background-repeat: no-repeat;
        background-position: 30% 45%;
        background-size: cover;


    }

    p {

        display: inline;

    }

    .btn-entrar {
        width: 50%;
        margin-left: 25%;

    }
</style>


    <!--Div usada para formartar o card de login -->
    <div id="modal1" class="modal fade">
        <div class="modal-dialog">
            <!-- Conteúdo do modal Login-->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Entrar:</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!--Entrada de email para login-->
                <div class="modal-body">
                    <form method="post">
                        <label for="email"> Email: </label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu email" required>
                </div>

                <!--Entrada de senha para login-->
                <div class="modal-body">
                    <label for="senha"> Senha: </label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha" required>
                </div>



                <!-- Botão entrar -->
                <input class="btn btn-outline-info btn-entrar" type="submit" name="entrar" value="Entrar">

                </form>

                <!-- Esqueci a senha-->
                <div class="text-right mt-3">
                    <span class="mr-2 md-4"><a href="esqueciasenha.php">Esqueci minha senha</a> </span>
                </div>
            </div>
        </div>
    </div>


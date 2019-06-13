<?php
$title = "HOME";

include 'header.php';

require 'conexao.php';

if (isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {

        $comando = $conexao->prepare("CALL verificaLogin(?, ?)");
        $comando->bindParam(1, $email);
        $comando->bindParam(2, $senha);
        $comando->execute();
        if ($comando->rowCount() > 0) {

            while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['id'] = $resultado['id_login'];
                $_SESSION['nome'] = $resultado['nm_usuario'];
                $_SESSION['login'] = $resultado['nm_login'];
                $_SESSION['tipo'] = $resultado['id_tipo_login'];
            }
            $_SESSION['logado'] = TRUE;
            ?>
            <script>
                window.location.href = 'home.php';
            </script>
            <?php
        } else {
            $_SESSION['erroLogin'] = "Email e/ou senha incorretos";
        }
    } catch (PDOException $excecao) {
        $_SESSION['erroLogin'] = "Erro ao logar";
    }
} ?>


<style type="text/css">
    .img-logo {
        height: 26em;
    }

    .img-moto {
        height: 24em;
    }

    .btns {
        color: #0f6674;
        font-weight: bold;

    }

    body {
        background-image: url(image/bg-home.png) !important;
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;
        overflow-x: hidden;
    }
</style>

<?php
if (isset($_SESSION['erroLogin'])) {
    ?>
    <script type="text/javascript">
        $(document).ready(() => {
            $('#modalLogin').modal('show');
        });
    </script>
<?php } ?>

<div class="row h-25 text-center">
    <div class="col col-8">
    </div>
    <div class="col col-4">
        <?php if (!isset($_SESSION['logado'])) { ?>
            <a class="btn btns btn-outline-info m-3 py-2 px-4 rounded-pill" href="#" data-toggle="modal"
               data-target=#modalLogin>ENTRAR</a>
            <a class="btn btns btn-outline-info m-3 py-2 px-4 rounded-pill" href="#" data-toggle="modal"
               data-target=#modal>CADASTRE-SE</a>
        <?php } ?>
    </div>
</div>

<div class="row h-75 text-center">
    <div class="col-6">
        <img src="image/logo.png" class="img-logo img-responsive m-auto" alt="Logo">
    </div>
    <div class="col-6">
        <div class="row">
            <img src="image/scooterColorida.png" class="img-moto img-responsive m-auto" alt="Scooter">
        </div>
        <div class="row">
            <p class="text text-warning font-weight-bold display-4 m-auto">Liberdade para negociar</p>
        </div>
    </div>
</div>

<?php if (!isset($_SESSION['logado'])) { ?>

<!--Modal para cadastro de CLIENTE ou MOTOFRETISTA-->
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Conteúdo do modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Para iniciar o cadastro selecione:</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <a href="cadastro/motofretista.php" class="btn btn-outline-warning">Sou motofretista</a>
                <a href="cadastro/cliente.php" class="btn btn-outline-info float-right">Sou cliente</a>
            </div>

        </div>

    </div>
</div>

<!--Div usada para formartar o card de login -->
<div id="modalLogin" class="modal fade">
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
                    <?php
                    if (isset($_SESSION['erroLogin'])) {
                        ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['erroLogin']; ?>
                        </div>
                    <?php }
                    session_destroy();
                    ?>
                    <div class="form-group m-2">
                        <label for="email"> Email: </label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu email"
                               required autofocus>
                    </div>

                    <div class="form-group m-2">
                        <label for="senha"> Senha: </label>
                        <input type="password" class="form-control" name="senha" id="senha"
                               placeholder="Digite sua senha" required>
                    </div>

                    <div class="row">
                        <div class="col m-2">
                            <input class="btn btn-outline-info btn-block" type="submit" name="entrar" value="Entrar">
                        </div>
                    </div>
                    <div class="text-right mt-3">
                        <span class="mr-2 md-4"><a href="esqueciMinhaSenha.php">Esqueci minha senha</a> </span>
                    </div>
            </div>
        </div>
    </div>

    <?php } ?>


    <?php include 'footer.php'; ?>

<?php
$title = "HOME";
require 'conexao.php';
include 'header.php';



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
            header('Location: home.php');
            exit();
        } else {
            $_SESSION['erroLogin'] = "Email e/ou senha incorretos";
        }
    } catch (PDOException $excecao) {
        echo "Erro ao logar: " . $excecao->getMessage();
    }
}
?>


<style type="text/css">
    /*responsivo para as classes */

    @media only screen and (min-width: 767px) {
        img {
            /* The file size of this background image is 93% smaller
       to improve page load speed on mobile internet connections */
            padding-left: 200px;
            margin-top: 100px;
            height: 300px;

        }


        .btns {
            color: #0f6674;
            font-weight: bold;

        }
              body {
        width: 100%;
        background-image: url(image/bg-home.png) !important;
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;

    }


    }

    /*fim do responsivo*/
    body {
        width: 100%;
        background-image: url(image/bg-home.png) !important;
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;

    }

    p {
        display: inline;
    }
</style>

<?php
if (isset($_SESSION['erroLogin'])) {
    ?>
    <script type="text/javascript">
        $(document).ready( () => {
            $('#modalLogin').modal('show');
        });
    </script>
<?php } ?>



<div class="row">
    <div class="col-md-6">

        <img src="image/Imagem1.png" height="250px;" class="img-responsive">

    </div>
<div class="row">
<div class="col-md-6">

        <img src="image/scooterColorida.png" height="250px;" class="img-responsive">

    </div>
</div>



    <?php if (!isset($_SESSION['logado'])) { ?>


    <div class="col">
        <!--ENTRAR-->
        <a class="btn btns btn-outline-info m-4 py-2 px-4 rounded-pill float-right" href="#" data-toggle="modal" data-target=#modalLogin>ENTRAR</a>

            <!--CADASTRE-SE-->
            <a class="btn btns btn-outline-info m-4 py-2 px-4 rounded-pill float-right" href="#" data-toggle="modal" data-target=#modal>CADASTRE-SE</a>
        </div>
    </div>
    <div class="mr-5" style="color:orange;">

        <h1 class=" display-4 h1-responsive font-weight-bold text-right ">Liberdade para negociar</h1>
    </div>
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
                    <a href="Cadastro/motofretista.php" class="btn btn-outline-warning">Sou motofretista</a>
                    <a href="Cadastro/cliente.php" class="btn btn-outline-info float-right">Sou cliente</a>
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
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu email" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha" required>
                        </div>

                        <input class="btn btn-outline-info btn-entrar" type="submit" name="entrar" value="Entrar">

                    </form>

                    <div class="text-right mt-3">
                        <span class="mr-2 md-4"><a href="demo/index.php">Esqueci minha senha</a> </span>
                    </div>
                </div>

                <!-- Esqueci a senha-->

            </div>
        </div>
    </div>

<?php } ?>

<?php include 'footer.php' ?>

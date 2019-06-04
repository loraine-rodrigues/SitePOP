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
@media only screen and (min-width: 767px) {
    .btns {
        color: #0f6674;
        font-weight: bold;
        
    }
}
@media only screen and (min-width: 767px) {
  img {
    /* The file size of this background image is 93% smaller
       to improve page load speed on mobile internet connections */
       padding-left:300px;
      
  }
}

body {
        width: 100%;
        background-image: url(image/bg-image.png)!important;
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
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

<div class="row">
    <div class="col align-self-center " >
      
            <img src="image/logoNovo.png"  height="400px;"  class="img-responsive">
        
    </div>
    

<?php if (!isset($_SESSION['logado'])) { ?>


    <div class="col">
        <!--ENTRAR-->
        <a class="btn btns btn-outline-info m-4 py-2 px-4  rounded-pill float-right" href="#" data-toggle="modal" data-target=#modal1>ENTRAR</a>

        <!--CADASTRE-SE-->
        <a class="btn btns btn-outline-info m-4 py-2 px-4 rounded-pill float-right" href="#" data-toggle="modal" data-target=#modal>CADASTRE-SE</a>
    </div>
</div>
<div class="col-ml mr-5 float-right"style="color:orange;">
            
            <h1 class="ml-5 ">Liberdade para negociar</h1>
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

                <?php
                if (isset($_SESSION['erro'])) :
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['erro']; ?>
                    </div>
                <?php
            endif;

            session_destroy();
            ?>

                <!-- Botão entrar -->
                <input class="btn btn-outline-info btn-entrar" type="submit" name="entrar" value="Entrar">

                </form>

                <!-- Esqueci a senha-->
                <div class="text-right mt-3">
                    <span class="mr-2 md-4"><a href="recuperarSenha/esqueciasenha.html">Esqueci minha senha</a> </span>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php include 'footer.php' ?>


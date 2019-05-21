<?php
$title = "HOME";

include 'header.php' ?>
<style type="text/css">
    .btn-home {
        color: teal;
    }

    .botaoLog {
        background: transparent;
        color: orange;
        line-height: 40px;
        border: 2px solid;
        cursor: pointer;
        padding: 5px 40px;
        position: absolute;
        top: 50%;
        right: 70%;
        transform: translate(-50%, -50%);
        opacity: 100;

    }

    .botao {
        background: transparent;
        color: orange;
        line-height: 40px;
        border: 2px solid;
        cursor: pointer;
        padding: 5px 40px;
        position: absolute;
        top: 50%;
        left: 60%;
        transform: translate(-50%, -50%);
        opacity: 100;
        text-decoration: none
    }

    body {

        background-image: url(image/home4.jpg) !important;
        background-size: 1600px 1000px;
        opacity: 1.0;
        filter: alpha(opacity=80);
    }
</style>
<div class="ac_box">
    <div class="container">
        <div class="row">
            <div class=" mt-4 col-md-11 ">
                <img src="image/LOGO1" width="400px" height="300px" class="img-responsive">
            </div>
        </div>
    </div>
    <div class="container">
        <!--CADASTRE-SE-->
        <div class="botao rounded-pill">
            <a class="nav-link btn-home" name="cadastrar" href="#" data-toggle="modal" data-target=#modal>CADASTRE-SE</a>
            <!--ENTRAR-->
            <div class="botaoLog rounded-pill ">
                <a class="nav-link btn-home " name="entrar" href="#" data-toggle="modal" data-target=#modal1>ENTRAR</a>
            </div>
        </div>
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
                <button type="submit" name="entrar" class="btn btn-outline-primary btn-block">Entrar </button>
                </form>

                <!-- Esqueci a senha-->
                <div class="text-right mt-3">
                <span class="small"><a href="#">Esqueci minha senha</a> </span>
                <span class="small ml-4 mr-2"><a href="#" data-toggle="modal" data-target="#modal">Cadastre-se</a> </span>
            </div>
            </div>
        </div>
    </div>


</div>



<?php include 'footer.php' ?>
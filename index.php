<?php

$title = "PÁGINA PRINCIPAL";

require 'conexao.php';
include 'header.php';

    if (isset($_POST['entrar'])){
        $email = $_POST ['email'];
        $senha = $_POST ['senha'];

        try {
            $comando = $conexao->prepare("CALL verificaLogin(?, ?)");
            $comando->bindParam(1, $email);
            $comando->bindParam(2, $senha);
            $comando->execute();
            if ($comando ->rowCount() > 0) {

                while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION ['id'] = $resultado ['id_login'];
                    $_SESSION ['nome'] = $resultado ['nm_usuario'];
                    $_SESSION ['tipo'] = $resultado ['id_tipo_login'];
                }
                $_SESSION ['logado'] = TRUE;
                header('Location: home.php');
                exit();
            }
            else {
                $_SESSION ['erro'] = "Email e/ou senha incorretos" ;
            }
        }
        catch (PDOException $excecao) {
            echo "Erro ao logar: " . $excecao->getMessage();
        }
    }
    ?>

        <div class="container text-center">
            <h1 class="display-1 font-weight-normal mb-n2" >POP!</h1>
            <h5 class="ml-4">Liberdade para negociar.</h5>
            <br>
            <div class="card m-auto text-left" style="width: 24rem;">
                <!--Div usada para formartar o card de login -->
                <div class="card-body">
                    <form method="post">

                        <!--Entrada de email para login-->
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu email" required>
                        </div>

                        <!--Entrada de senha para login-->
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha" required>
                        </div>

                        <?php
                            if (isset($_SESSION['erro'])):
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

                    <!-- Esqueci a senha / Cadastre-se -->
                    <div class="text-right mt-3">
                        <span class="small"><a href="#">Esqueci minha senha</a> </span>
                        <span class="small ml-4 mr-2"><a href="#" data-toggle="modal" data-target="#modal">Cadastre-se</a> </span>
                    </div>
                </div>
            </div>
            <br>
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


<?php include 'footer.php' ?>

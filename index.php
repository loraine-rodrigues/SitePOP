<?php
    $title = "PÁGINA PRINCIPAL";

    include 'header.php' ?>

        <div class="container text-center">
            <h1 class="display-1 font-weight-normal mb-n2" >POP!</h1>
            <h5 class="ml-4">Liberdade para negociar.</h5>
            <br>
            <div class="card m-auto text-left" style="width: 24rem;">
                <!--Div usada para formartar o card de login -->
                <div class="card-body">
                    <form id="test">

                        <!--Entrada de email para login-->
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" id="email" placeholder="Digite seu email">
                        </div>

                        <!--Entrada de senha para login-->
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" id="senha" placeholder="Digite sua senha">
                        </div>

                        <!-- Botão entrar -->
                        <button type="submit" class="btn btn-outline-primary btn-block">Entrar </button>
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

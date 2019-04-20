<?php
$title = "CADASTRO CLIENTE";

include '../header.php' ?>



<div class="container text-center">
    <h1 class="font-weight-light text-white">CADASTRO CLIENTE</h1>
    <br>
    <div class="card m-auto text-left" style="width: 54rem;"> <!--Div usada para formartar o card de login -->
        <div class="card-body">
            <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
            <form>
                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" placeholder="Informe seu nome completo">
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Data de nascimento: </label>
                            <input type="date" class="form-control" id="data" placeholder="Informe sua data de nascimento">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--Celular para contato principal-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> CPF: </label>
                            <input type="tel" class="form-control" id="celular" placeholder="Celular para contato">
                        </div>
                    </div>

                    <!--Celular para contato de emergência-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular: </label>
                            <input type="tel" class="form-control" id="celular" placeholder="Celular para contato">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="email" class="form-control" id="email" placeholder="Informe seu email para login">
                        </div>
                    </div>

                    <!--Senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" id="senha" placeholder="Informe uma senha para login">
                        </div>
                    </div>

                    <!--Confirmar senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Confirmar senha: </label>
                            <input type="password" class="form-control" id="senha" placeholder="Informe uma senha para login">
                        </div>
                    </div>
                </div>

                <div class="row mt-5">

                    <!-- Termos de uso -->
                    <div class="col">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="checkTermo">
                            <label class="form-check-label" for="checkTermo"><a href="../termos.php">Ler termos de uso</a></label>
                        </div>                                                 <!-- Link para página de termos de uso-->
                    </div>

                        <!-- Botão de confirmar cadastro-->
                    <div class="col">
                        <button type="submit" class="btn btn-outline-success float-right mx-5">Confirmar </button> <!--Botão entrar-->
                    </div>
                </div>
            </form>
        </div>

        </div>
    </div>
    <br>
</div>

<?php include '../footer.php' ?>


<?php
$title = "PERFIL MOTOFRETISTA";

include 'header.php' ?>

<!-- Imagem -->
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload {
        width: 18em;
        height: 12em;
    }
</style>

<div class="container text-center">
    <h1 class="font-weight-light text-white"> PERFIL </h1>
    <br>
    <form method="post">

        <!--Div usada para formartar o card de login -->
        <div class="card m-auto text-left" style="width: 54rem;">
            <div class="card-body">
                <h3 class="card-title mb-4">SEUS DADOS PESSOAIS</h3>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" name="nome" id="nome" readonly>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                    <input type="text" class="form-control" name="data" id="data" readonly required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackData"> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="genero">Gênero: </label>
                                    <input type="text" class="form-control" name="genero" id="genero" readonly>
                                    <div class="invalid-feedback">
                                        Campo obrigatório
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="cnpj">CNPJ: </label>
                                    <input type="text" class="form-control" name="cnpj" id="cnpj" readonly required>
                                    <div class="invalid-feedback">
                                        <span id="feedbackCnpj"> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="mei">Possui MEI? </label>
                                    <input type="text" class="form-control" name="mei" id="mei" readonly>
                                    <div class="invalid-feedback">
                                        <span id="feedbackMei"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col text-center">
                        <!--Adicionar foto-->
                        <div class="row">
                            <div class="form-group">
                                <img id='img-upload' src="avatar.svg" class="rounded mb-2"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="cpf">CPF: </label>
                            <input type="text" class="form-control" name="cpf" id="cpf" readonly required>
                            <div class="invalid-feedback">
                                <span id="feedbackCpf"> </span>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="cnh">CNH: </label>
                            <input type=text class="form-control" name="cnh" id="cnh" readonly required>
                            <div class="invalid-feedback">
                                <span id="feedbackCnh"> </span>
                            </div>
                        </div>
                    </div>
                    <!--Númeração da cnh para cofirmar autorização p dirigir-->
                </div>
                <!--Checkboxes para seleção de região-->
                <div class="row">
                    <div class="col">
                        <label>Suas regiões de atuação:</label>
                    </div>
                </div>
            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
            <div class="card-body">


            <div class="card-body">
                    <h3 class="card-title mb-4">SEUS DADOS PARA CONTATO </h3>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="celular"> Celular/WhatsApp: </label> <!--WhatsApp para contato-->
                                <input type="tel" class="form-control" name="celular" id="celular" readonly required>
                                <div class="invalid-feedback">
                                    <span id="feedbackCelular"> </span>
                                </div>
                            </div>
                        </div>

                        <!--Opção de sexo, usado um select para aparecer as duas opções-->
                        <div class="col">
                            <div class="form-group">
                                <label for="celularAlternativo"> Celular: </label> <!--Celular para emergência-->
                                <input type="tel" class="form-control" name="celularAlternativo" id="celularAlternativo" readonly required>
                                <div class="invalid-feedback">
                                    <span id="feedbackCelularAlternativo"> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label for="email"> Email: </label>
                                <input type="text" class="form-control" name="email" id="email" readonly required>
                                <div class="invalid-feedback">
                                    <span id="feedbackEmail"> </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <!--Escolha uma senha que será usado para login-->
                        <div class="col">
                            <div class="form-group">
                                <label for="senha"> Senha: </label>
                                <input type="password" class="form-control" name="senha" id="senha" readonly required>
                                <div class="invalid-feedback">
                                    <span id="feedbackSenha"> </span>
                                </div>
                            </div>
                        </div>

                        <!--Confirme a senha que será usado para login-->
                        <div class="col">
                            <div class="form-group">
                                <label for="confirmarSenha"> Confirmar senha: </label>
                                <input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" readonly required>
                                <div class="invalid-feedback">
                                    <span id="feedbackConfirmarSenha"> </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <div class="card-body">
                <h3 class="card-title mb-4">DADOS DO SEU VEÍCULO</h3>
                <div class="row">

                    <!-- Marca do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="marca"> Marca: </label>
                            <input type="text" class="form-control" name="marca" id="marca" readonly required>
                        </div>
                    </div>

                    <!-- Modelo do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="modelo"> Modelo: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" name="modelo" id="modelo" readonly required>
                        </div>
                    </div>

                    <!-- Cor do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="cor"> Cor: </label>
                            <input type="text" class="form-control" name="cor" id="cor" readonly required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Placa do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="placa"> Placa: </label>
                            <input type="text" class="form-control" name="placa" id="placa" readonly required>
                        </div>
                    </div>

                    <!-- Renavam do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="renavam"> Renavam: </label>
                            <input type="text" class="form-control" name="renavam" id="renavam" readonly required>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <br>
</div>
<script>
    $(document).ready( function() {
        <!-- Mascara da label -->

        $("#celular").inputmask("(99)9999-9999[9]");
        $("#celularAlternativo").inputmask("(99)9999-9999[9]");
        $("#cpf").inputmask("999.999.999-99");
        $("#cnpj").inputmask("99.999.999/9999-99");
        $("#cnh").inputmask("99999999999");
        $("#renavam").inputmask("99999999999");
        $("#placa").inputmask("AAA-9999");
        $("#email").inputmask("email");
        $("#data").inputmask("dd/mm/yyyy");



    });
</script>

<?php include 'footer.php' ?>


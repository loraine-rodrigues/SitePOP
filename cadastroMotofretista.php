<?php
$title = "CADASTRO MOTOFRETISTA";

include 'header.php' ?>

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
    <h1 class="font-weight-light text-white">CADASTRO MOTOFRETISTA</h1>
    <br>
    <div class="card m-auto text-left" style="width: 54rem;"> <!--Div usada para formartar o card de login -->
        <div class="card-body">
            <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
            <form>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>               <!--Nome motofretista-->
                            <input type="text" class="form-control" id="nome" placeholder="Informe seu nome completo">
                        </div>

                        <div class="row">
                             <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                    <input type="date" class="form-control" id="data" placeholder="Informe sua data de nascimento">
                                </div>
                             </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="sexo">Sexo: </label>
                                    <select class="form-control" id="sexo"> <!--Opção de sexo, usado um select para aparecer as duas opções-->
                                        <option> Selecione </option>
                                        <option> Masculino </option>
                                        <option> Feminino </option>
                                    </select>
                                </div>
                             </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="celular"> Celular: </label> <!--Celular para contato principal-->
                                    <input type="tel" class="form-control" id="celular" placeholder="Celular para contato">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="celularAlternativo"> Celular: </label> <!--Celular secundário-->
                                    <input type="tel" class="form-control" id="celularAlternativo" placeholder="Celular alternativo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="form-group">
                            <img id='img-upload' src="avatar.svg" class="rounded mb-2"/>
                            <div class="input-group mt-1">
                                <span class="input-group-btn">
                                    <span class="btn btn-outline-primary btn-file">
                                        Escolher uma foto... <input type="file" id="imgInp">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="cpf">CPF: </label>          <!--Cpf para confirmar identidade-->
                            <input type="text" class="form-control" id="cpf" placeholder="Informe seu cpf">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="cnpj">CNPJ: </label>        <!--Cnpj para confirmar autonomia-->
                            <input type="text" class="form-control" id="cnpj" placeholder="Informe seu cpf">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="cnh">CNH: </label> <!--Númeração da cnh para cofirmar autorização p dirigir-->
                            <input type=text class="form-control" id="cnh" placeholder="Informe o número da cnh">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>     <!--Email que será usado para login-->
                            <input type="email" class="form-control" id="email" placeholder="Informe seu email para login">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>     <!--Email que será usado para login-->
                            <input type="password" class="form-control" id="senha" placeholder="Informe uma senha para login">
                        </div>
                    </div>
                </div>
        </div>

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="card-body">
            <h3 class="card-title mb-4">DADOS DO VEÍCULO</h3>
            <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="marca"> Marca: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" id="marca" placeholder="Informe a marca do veiculo">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="modelo"> Modelo: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" id="modelo" placeholder="Informe o modelo do veículo">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="cor"> Cor: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" id="cor" placeholder="Informe a cor do ve;iculo">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="placa"> Placa: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" id="placa" placeholder="Informe a placa do veiculo">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="renavam"> Renavam: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" id="renavam" placeholder="Informe o numero do renavam">
                        </div>
                    </div>
                </div>

            <div class="row mt-5">
                <div class="col">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1"><a href="termos.php">Ler termos de uso</a></label>
                    </div>
                </div>


                <div class="col">
                    <button type="submit" class="btn btn-outline-success float-right mx-5">Confirmar </button> <!--Botão entrar-->
                </div>
            </div>

        </form>

        </div>
    </div>
    <br>
</div>

<script>
    $(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });
    });
</script>

<?php include 'footer.php' ?>


<?php
require ("../conexao.php");


            $comando = $conexao->prepare("CALL editarMotofretista(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $comando->bindParam(1, $id);
            $comando->bindParam(2, $nome);
            $comando->bindParam(3, $celular);
            $comando->bindParam(4, $telefone);
            $comando->bindParam(5, $email);
            $comando->bindParam(6, $cpf);
            $comando->bindParam(7, $cnpj);
            $comando->bindParam(8, $cnh);
            $comando->bindParam(9, $genero);
            $comando->bindParam(10, $regiao);
            $comando->bindParam(11, $nascimento);
            $comando->bindParam(12, $mei);
            $comando->bindParam(13, $placa);
            $comando->bindParam(14, $renavam);
            $comando->bindParam(15, $modelo);
            $comando->bindParam(16, $cor);
            $comando->bindParam(17, $marca);
            $comando->execute();

          
?>

<div class="container text-center">
    <h1 class="font-weight-light text-white">EDITAR MOTOFRETISTA</h1>
    <br>
    <form>

        <!--Div usada para formartar o card de login -->
        <div class="card m-auto text-left" style="width: 54rem;">
            <div class="card-body">
                <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
                <div class="row">

                    <!--Nome motofretista-->
                    <div class="col">
                    <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome; ?>" readonly>
                        </div>

                                            
                        <div class="row">
                             <div class="col">
                                <div class="form-group">
                                    <label for="data"> Data de nascimento: </label> <!--Data de nascimento-->
                                    <input type="date" class="form-control" name="nascimento" id="nasc" value="<?php echo $nascimento; ?>" readonly>
                                </div>
                             </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="sexo">Gênero: </label>
                                    <select class="form-control" name="genero" id="sexo" value="<?php echo $genero; ?>" readonly> <!--Opção de sexo, usado um select para aparecer as duas opções-->
                                        <option> Selecione </option>
                                        <option> Masculino </option>
                                        <option> Feminino </option>
                                        <option> Outro </option>
                                    </select>
                                </div>
                             </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="celular"> Celular/WhatsApp: </label> <!--WhatsApp para contato-->
                                    <input type="tel" class="form-control" name="cel" id="cel" value="<?php echo $celular; ?>" readonly>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="celularAlternativo"> Celular: </label> <!--Celular para emergência-->
                                    <input type="tel" class="form-control" name="tel" id="tel" value="<?php echo $telefone; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Adicionar foto-->
                    <div class="col text-center">
                        <div class="form-group">
                            <img id='img-upload' src="../avatar.svg" class="rounded mb-2"/>
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

                    <!--Cpf para confirmar identidade-->
                    <div class="col">
                            <div class="form-group">
                                <label for="cpf">CPF: </label>
                                <input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo $cpf; ?>" readonly>
                            </div>
                    </div>

                    <!--Cnpj para confirmar autonomia-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cnpj">CNPJ: </label>
                            <input type="text" class="form-control" name="cnpj" id="cnpj" value="<?php echo $cnpj; ?>" readonly>
                        </div>
                    </div>

                    <!--Opção de sexo, usado um select para aparecer as duas opções-->
                    <div class="col">
                        <div class="form-group">
                            <label for="sexo">Possui MEI? </label>
                            <select class="form-control" id="mei" name="mei" value="<?php echo $mei; ?>" readonly>
                                <option> Selecione </option>
                                <option> SIM </option>
                                <option> NÃO </option>
                            </select>
                        </div>
                    </div>

                    <!--Númeração da cnh para cofirmar autorização p dirigir-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cnh">CNH: </label>
                            <input type=text class="form-control" name="cnh" id="cnh" value="<?php echo $cnh; ?>" readonly>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" readonly>
                        </div>
                    </div>

                    <!--Escolha uma senha que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" name="senha" id="senha" value="<?php echo $senha; ?>" readonly>
                        </div>
                    </div>

                    <!--Confirme a senha que será usado para login-->
                    

                </div>
            </div>

                    <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <div class="card-body">
                <h3 class="card-title mb-4">DADOS DO VEÍCULO</h3>
                <div class="row">

                    <!-- Marca do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="marca"> Marca: </label>
                            <input type="text" class="form-control" name="marca" id="marca" value="<?php echo $marca; ?>" readonly>
                        </div>
                    </div>

                     <!-- Modelo do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="modelo"> Modelo: </label>     <!--Email que será usado para login-->
                            <input type="text" class="form-control" name="modelo" id="modelo" value="<?php echo $modelo; ?>" readonly>
                        </div>
                    </div>

                     <!-- Cor do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="cor"> Cor: </label>
                            <input type="text" class="form-control" name="cor" id="cor" value="<?php echo $cor; ?>" readonly>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Placa do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="placa"> Placa: </label>
                            <input type="text" class="form-control" name="placa" id="placa" value="<?php echo $placa; ?>" readonly>
                        </div>
                    </div>

                    <!-- Renavam do veículo -->
                    <div class="col">
                        <div class="form-group">
                            <label for="renavam"> Renavam: </label>
                            <input type="text" class="form-control" name="renavam" id="renavam" value="<?php echo $renavam; ?>" readonly>
                        </div>
                    </div>

                   

                </div>

                <div class="row mt-5">

                     <!-- Botão confirmar -->
                    <div class="col">
                        <button type="submit" name="confirmarCadastro" class="btn btn-outline-success float-right mx-5">Confirmar </button> <!--Botão entrar-->
                    </div>

                </div>

            </div>
        </div>
    </form>
    <br>
</div>

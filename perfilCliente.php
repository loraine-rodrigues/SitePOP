<?php
$title = "PERFIL CLIENTE";

include 'header.php';
?>


<div class="container text-center">
    <h1 class=" ml-5">PERFIL CLIENTE</h1>
    <div class="card mx-auto my-5 text-left" style="width: 54rem;"> <!--Div usada para formartar o card de login -->
        <div class="card-body">

            <?php
            if (isset($erro)):     //Mensagem de erro no cadastro
                ?>
                <div class="alert alert-danger">
                    <?php echo $erro; ?>
                </div>
            <?php
            endif;
            ?>

            <?php
            if (isset($mensagem)):   //Mensagem de sucesso no cadastro
                ?>
                <div class="alert alert-success">
                    <?php echo $mensagem; ?>
                </div>
            <?php
            endif;
            ?>

            <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
            <form method="post" id="form" class="needs-validation" novalidate>
                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" name="nome" readonly>
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Data de nascimento: </label>
                            <input type="text" class="form-control" id="data" name="nascimento" readonly>
                            <div class="invalid-feedback">
                                <span id="feedbackData"> </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--CPF-->
                    <div class="col">
                        <div class="form-group">
                            <label for="cpf"> CPF: </label>
                            <input type="text" class="form-control" id="cpf" name="cpf" readonly>
                            <div class="invalid-feedback">
                                <span id="feedbackCpf"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Celular para contato de emergência-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular: </label>
                            <input type="text" class="form-control" id="celular" name="celular" readonly>
                            <div class="invalid-feedback">
                                <span id="feedbackCelular"> </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!--Email que será usado para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" id="email" name="email" readonly>
                            <div class="invalid-feedback">
                                <span id="feedbackEmail"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" id="senha" name="senha" readonly>
                            <div class="invalid-feedback">
                                <span id="feedbackSenha"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Confirmar senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="confirmarSenha"> Confirmar senha: </label>
                            <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" readonly>
                            <div class="invalid-feedback">
                                <span id="feedbackConfirmarSenha"> </span>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
</div>

<script>
    //Formato das mascaras

    celular.inputmask("(99)9999-9999[9]", {removeMaskOnSubmit: true});
    cpf.inputmask("999.999.999-99", {removeMaskOnSubmit: true});
    email.inputmask("email");
    nome.inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});
    data.inputmask("datetime", {placeholder: "DD/MM/AAAA", inputFormat: "dd/mm/yyyy", max: "01/01/1998", min: "01/01/1919", outputFormat: "yyyy-mm-dd", removeMaskOnSubmit: true});

</script>
<?php include 'footer.php' ?>


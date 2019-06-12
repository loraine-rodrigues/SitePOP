<?php
$title = "CADASTRO CLIENTE";

include '../header.php';
require '../conexao.php';

if (isset($_POST['confirmarCadastro'])) {
    foreach ($_POST as $campo) {
        if (empty($campo)) {
            $erro = "<li>É necessário preencher todos os campos</li>";
        }
    }

    if ($_POST ['senha'] != $_POST ['confirmarSenha']) {
        $erro .= "<li>As senhas estão diferentes</li>";
    }

    if ($_POST['termos'] != TRUE) {
        $erro .= "<li>É necessário ler e aceitar os termos para prosseguir</li>";
    }

    if (empty($erro)) {
        try {
            $nome = $_POST ['nome'];
            $nascimento = $_POST ['nascimento'];
            $cpf = $_POST ['cpf'];
            $celular = $_POST ['celular'];
            $email = $_POST ['email'];
            $senha = $_POST ['senha'];
            $confirmarSenha = $_POST ['confirmarSenha'];
            $termos = $_POST ['termos'];

            $comando = $conexao->prepare("CALL cadastrarCliente(?, ?, ?, ?, ?, ?)");
            $comando->bindParam(1, $nome);
            $comando->bindParam(2, $nascimento);
            $comando->bindParam(3, $cpf);
            $comando->bindParam(4, $email);
            $comando->bindParam(5, $celular);
            $comando->bindParam(6, $senha);
            $comando->execute();

            $mensagem = "Cliente cadastrado com sucesso<br/>Clique <a href='../home.php'>aqui</a> para efetuar login";
        } catch (PDOException $excecao) {
            $erro = "Erro ao cadastrar clientes";
//            $excecao->getMessage();
        }
    }
}
?>

<div class="container text-center">
    <h1 class=" ml-5">CADASTRO CLIENTE</h1>
    <div class="card mx-auto my-5 text-left" style="width: 54rem;"> <!--Div usada para formartar o card de login -->
        <div class="card-body">

            <?php
            if (isset($erro)) {     //Mensagem de erro no cadastro
                ?>
                <div class="alert alert-danger">
                    <?php echo "<ul style='margin-bottom: 0 !important;'>" . $erro . "</ul>" ?>
                </div>
                <?php
            }
            ?>

            <?php
            if (isset($mensagem)) {   //Mensagem de sucesso no cadastro
                ?>
                <div class="alert alert-success">
                    <?= $mensagem ?>
                </div>
                <?php
            }
            ?>

            <h3 class="card-title mb-4">DADOS PESSOAIS</h3>
            <form method="post" id="form" class="needs-validation">
                <div class="row">

                    <!--Nome completo do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="nome"> Nome: </label>
                            <input type="text" class="form-control" id="nome" name="nome"
                                   placeholder="Informe seu nome completo">
                            <div class="invalid-feedback">
                                Campo obrigatório
                            </div>
                        </div>
                    </div>

                    <!--Data de nascimento do cliente-->
                    <div class="col">
                        <div class="form-group">
                            <label for="data"> Data de nascimento: </label>
                            <input type="text" class="form-control" id="data" name="nascimento"
                                   placeholder="Informe sua data de nascimento">
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
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe seu CPF">
                            <div class="invalid-feedback">
                                <span id="feedbackCpf"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Celular para contato de emergência-->
                    <div class="col">
                        <div class="form-group">
                            <label for="celular"> Celular: </label>
                            <input type="text" class="form-control" id="celular" name="celular"
                                   placeholder="Celular para contato">
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
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="Informe seu email para login">
                            <div class="invalid-feedback">
                                <span id="feedbackEmail"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" id="senha" name="senha"
                                   placeholder="Informe uma senha para login">
                            <div class="invalid-feedback">
                                <span id="feedbackSenha"> </span>
                            </div>
                        </div>
                    </div>

                    <!--Confirmar senha que será usada para login-->
                    <div class="col">
                        <div class="form-group">
                            <label for="confirmarSenha"> Confirmar senha: </label>
                            <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha"
                                   placeholder="Confirme a senha para login">
                            <div class="invalid-feedback">
                                <span id="feedbackConfirmarSenha"> </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row mt-5">

                    <!-- Termos de uso -->
                    <div class="col">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="checkTermo" name="termos">
                            <label for="termos">Eu li e aceito os </label>
                            <label class="form-check-label" for="checkTermo"><a href="#" data-toggle="modal"
                                                                                data-target="#modal">termos de
                                    uso</a></label>
                            <div class="invalid-feedback">
                                É necessário aceitar os termos de uso
                            </div>
                        </div>                                                 <!-- Link para página de termos de uso-->
                    </div>

                    <!-- Botão de confirmar cadastro-->
                    <div class="col">
                        <button type="submit" name="confirmarCadastro" value="ok" class="btn btn-outline-success float-right mx-5">
                            Confirmar
                        </button> <!--Botão entrar-->
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
</div>

<script>
    $(document).ready(() => {
        var form = $("#form");
        var nome = $("#nome");
        var data = $("#data");
        var cpf = $("#cpf");
        var celular = $("#celular");
        var email = $("#email");
        var senha = $("#senha");
        var feedbackSenha = $("#feedbackSenha");
        var confirmarSenha = $("#confirmarSenha");
        var feedbackConfirmarSenha = $("#feedbackConfirmarSenha");



        //Validação ao digitar no campo

        nome.keyup(() => {
            if (nome.val().length > 0) {
                nome.get(0).setCustomValidity('');
            } else {
                nome.get(0).setCustomValidity('Inválido');
            }
        });

        data.keyup(() => {
            data = $("#data");
            var feedbackData = $("#feedbackData");
            if (data.val().length > 0) {
                if (Inputmask.isValid(data.val(), {alias: "datetime", inputFormat: "dd/mm/yyyy"})) {
                    data.get(0).setCustomValidity('');
                    feedbackData.text("");
                } else {
                    feedbackData.text("Digite uma data válida");
                    data.get(0).setCustomValidity('Inválido');
                }
            } else{
                feedbackData.text("Campo obrigatório");
                data.get(0).setCustomValidity('Inválido');
            }
        });

        cpf.keyup(() => {
            cpf = $("#cpf");
            var feedbackCpf = $("#feedbackCpf");
            if (cpf.val().length > 0) {
                if (validarCPF(cpf.val())) {
                    cpf.get(0).setCustomValidity('');
                    feedbackCpf.text("");
                } else {
                    feedbackCpf.text("Digite um CPF válido");
                    cpf.get(0).setCustomValidity('Inválido');
                }
            } else{
                feedbackCpf.text("Campo obrigatório");
                cpf.get(0).setCustomValidity('Inválido');
            }
        });

        celular.keyup(() => {
            celular = $("#celular");
            var feedbackCelular = $("#feedbackCelular");
            if (celular.val().length > 0) {
                if (Inputmask.isValid(celular.val(), "(99)9999-9999[9]")) {
                    celular.get(0).setCustomValidity('');
                    feedbackCelular.text("");
                } else {
                    feedbackCelular.text("Digite um celular válido");
                    celular.get(0).setCustomValidity('Inválido');
                }
            } else{
                feedbackCelular.text("Campo obrigatório");
                celular.get(0).setCustomValidity('Inválido');
            }
        });

        email.keyup(() => {
            email = $("#email");
            var feedbackEmail = $("#feedbackEmail");
            if (email.val().length > 0) {
                if (Inputmask.isValid(email.val(), {alias: "email"})) {
                    email.get(0).setCustomValidity('');
                    feedbackEmail.text("");
                } else {
                    email.get(0).setCustomValidity('Inválido');
                    feedbackEmail.text("Digite um email válido");
                }
            } else {
                feedbackEmail.text("Campo obrigatório");
                email.get(0).setCustomValidity('Inválido');
            }
        });

        senha.keyup(() => {
            senha = $("#senha");
            confirmarSenha = $("#confirmarSenha");
            feedbackSenha = $("#feedbackSenha");
            feedbackConfirmarSenha = $("#feedbackConfirmarSenha");
            if (senha.val().length > 0) {
                feedbackSenha.text("");
                if (senha.val() === confirmarSenha.val()) {
                    senha.get(0).setCustomValidity('');
                    confirmarSenha.get(0).setCustomValidity('');
                    feedbackConfirmarSenha.text("");
                } else {
                    senha.get(0).setCustomValidity('Inválido');
                    confirmarSenha.get(0).setCustomValidity('Inválida');
                    feedbackConfirmarSenha.text("Senhas não conferem");
                }
            } else {
                senha.get(0).setCustomValidity('Inválido');
                confirmarSenha.get(0).setCustomValidity('Inválida');
                feedbackSenha.text("Campo obrigatório");
            }
        });

        confirmarSenha.keyup(() => {
            senha = $("#senha");
            confirmarSenha = $("#confirmarSenha");
            feedbackSenha = $("#feedbackSenha");
            feedbackConfirmarSenha = $("#feedbackConfirmarSenha");
            if (confirmarSenha.val().length > 0) {
                if (senha.val() === confirmarSenha.val()) {
                    senha.get(0).setCustomValidity('');
                    confirmarSenha.get(0).setCustomValidity('');
                    feedbackConfirmarSenha.text("");
                } else {
                    senha.get(0).setCustomValidity('Inválido');
                    confirmarSenha.get(0).setCustomValidity('Inválida');
                    feedbackConfirmarSenha.text("Senhas não conferem");
                }
            } else {
                senha.get(0).setCustomValidity('Inválido');
                confirmarSenha.get(0).setCustomValidity('Inválida');
                feedbackConfirmarSenha.text("Campo obrigatório");
            }
        });

        //Validação quando o formulario é confirmado

        form.submit(() => {

            nome = $("#nome");
            data = $("#data");
            var dataValida = Inputmask.isValid(data.val(), {alias: "datetime", inputFormat: "dd/mm/yyyy" });
            cpf = $("#cpf");
            var cpfValido = validarCPF(cpf.val());
            celular = $("#celular");
            var celularValido = Inputmask.isValid(celular.val(), "(99)9999-9999[9]");
            email = $("#email");
            var emailValido = Inputmask.isValid(email.val(),{alias: "email"});
            senha = $("#senha");
            confirmarSenha = $("#confirmarSenha");


            if (nome.val().length > 0){
                nome.get(0).setCustomValidity('');
            } else {
                nome.get(0).setCustomValidity('Inválido');
            }

            var feedbackData = $("#feedbackData");
            if (data.val().length > 0) {
                if (dataValida) {
                    feedbackData.text("");
                    data.get(0).setCustomValidity('');
                } else {
                    feedbackData.text("Digite um CPF válido");
                    data.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackData.text("Campo obrigatório");
                data.get(0).setCustomValidity('Inválido');
            }

            var feedbackCpf = $("#feedbackCpf");
            if (cpf.val().length > 0) {
                if (cpfValido) {
                    feedbackCpf.text("");
                    cpf.get(0).setCustomValidity('');
                } else {
                    feedbackCpf.text("Digite um CPF válido");
                    cpf.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackCpf.text("Campo obrigatório");
                cpf.get(0).setCustomValidity('Inválido');
            }

            var feedbackCelular = $("#feedbackCelular");
            if (celular.val().length > 0) {
                if (celularValido) {
                    feedbackCelular.text("");
                    celular.get(0).setCustomValidity('');
                } else {
                    feedbackCelular.text("Digite um celular válido");
                    celular.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackCelular.text("Campo obrigatório");
                celular.get(0).setCustomValidity('Inválido');
            }

            var feedbackEmail = $("#feedbackEmail");
            if (email.val().length > 0) {
                if (emailValido) {
                    feedbackEmail.text("");
                    email.get(0).setCustomValidity('');
                } else {
                    feedbackEmail.text("Digite um email válido");
                    email.get(0).setCustomValidity('Inválido');
                }
            } else {
                feedbackEmail.text("Campo obrigatório");
                email.get(0).setCustomValidity('Inválido');
            }

            feedbackSenha = $("#feedbackSenha");
            feedbackConfirmarSenha = $("#feedbackConfirmarSenha");
            if (senha.val().length > 0) {
                feedbackSenha.text("");
                if (confirmarSenha.val().length > 0) {
                    if (senha.val() === confirmarSenha.val()) {
                        senha.get(0).setCustomValidity('');
                        confirmarSenha.get(0).setCustomValidity('');
                        feedbackConfirmarSenha.text("");
                    } else {
                        senha.get(0).setCustomValidity('Inválido');
                        confirmarSenha.get(0).setCustomValidity('Inválida');
                        feedbackConfirmarSenha.text("Senhas não conferem");
                    }
                } else {
                    senha.get(0).setCustomValidity('Inválido');
                    confirmarSenha.get(0).setCustomValidity('Inválida');
                    feedbackConfirmarSenha.text("Este campo é obrigatório")
                }
            } else {
                senha.get(0).setCustomValidity('Inválido');
                confirmarSenha.get(0).setCustomValidity('Inválida');
                feedbackSenha.text("Campo obrigatório");
                if (confirmarSenha.val().length <= 0) {
                    feedbackConfirmarSenha.text("Campo obrigatório")
                }
            }

            form.addClass('was-validated');

            return form[0].checkValidity();
        });

        //Formato das mascaras

        celular.inputmask("(99)9999-9999[9]", {removeMaskOnSubmit: true});
        cpf.inputmask("999.999.999-99", {removeMaskOnSubmit: true});
        email.inputmask("email");
        nome.inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});
        data.inputmask("datetime", {placeholder: "DD/MM/AAAA", inputFormat: "dd/mm/yyyy", max: "01/01/1998", min: "01/01/1919", outputFormat: "yyyy-mm-dd", removeMaskOnSubmit: true});

        //Validação de CPF

        var validarCPF = (cpf) =>  {
            cpf = cpf.replace(/[^\d]+/g,'');
            if(cpf == '') return false;
            // Elimina CPFs invalidos conhecidos
            if (cpf.length != 11 ||
                cpf == "00000000000" ||
                cpf == "11111111111" ||
                cpf == "22222222222" ||
                cpf == "33333333333" ||
                cpf == "44444444444" ||
                cpf == "55555555555" ||
                cpf == "66666666666" ||
                cpf == "77777777777" ||
                cpf == "88888888888" ||
                cpf == "99999999999")
                return false;
            // Valida 1o digito
            add = 0;
            for (i=0; i < 9; i ++)
                add += parseInt(cpf.charAt(i)) * (10 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(9)))
                return false;
            // Valida 2o digito
            add = 0;
            for (i = 0; i < 10; i ++)
                add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10)))
                return false;
            return true;
        }


    });
</script>
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Conteúdo do modal -->
        <div class="modal-content">

            <!-- Titulo do modal -->
            <div class="modal-header">
                <h3 class="modal-title col-md-11 text-center">TERMOS DE USO</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>O presente termo regulará as operações e prestações de serviços entre a POP! Motofrete, seus usuários e associados, pessoas jurídicas ou físicas, em todo território nacional, sendo a sua observância obrigatória para fruição do sistema.</p>

                <h4>1 – PROPOSTA DO SISTEMA</h4>
                <p>O POP! Motofrete disponibilizará o seu sistema aos seus usuários e associados para fins de contratação do serviço de motofrete, por meio de seleção do motofretista e cotação, feito externamente através  dos contatos profissionais fornecidos pelo prestador de serviço na plataforma.</p>
                <p>Mediante a escolha do perfil dos cadastrados, pelos usuários e pelos associados, ambos terão a possibilidade de negociarem a  cotação com diversos participantes, cujo resultado  será a os ajustes de acordo a necessidade de cada entrega e cada cliente.</p>

                <h5>1. 1 PRINCIPAIS CARACTERÍSTICAS DO SISTEMA:</h5>
                <p>Perfil completo dos prestadores de transportes, dados do veículo,  localidades atendidas, bem como os meio para contato: telefone com aplicativo para mensagens instantâneas (whats’app) e telefone de emergência.</p>
                <p>Diversos clientes cadastrados e com interesse na contratação de serviços, disponibilizando as principais informações de nome e telefone.</p>

                <h5>1.2 ALGUMAS VANTAGENS DO SISTEMA</h5>
                <p>O sistema irá exibir os dados do motofretista de acordo com o filtro de região que o usuário selecionar, possibilitando aos usuários e aos associados traçar o perfil do proponente para fins de pesquisa no nosso vasto banco de dados, contando com diversos  prestadores de serviços.
                <p>As propostas serão enviadas pelo cliente ao motofretista, por meio do contato fornecido no perfil, de forma que ambos podem ajustar as necessidades de acordo com cada cliente e entrega, sem que haja intermediadores ou regras impostas pela plataforma.</p>
                <p>O sistema  não irá interferir nas cotações, valores e formas de pagamento. Ficando assim estabelecido que cliente e motofretista acordem entre si as métricas da proposta de serviço.</p>
                <p>No caso do usuário fazer o pagamento pontual e diretamente ao prestador de serviço, o POP! Motofrete não terá nenhuma responsabilidade, inclusive de natureza tributária e fiscal. Nesta modalidade de contratação, tanto prestador de serviços quanto cliente ficam responsáveis por acordarem o local, formas de pagamento, valores, e se houver,  taxas e juros pela cobrança da conclusão do serviço de entregas.</p>
                <p>O sistema possui restrições para o cadastro dos usuários e dos associados, o que garantirá aos interessados uma seleção de clientes e de prestadores de serviços com qualidade e credibilidade.</p>
                <p>A indicação  e divulgação do proponente dos serviços ao cliente não configura nenhuma contratação, sendo está efetivada somente após o aceite do contrato celebrado entre as partes.</p>

                <h4>2 – MANUTENÇÃO DO SISTEMA</h4>
                <p>O sistema será periodicamente revisado para melhoria da sua funcionalidade, por esta razão, poderão ocorrer paralizações para manutenção, fora do horário comercial, sem prévio aviso.</p>

                <h4>3 – UTILIZAÇÃO DO SISTEMA</h4>
                <p>Os participantes do sistema, usuário ou associado, aceitam todos os termos e as condições aqui estabelecidas de forma livre e espontânea vontade, sendo, exclusivamente, responsáveis pelas informações prestadas, bem como pelos compromissos assumidos de seleção, negociação e recebimento de valores e itens.</p>
                <p>Os usuários e os participantes se comprometem a utilizar o sistema com observância dos termos e das condições aqui pactuadas, devendo proteger integralmente os direitos de terceiros e do POP! Motofrete.</p>
                <p>É terminantemente proibido, ao usuário e ao associado, ao uso indevido das informações obtidas no sistema, bem como a cópia e a reprodução, incluindo a distribuição ou divulgação, de conteúdo do site.</p>
                <p>O usuário prestador do serviço poderá, por meio do seu perfil gerado com as informações fornecidas por ele, alterar informações sobre seu cadastro e veículo. No entanto, os dados do veículo passarão por solicitação da documentação atual e revalidação pelo  POP! Motofrete.</p>

                <h4>4 – DIREITOS AUTORAIS E MARCAS RESERVADOS AO POP! Motofrete</h4>
                <p>O sistema é protegido pela Lei nº 9.610/98, sendo as suas informações e produtos de uso exclusivo do  POP! Motofrete, sendo, em caso de desrespeito a esta Lei, passível de sanção cível e penal.</p>
                <p>A proprietária do sistema não cede ou transferência nenhuma autorização uso ou exploração dos direitos reservados a ela.</p>

                <h4>5 – DISPONIBILIDADE DO SISTEMA E DOS SEUS CONTEÚDOS</h4>
                <p>A proprietária poderá interromper os serviços em caso de manutenção ou fatores alheios à sua vontade, não gerando ao usuário ou ao associado qualquer direito à indenização, seja a que título for.</p>

                <h4>6 – PROTEÇÃO DO SISTEMA</h4>
                <p>Para evitar qualquer dano ao sistema, os usuários e os associados se comprometem a utilizar antivírus, versão mais atualizada. Além de manterem suas informações restritas apenas ao seu uso pessoal, não fornecendo sua senha e e-mail para terceiros.</p>

                <h4>7 – RESPONSABILIDADE</h4>
                <p>O uso das informações disponibilizadas no sistema não dará direito à indenização de qualquer natureza, seja a que título for e em qualquer tempo.</p>
                <p>O POP! Motofrete não se responsabilizará pelos negócios gerados pelo sistema entre o prestador se serviços e o contratante nem a carga transportada. Já que toda a negociação se passa externamente, sem que haja qualquer fator que relacione dependência da plataforma para verificação da entrega.</p>

                <h4>8 – GARANTIA DE ENTREGA</h4>
                <p>A plataforma se isenta de oferecer  serviço de garantia de entrega, na qual o POP! Motofrete não se responsabilizará por eventuais perdas ocorridas.</p>
                <p>Colaboraremos com eventuais consultas de dados e informações sobre o cadastro do motofretista para que haja transparência e ausência de equívocos no ínterim da entrega. Para que assim, seja evitado danos por insuficiência de informações do prestador de serviço.</p>

                <h4>9 – RESTRIÇÃO AO USO DESTE WEBSITE</h4>
                <p>O POP! Motofrete, em função de uso irregular do sistema e dos seus conteúdos, reserva-se no direito de recusar ou retirar o acesso do usuário ou do associado, sem aviso prévio, em caso de fraude, simulação, determinação judicial ou identificação de atividades irregulares.</p>

                <h4>10 – VIGÊNCIA</h4>
                <p>O prazo de duração deste sistema é indeterminado.</p>

                <h4>11 –PLANO PREMIUM(monetização do site - Forma 1)</h4>
                Em elaboração
                <p>Em caso de opção do usuário pela contratação do PLANO PREMIUM que oferece recursos extras na plataforma como: xxx xxx xxx xxxx xxx , será selecionado o  sistema de pagamento mensal ao  POP! Motofrete por meio de ______________  todo dia _____.</p>
                <p>O valor da taxa de serviço Premium pelo uso do sistema do POP! Motofrete poderá ser conferido antes do aceite do serviço de cadastro nessa modalidade, sendo da sua única e exclusiva vontade acerca da aceitação ou não proposta de serviços. Esse valor também poderá sofrer alterações e /ou promoções com aviso prévio ao usuário cadastrado no plano para que fique ciente de qualquer mudança.</p>
                <p>O usuário poderá cancelar a qualquer momento o Plano Premium, ou acrescentar novos recursos. Em caso de escolha das opções de cancelamento ou migração o usuário se compromete a efetuar o pagamento do período utilizado.</p>
                <br>
                <h4>12 – DISPOSIÇÕES GERAIS</h4>
                <p>O uso do sistema não gera qualquer relação de dependência entre os usuários ou com o POP! Motofrete, nem vínculo de emprego.</p>

                <h4>13 – FORO DE ELEIÇÃO</h4>
                <p>O usuário e o associado aceita a eleição do Foro Central da Comarca da Capital do Estado de São Paulo, com exclusão de qualquer outro por mais privilegiado que seja.</p>
            </div>
        </div>
    </div>

<?php include '../footer.php' ?>

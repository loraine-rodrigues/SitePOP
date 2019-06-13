$(document).ready( () => {
    //teste de script para pegar imagem
    var somenteLeitura = $(".somenteLeitura");

    somenteLeitura.keydown(function(e){
        e.preventDefault();
    });

    somenteLeitura.bind('cut copy paste', function (e){
        e.preventDefault();
    });

    $("#img-input").change(() => {
        var input = $('#img-input')[0];

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = (e) => {
                var url = input.files[0].name.toLowerCase();
                console.log(url);
                if (url.endsWith("jpg") || url.endsWith("jpeg") || url.endsWith("png")) {
                    console.log(input.files[0].name);
                    $('#img-uploaded').attr('src', e.target.result);
                    $('#img-text').val(input.files[0].name);
                    $("#img-input").get(0).setCustomValidity('');
                } else {
                    $("#img-input").get(0).setCustomValidity('Inválido');
                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    });   //fim do script de pegar imagem

    var form = $("#form");

    var nome = $("#nome");

    var data = $("#data");
    var feedbackData = $("#feedbackData");

    var genero = $("#genero");

    var celular = $("#celular");
    var feedbackCelular = $("#feedbackCelular");

    var celularAlternativo = $("#celularAlternativo");
    var feedbackCelularAlternativo = $("#feedbackCelularAlternativo");

    var regioes = $("input[name^='regiao']");
    var regioesValidas = false;
    regioes.each((regiao) => {
        if (regioes.get(regiao).checked) {
            regioesValidas = true;
        }
    });

    var cpf = $("#cpf");
    var feedbackCpf = $("#feedbackCpf");

    var cnpj = $("#cnpj");
    var feedbackCnpj = $("#feedbackCnpj");

    var mei = $("#mei");
    var feedbackMei = $("#feedbackMei");

    var cnh = $("#cnh");
    var feedbackCnh = $("#feedbackCnh");

    var email = $("#email");
    var feedbackEmail = $("#feedbackEmail");

    var senha = $("#senha");
    var feedbackSenha = $("#feedbackSenha");

    var confirmarSenha = $("#confirmarSenha");
    var feedbackConfirmarSenha = $("#feedbackConfirmarSenha");

    var marca = $("#marca");
    var modelo = $("#modelo");
    var cor = $("#cor");

    var placa = $("#placa");
    var feedbackPlaca = $("#feedbackPlaca");

    var renavam = $("#renavam");
    var feedbackRenavam = $("#feedbackRenavam");

    var termos = $("#termos");

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

    cnpj.keyup(() => {
        cnpj = $("#cnpj");
        if (cnpj.val().length > 0) {
            if (validarCNPJ(cnpj.val())) {
                cnpj.get(0).setCustomValidity('');
                feedbackCnpj.text("");
            } else {
                cnpj.get(0).setCustomValidity('Inválido');
                feedbackCnpj.text("Digite um CNPJ válido");
            }
        } else {
            cnpj.get(0).setCustomValidity('Inválido');
            feedbackCnpj.text("Campo obrigatório");
        }
    });

    cnh.keyup(() => {
        cnh = $("#cnh");
        if (cnh.val().length > 0) {
            if (validarCNH(cnh.val())) {
                cnh.get(0).setCustomValidity('');
                feedbackCnh.text("");
            } else {
                cnh.get(0).setCustomValidity('Inválido');
                feedbackCnh.text("Digite uma CNH válida");
            }
        } else {
            cnh.get(0).setCustomValidity('Inválido');
            feedbackCnh.text("Campo obrigatório");
        }

    });

    mei.on('change', () => {
        if (mei.val().length > 0) {
            if (mei.val() == "Sim") {
                mei.get(0).setCustomValidity('');
                feedbackMei.text("")
            } else {
                $('#modalMei').modal('show');
                mei.get(0).setCustomValidity('Inválido');
                feedbackMei.text("É necessário possuir MEI para efetuar cadastro")
            }
        } else {
            mei.get(0).setCustomValidity('Inválido');
            feedbackMei.text("Campo obrigatório")
        }
    });

    celular.keyup(() => {
        celular = $("#celular");
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

    celularAlternativo.keyup(() => {
        celularAlternativo = $("#celularAlternativo");
        if (celularAlternativo.val().length > 0) {
            if (Inputmask.isValid(celularAlternativo.val(), "(99)9999-9999[9]")) {
                celularAlternativo.get(0).setCustomValidity('');
                feedbackCelularAlternativo.text("");
            } else {
                feedbackCelularAlternativo.text("Digite um celular válido");
                celularAlternativo.get(0).setCustomValidity('Inválido');
            }
        } else{
            feedbackCelularAlternativo.text("Campo obrigatório");
            celularAlternativo.get(0).setCustomValidity('Inválido');
        }
    });

    regioes.change(() => {
        regioesValidas = false;
        regioes.each((regiao) => {
            if (regioes.get(regiao).checked) {
                regioesValidas = true;
            }
        });

        if (regioesValidas) {
            regioes.each((regiao) => {
                regioes.get(regiao).setCustomValidity('');
            });
        } else {
            regioes.each((regiao) => {
                regioes.get(regiao).setCustomValidity('Inválido');
            });
        }
    });

    email.keyup(() => {
        email = $("#email");
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
            feedbackConfirmarSenha.text("Este campo é obrigatório");
        }
    });

    marca.keyup(() => {
        if (marca.val().length > 0) {
            marca.get(0).setCustomValidity('');
        } else {
            marca.get(0).setCustomValidity('Inválido');
        }
    });

    modelo.keyup(() => {
        if (modelo.val().length > 0) {
            modelo.get(0).setCustomValidity('');
        } else {
            modelo.get(0).setCustomValidity('Inválido');
        }
    });

    cor.keyup(() => {
        if (cor.val().length > 0) {
            cor.get(0).setCustomValidity('');
        } else {
            cor.get(0).setCustomValidity('Inválido');
        }
    });

    placa.keyup(() => {
        placa = $("#placa");
        if (placa.val().length > 0) {
            if (Inputmask.isValid(placa.val(), "AAA-9999")) {
                placa.get(0).setCustomValidity('');
                feedbackPlaca.text("");
            } else {
                feedbackPlaca.text("Digite uma placa válida");
                placa.get(0).setCustomValidity('Inválido');
            }
        } else{
            feedbackPlaca.text("Campo obrigatório");
            placa.get(0).setCustomValidity('Inválido');
        }
    });

    renavam.keyup(() => {
        if (renavam.val().length > 0) {
            if (validarRENAVAM(renavam.val())) {
                renavam.get(0).setCustomValidity('');
                feedbackRenavam.text("");
            } else {
                renavam.get(0).setCustomValidity('Inválido');
                feedbackRenavam.text("Digite um RENAVAM válido");
            }
        } else {
            renavam.get(0).setCustomValidity('Inválido');
            feedbackRenavam.text("Campo obrigatório");
        }
    });


    //Validação quando o formulario é confirmado

    form.submit(() => {
        nome = $("#nome");
        data = $("#data");
        genero = $("#genero");
        var dataValida = Inputmask.isValid(data.val(), {alias: "datetime", inputFormat: "dd/mm/yyyy" });
        celular = $("#celular");
        var celularValido = Inputmask.isValid(celular.val(), "(99)9999-9999[9]");
        celularAlternativo = $("#celularAlternativo");
        var celularAlternativoValido = Inputmask.isValid(celularAlternativo.val(), "(99)9999-9999[9]");
        regioes = $("input[name^='regiao']");
        regioesValidas = false;
        cpf = $("#cpf");
        var cpfValido = validarCPF(cpf.val());
        cnpj = $("#cnpj");
        var cnpjValido = validarCNPJ(cnpj.val());
        mei = $("#mei");
        cnh = $("#cnh");
        var cnhValida = validarCNH(cnh.val());
        email = $("#email");
        var emailValido = Inputmask.isValid(email.val(),{alias: "email"});
        senha = $("#senha");
        confirmarSenha = $("#confirmarSenha");
        marca = $("#marca");
        modelo = $("#modelo");
        cor = $("#cor");
        placa = $("#placa");
        var placaValida = Inputmask.isValid(placa.val(),{mask:"AAA-9999"});
        renavam = $("#renavam");
        var renavamValido = validarRENAVAM(renavam.val());

        if (nome.val().length > 0){
            nome.get(0).setCustomValidity('');
        } else {
            nome.get(0).setCustomValidity('Inválido');
        }

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

        if (cnpj.val().length > 0) {
            if (cnpjValido) {
                cnpj.get(0).setCustomValidity('');
                feedbackCnpj.text("");
            } else {
                cnpj.get(0).setCustomValidity('Inválido');
                feedbackCnpj.text("Digite um CNPJ válido");
            }
        } else {
            cnpj.get(0).setCustomValidity('Inválido');
            feedbackCnpj.text("Campo obrigatório");
        }

        if (cnh.val().length > 0) {
            if (cnhValida) {
                cnh.get(0).setCustomValidity('');
                feedbackCnh.text("");
            } else {
                cnh.get(0).setCustomValidity('Inválido');
                feedbackCnh.text("Digite uma CNH válida");
            }
        } else {
            cnh.get(0).setCustomValidity('Inválido');
            feedbackCnh.text("Campo obrigatório");
        }

        if (mei.val().length > 0) {
            if (mei.val() == "Sim") {
                mei.get(0).setCustomValidity('');
                feedbackMei.text("")
            } else {
                mei.get(0).setCustomValidity('Inválido');
                feedbackMei.text("É necessário possuir MEI para efetuar cadastro")
            }
        } else {
            mei.get(0).setCustomValidity('Inválido');
            feedbackMei.text("Campo obrigatório")
        }

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

        if (celularAlternativo.val().length > 0) {
            if (celularAlternativoValido) {
                feedbackCelularAlternativo.text("");
                celularAlternativo.get(0).setCustomValidity('');
            } else {
                feedbackCelularAlternativo.text("Digite um celular válido");
                celularAlternativo.get(0).setCustomValidity('Inválido');
            }
        } else {
            feedbackCelularAlternativo.text("Campo obrigatório");
            celularAlternativo.get(0).setCustomValidity('Inválido');
        }

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
                feedbackConfirmarSenha.text("Campo obrigatório")
            }
        } else {
            senha.get(0).setCustomValidity('Inválido');
            confirmarSenha.get(0).setCustomValidity('Inválida');
            feedbackSenha.text("Campo obrigatório");
            if (confirmarSenha.val().length <= 0) {
                feedbackConfirmarSenha.text("Campo obrigatório")
            }
        }

        if (placaValida) {
            placa.get(0).setCustomValidity('');
            if (placaValida) {
                feedbackPlaca.text("");
                placa.get(0).setCustomValidity('');
            } else {
                feedbackPlaca.text("Digite uma placa válida");
                placa.get(0).setCustomValidity('Inválido');
            }
        } else {
            feedbackPlaca.text("Campo obrigatório");
            placa.get(0).setCustomValidity('Inválido');
        }

        if (renavam.val().length > 0) {
            if (renavamValido) {
                renavam.get(0).setCustomValidity('');
                feedbackRenavam.text("");
            } else {
                renavam.get(0).setCustomValidity('Inválido');
                feedbackRenavam.text("Digite um RENAVAM válido");
            }
        } else {
            renavam.get(0).setCustomValidity('Inválido');
            feedbackRenavam.text("Campo obrigatório");
        }

        regioes.each((regiao) => {
            if (regioes.get(regiao).checked) {
                regioesValidas = true;
            }
        });

        if (regioesValidas) {
            regioes.each((regiao) => {
                regioes.get(regiao).setCustomValidity('');
            });
        } else {
            regioes.each((regiao) => {
                regioes.get(regiao).setCustomValidity('Inválido');
            });
        }

        if (termos.is(":checked")) {
            termos.get(0).setCustomValidity('');
        } else {
            termos.get(0).setCustomValidity('Inválido');
        }

        form.addClass('was-validated');

        return form[0].checkValidity();
    });

    <!-- Formato das máscaras dos inputs -->

    celular.inputmask("(99)9999-9999[9]", {removeMaskOnSubmit:true});
    celularAlternativo.inputmask("(99)9999-9999[9]", {removeMaskOnSubmit:true});
    cpf.inputmask("999.999.999-99", {removeMaskOnSubmit:true});
    cnpj.inputmask("99.999.999/9999-99", {removeMaskOnSubmit:true});
    cnh.inputmask("99999999999", {removeMaskOnSubmit: true});
    renavam.inputmask("99999999999", {removeMaskOnSubmit: true});
    placa.inputmask("AAA-9999", {removeMaskOnSubmit: true});
    email.inputmask("email");
    nome.inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});
    data.inputmask("datetime", {placeholder: "DD/MM/AAAA", inputFormat: "dd/mm/yyyy", max: "01/06/1998", min: "01/01/1919", outputFormat: "yyyy-mm-dd", removeMaskOnSubmit: true});
    marca.inputmask({regex: "[a-zà-úA-ZÀ-Ú- ]*", placeholder: ""});
    modelo.inputmask({regex: "[a-zà-úA-ZÀ-Ú0-9- ]*", placeholder: ""});
    cor.inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});
});

$(document).ready( () => {
    var form = $("#form");
    var nome = $("#nome");
    var data = $("#data");
    var feedbackData = $("#feedbackData");
    var genero = $("#genero");
    var celular = $("#celular");
    var cpf = $("#cpf");
    var feedbackCpf = $("#feedbackCpf");
    var email = $("#email");

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

    //Validação quando o formulario é confirmado

    form.submit(() => {
        nome = $("#nome");
        data = $("#data");
        genero = $("#genero");
        var dataValida = Inputmask.isValid(data.val(), {alias: "datetime", inputFormat: "dd/mm/yyyy" });
        celular = $("#celular");
        var celularValido = Inputmask.isValid(celular.val(), "(99)9999-9999[9]");
        cpf = $("#cpf");
        var cpfValido = validarCPF(cpf.val());
        email = $("#email");
        var emailValido = Inputmask.isValid(email.val(),{alias: "email"});

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

        form.addClass('was-validated');

        return form[0].checkValidity();
    });

    <!-- Formato das máscaras dos inputs -->

    celular.inputmask("(99)9999-9999[9]", {removeMaskOnSubmit:true});
    cpf.inputmask("999.999.999-99", {removeMaskOnSubmit:true});
    email.inputmask("email");
    nome.inputmask({regex: "[a-zà-úA-ZÀ-Ú ]*", placeholder: ""});
    data.inputmask("datetime", {placeholder: "DD/MM/AAAA", inputFormat: "dd/mm/yyyy", max: "01/06/1998", min: "01/01/1919", outputFormat: "yyyy-mm-dd", removeMaskOnSubmit: true});
});
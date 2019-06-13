var validarRENAVAM = (renavam) => {
    if( !renavam.match("[0-9]{11}") ){
        return false;
    }

    var renavamSemDigito = renavam.substring(0, 10);

    var renavamReversoSemDigito = renavamSemDigito.split("").reverse().join("");

    var soma = 0;
    var multiplicador = 2;
    for (var i=0; i<10; i++){
        var algarismo = renavamReversoSemDigito.substring(i, i+1);
        soma += algarismo * multiplicador;

        if( multiplicador >= 9 ){
            multiplicador = 2;
        }else{
            multiplicador++;
        }
    }

    var mod11 = soma % 11;

    var ultimoDigitoCalculado = 11 - mod11;

    ultimoDigitoCalculado = (ultimoDigitoCalculado >= 10 ? 0 : ultimoDigitoCalculado);

    var digitoRealInformado = parseInt(renavam.substring(renavam.length - 1, renavam.length));

    return ultimoDigitoCalculado === digitoRealInformado;
};
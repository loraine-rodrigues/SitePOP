<?php

function carregarFoto($uuid) {
    $pasta_destino = "../../image/motofretistas/";
    $caminho_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $tipo_arquivo = strtolower(pathinfo($caminho_destino,PATHINFO_EXTENSION));
    $caminho_destino = $pasta_destino . $uuid . "." . $tipo_arquivo;
// Verifique se o arquivo de imagem é uma imagem real ou uma imagem falsa
    if(isset($_POST["confirmarCadastro"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
//            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Verifique se o arquivo já existe
    if (file_exists($caminho_destino)) {
// echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

// Verifique o tamanho do arquivo
    if ($_FILES["foto"]["size"] > 500000) {
// echo "Desculpe, seu arquivo é muito grande.";
        $uploadOk = 0;
    }
// Permitir determinados formatos de arquivo
    if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg") {
// echo "Desculpe, apenas arquivos JPG, JPEG e PNG são permitidos.";
        $uploadOk = 0;
    }
// Verifique se $ uploadOk está definido como 0 por um erro
    if ($uploadOk == 0) {
// echo "Desculpe, seu arquivo não foi enviado.";
        return 'erro';
// se tudo estiver ok, tente fazer o upload do arquivo
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho_destino)) {
// echo "O arquivo". basename ($ _FILES ["foto"] ["nome"]). "foi carregado";

            return $uuid . "." . $tipo_arquivo;
        } else {
// echo "Desculpe, houve um erro ao fazer o upload do seu arquivo.";
            return 'erro';
        }
    }
}

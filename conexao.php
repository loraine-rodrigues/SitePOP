<?php

$servidor = "localhost";
$banco = "motofrete";
$usuario = "azure";
$senha = "6#vWHD_$";
$porta = "50526";

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $banco, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $excecao) {
    echo "Erro: $excecao->errorInfo";
}

$conexao->set_charset('utf8');
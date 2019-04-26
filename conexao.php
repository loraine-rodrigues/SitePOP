<?php

$servidor = "localhost";
$banco = "motofrete";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $banco, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $excecao) {
    echo "Erro: $excecao->errorInfo";
}


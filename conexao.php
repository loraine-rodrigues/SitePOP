<?php

$servidor = "localhost";
$banco = "motofrete";
$usuario = "root";
$senha = "";
$porta = "3306";

try {
    $conexao = new PDO("mysql:host=$servidor;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $excecao) {
    echo "Erro ao conectar ao banco: $excecao->errorInfo";
}

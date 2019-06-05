<?php

$servidor = "localhost";
$banco = "motofrete";
$usuario = "azure";
$senha = "6#vWHD_$";
$porta = "50526";


try {
    $conexao = new PDO("mysql:host=$servidor;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $excecao) {
    echo "Erro ao conectar ao banco: $excecao->errorInfo";
}
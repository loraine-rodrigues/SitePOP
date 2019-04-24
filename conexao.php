<?php

$servidor = "localhost";
$banco = "motofrete";
$usuario = "azure";
$senha = "6#vWHD_$";
$porta = "50526";

$conexao = new mysqli($servidor, $usuario, $senha, $banco, $porta);

if ($conexao->connect_errno) {
    echo "Erro ao conectar ao banco!" . PHP_EOL;
    echo "Erro: " . $conexao->connect_error . PHP_EOL;
    exit;
}

$conexao->set_charset('utf8');

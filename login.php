<?php
session_start();
include 'conexao.php';

$nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);


$query = "select nm_usuario from tb_login where nm_usuario = '{$nome}' and id_senha = '{$senha}'";

$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);
 
if($row == 1) {
	$_SESSION['nome'] = $nome;
	header('Location: painel.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}

?>
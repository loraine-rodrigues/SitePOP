<?php
include_once 'conecta.php';
$conn= new conecta();

$email = $_POST['email'];


    $chave=$conn->geraChaveAcesso($email);
    if($chave){
        echo'<a href="http://sitepop/recuperarSenha/alterarSenha.php?chave='.$chave.'">http://sitepop/recuperarSenha/alterarSenha.php?chave='.$chave.'</h1>';
    }
    else{
        echo'usuario não encontrado';
    }
?>
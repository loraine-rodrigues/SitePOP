<?php
include_once 'conecta.php';
$conn= new conecta();

    $email = $_POST['email'];
    $novaSenha = $_POST['senha'];
    $chave = $_POST['chave'];

  

    $result=$conn->checkChave($email,$chave);

    if($result){
        $alterasenha=$conn->setNovaSenha($novaSenha,$result);
        echo'Senha alterada com sucesso';
    }
    else{
        echo 'Usuario não encontrado';

    }
    
?>
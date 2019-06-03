<?php
include_once 'config.php';

class conecta extends config{
  var $pdo;
 
 function __construct(){
   $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->usuario, $this->senha); 
 }
 
 function login($email, $senha){
   $stmt = $this->pdo->prepare("SELECT * FROM tb_login WHERE nm_usuario = :email AND id_senha = :senha");
   $stmt->bindValue(":email",$email);
   $stmt->bindValue(":senha",md5($senha));
   $run = $stmt->execute();
   $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $rs;
 }
 
 function geraChaveAcesso($email){
   $stmt = $this->pdo->prepare("SELECT * FROM tb_login WHERE nm_usuario = :email");
   $stmt->bindValue(":email",$email);
   $run = $stmt->execute();
 
   $rs = $stmt->fetch(PDO::FETCH_ASSOC);
   
    if($rs){
      $chave = md5($rs["id"].$rs["senha"]);
      return $chave;
    }
 
 }
 
 
 function checkChave($email,$chave){
   $stmt = $this->pdo->prepare("SELECT * FROM tb_login WHERE nm_usuario = :email");
   $stmt->bindValue(":email",$email);
   $run = $stmt->execute();
 
   $rs = $stmt->fetch(PDO::FETCH_ASSOC);
 
   if($rs){
     $chaveCorreta = md5($rs["id"].$rs["senha"]);
     if($chave == $chaveCorreta){
        return $rs["id"];
     }
   }
 }
 
 function setNovaSenha($novaSenha,$id){
   $stmt = $this->pdo->prepare("UPDATE tb_login SET id_senha = :novaSenha WHERE id_login = :id");
   $stmt->bindValue(":novaSenha",md5($novaSenha));
   $stmt->bindValue(":id",$id);
   $run = $stmt->execute();
 }
}

?>
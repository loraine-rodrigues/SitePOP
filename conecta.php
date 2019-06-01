<?php
include_once 'funcao.php';

class conecta extends funcao{
  var $pdo;
 
 function __construct(){
   $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->usuario, $this->senha); 
 }
 
 function login($email, $senha){
   $stmt = $this->pdo->prepare("SELECT * FROM login WHERE email = :email AND senha = :senha");
   $stmt->bindValue(":email",$email);
   $stmt->bindValue(":senha",sha1($senha));
   $run = $stmt->execute();
   $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $rs;
 }
 
 function geraChaveAcesso($email){
   $stmt = $this->pdo->prepare("SELECT * FROM login WHERE email = :email");
   $stmt->bindValue(":email",$email);
   $run = $stmt->execute();
 
   $rs = $stmt->fetch(PDO::FETCH_ASSOC);
   
    if($rs){
      $chave = sha1($rs["id"].$rs["senha"]);
      return $chave;
    }
 
 }
 
 
 function checkChave($email,$chave){
   $stmt = $this->pdo->prepare("SELECT * FROM login WHERE email = :email");
   $stmt->bindValue(":email",$email);
   $run = $stmt->execute();
 
   $rs = $stmt->fetch(PDO::FETCH_ASSOC);
 
   if($rs){
     $chaveCorreta = sha1($rs["id"].$rs["senha"]);
     if($chave == $chaveCorreta){
        return $rs["id"];
     }
   }
 }
 
 function setNovaSenha($novasenha,$id){
   $stmt = $this->pdo->prepare("UPDATE login SET senha = :novasenha WHERE id = :id");
   $stmt->bindValue(":novasenha",sha1($novasenha));
   $stmt->bindValue(":id",$id);
   $run = $stmt->execute();
 }
}

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="container text-center">
    <div class="row">
        <div class="col-md-11 text-center">

            <h2 class="ml-5 text-info">Recuperação de Senha</h2>
        </div>
    </div>
</div>
<br>
<div class="card m-auto text-left" style="width: 24rem;">
    <div class="card-body">

        <form method="post" id="recupera" onsubmit="validaForm(); return false;" class="form">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Seu Nome" class="form-control" required="">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Seu Email" class="form-control" required="">
            </div>





            <div class="text-center">
                <button class="btn btn-info" type="submit">Enviar</button>
            </div>

        </form>
    </div>
</div>
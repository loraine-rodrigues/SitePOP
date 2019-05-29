<?php
$title = "ESQUECI MINHA SENHA";
include 'conexao.php';
include 'header.php';


if(isset($_POST['recuperando']) && $_POST['recuperando'] == 'rec'){
	$email =    strip_tags(trim($_POST['email']));
   
  //busca no banco o usuario com o email
    $sql = "SELECT * FROM tb_login WHERE nm_usuario = '$email'";
 
    $res = $pdo->query($sql);
 
    // caso haja mais de um cadastrado...
    if($res->rowCount() == 1){
        //fazemos um while para coletarmos as outras informações do usuario
        //tais como o nome e a senha
        while($exibir = $res->fetch(PDO::FETCH_OBJ)){
            $nome = $exibir->nome;
            $senha = $exibir->senha;
        }
        
        //envia o email para a pessoa juntamente com seu nome e sua senha
        $msg="Olá $nome, você solicitou a recuperação de senha.\n";
        $msg.="Sua senha é: $senha";
        
        mail($email, "Recuperação de senha", $msg);
        
        //alerta que o email foi enviado e o redireciona para outra página
        echo"<script>alert('Senha enviada por e-mail, verifique sua caixa de mensagens ou sua caixa de spans.'),window.open('login.php','_self')</script>";
    }
    //caso contrário
    else{
        //lhe informa que o seu e-mail não está cadastrado no banco de dados
        echo"<script>alert('E-mail não cadastrado em nosso sistema, caso não se lembre do email cadastrado, entre em contato conosco.'),window.open('recuperarSenha.php','_self')</script>";
        
    }
   
}


?>
<form method="POST" action="">
    <input placeholder="Seu email" name="email" type="text">
    <input name="recuperando" value="Enviar" type="submit">

<?php include 'footer.php';
?>

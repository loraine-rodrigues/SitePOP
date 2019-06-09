<?php
include '../header.php';

?>
<html>
<head>
<title>Atualizar Senha </title>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>
<body>
<div style="width:700px; margin:50 auto;">

<h2> Atualizar Senha</h2>   

<?php
include('db.php');
if (isset($_GET["key"]) && isset($_GET["email"])
&& isset($_GET["action"]) && ($_GET["action"]=="reset")
&& !isset($_POST["action"])){
$key = $_GET["key"];
$email = $_GET["email"];
$curDate = date("Y-m-d H:i:s");
$query = mysqli_query($con,"
SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';");
$row = mysqli_num_rows($query);
if ($row==""){
$error .= '<h2>Invalid Link</h2>
<p>O link é inválido ou expirou. Pode ser também que você não tenha copiado o link corretamente ou que  
você já tenha usado para atualizar a senha uma vez.</p>
<p><a href="http://sitepop/demo/index.php">Clique aqui</a> para atualizar sua senha.</p>';
	}else{
	$row = mysqli_fetch_assoc($query);
	$expDate = $row['expDate'];
	if ($expDate >= $curDate){
	?>
    <br />
	<form method="post" action="" name="update">
	<input type="hidden" name="action" value="update" />
	<br /><br />
	<label><strong>Enter New Password:</strong></label><br />
	<input type="password" name="pass1" id="pass1" maxlength="15" required />
    <br /><br />
	<label><strong>Re-Enter New Password:</strong></label><br />
	<input type="password" name="pass2" id="pass2" maxlength="15" required/>
    <br /><br />
	<input type="hidden" name="email" value="<?php echo $email;?>"/>
	<input type="submit" id="reset" value="Reset Password" />
	</form>
<?php
}else{
$error .= "<h2>Link Expired</h2>
<p>O link expirou. Você está tentando usar um link expirado que só é válido por 24 horas (1 dia depois da solicitação).<br /><br /></p>";
				}
		}
if($error!=""){
	echo "<div class='error'>".$error."</div><br />";
	}			
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($con,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($con,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
		$error .= "<p>Senhas diferentes, as duas senhas precisam ser iguais.me.<br /><br /></p>";
		}
	if($error!=""){
		echo "<div class='error'>".$error."</div><br />";
		}else{

$pass1 = md5($pass1);
mysqli_query($con,
"UPDATE `tb_login` SET `id_senha`='".$pass1."', `trn_date`='".$curDate."' WHERE `nm_usuario`='".$email."';");	

mysqli_query($con,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");		
	
echo '<div class="error"><p>Parabéns! Sua senha foi atualizada com sucesso.</p>
<p><a href="http://sitepop/">Clique aqui</a> para Entrar.</p></div><br />';
		}		
}
?>


<br /><br />

</div>
</body>
</html>

<?php
$title = "ESQUECI MINHA SENHA";
include 'conexao.php';
include 'header.php';

if (isset($_POST['ok'])) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro[] = "E-mail inválido.";
    }
    try {
        $comando = $conexao->prepare("CALL verificaLogin(?, ?)");
        $comando->bindParam(1, $email);
        $comando->bindParam(2, $senha);
        $comando->execute();
        if ($comando->rowCount() > 0) {

            while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) {

                $_SESSION['nome'] = $resultado['nm_usuario'];
                $novaSenha = substr(md5(time()), 0, 6);
                $nscriptografada = md5(md5($novaSenha));
            }
        }
    } catch (PDOException $excecao) {
        echo "Erro: " . $excecao->getMessage();
    }

    if (mail($email, "Sua nova senha", "Sua nova senha: " . $novaSenha)) {
        $sql_code = "UPDATE tb_login SET id_senha = 'nscriptografada' where nm_usuario= '$email'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    }
}

?>
<?php
if (isset($_SESSION['erro'])) :
    ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['erro']; ?>
    </div>
<?php
endif;
session_destroy();
?>
<form method="POST" action="">
    <input placeholder="Seu email" name="email" type="text">
    <input name="ok" value="ok" type="submit">

</form>
<?php
$title = "LOGIN";

require '../conexao.php';

if (isset($_POST['entrarlogin'])) {
    $email = $_POST ['email'];
    $senha = $_POST ['senha'];
    

    if ($email && $senha == TRUE) {
        try {
            $comando = $conexao->prepare("CALL login(?, ?)");
            $comando->bind_param(1, $email);
            $comando->bind_param(2, $senha);
            $comando->execute();

            echo "Entrou, $email !";
        }
        catch (PDOException $excecao) {
            echo "Erro: $excecao->errorInfo";
        }
    }
}

?>

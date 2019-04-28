<?php
    session_start();
    if($_SESSION['usuario'] == null) {
        header('location: ../');
    }
    echo "Bem vindo admin", $_SESSION['usuario'];
    
?>
<a class="btn btn-primary" href="sair.php" >Sair</a>
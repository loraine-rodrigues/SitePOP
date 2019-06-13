<?php
session_start();

try {
    if ($_SESSION['tipo'] == 1) { // Se for do tipo cliente (1)
        include 'cliente.php';
    } else if ($_SESSION['tipo'] == 2) { // Se for do tipo motofretista (2)
        include 'motofretista.php';
    } else { // Se for do tipo admin (3)
        include 'admin.php';
    }
}
catch (PDOException $excecao) {
    echo "Erro ao exibir perfil";
}
?>
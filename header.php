<?php

if (!isset($_SESSION)) {
    session_start();
}

include 'admin/verificaAdm.php'; // Se o usuário logado for admin, $_SESSION['admin'] será true ?>

<!doctype html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    <title>POP! - <?= $title ?></title> <!-- Titulo da página-->

<!-- Scripts -->
    <!-- jQuery -->
    <script src="/terceiros/jquery/jquery.js"></script>

    <!-- Popper -->
    <script src="/terceiros/popper/popper.js"></script>

    <!-- InputMask -->
    <script src="/terceiros/inputmask/inputmask.js"></script>

    <!-- Bootstrap-->
    <script src="/terceiros/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="/terceiros/datatables/js/jquery.dataTables.min.js"></script>
<!-- /Scripts -->


<!-- Estilos -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/terceiros/bootstrap/css/bootstrap.min.css">

    <!-- Footer fixo -->
    <link rel="stylesheet" href="/terceiros/bootstrap/css/sticky-footer.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="/terceiros/datatables/css/jquery.dataTables.min.css">

    <!-- Font Montserrat -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <!-- Ícone -->
    <link rel="shortcut icon" type="image/x-icon" href="/image/P.ico">

    <!-- FontAwesome -->
    <link href="/terceiros/fontawesome/css/all.css" rel="stylesheet">

    <!--Style para padronização de todas as páginas -->
    <style>
    @media only screen and (min-width: 767px) {
        body {
                width: 100%;
                background-repeat: no-repeat;
                background-position: center center;
                background-attachment: fixed;
                background-size: cover;
                font-family: \'Montserrat\', sans-serif;
                // fonte do site
        }
    }
    .navbar-customizada{
        width: 100%;
        background-color:#0095B6;
    }
    .navbar-brand:focus,
    .navbar-brand:hover {
        text-decoration: none
    }
    .card {
        border-radius: 25px;
    }
    .icon {
        display: inline-block;
        line-height: 30px;
        padding-left: 30px;
        background: url("image/phone.svg") no-repeat scroll 0 0 transparent;
    }
    .my-custom-scrollbar {
        position: relative;
        height: 500px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
    }
    </style>
<!-- /Estilos -->

</head>
<body class="d-flex flex-column h-100">
    <header>

        <!--INICIO da navbar-->
        <nav class="navbar navbar-expand-lg navbar-customizada navbar-dark">
            <a class="navbar-brand" href="/home.php">POP!</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--Itens da navbar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Links de navegação -->
                <ul class="navbar-nav mr-auto">

<?php
if (isset($_SESSION['logado'])) { // Se o usuário estiver logado, mostrar link para o perfil ?>
                    <!-- Perfil -->
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/perfil">Meu perfil</a>
                    </li>
<?php } ?>
                    <!-- Catalogo -->
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/catalogo.php">Catálogo</a>
                    </li>

                    <!-- Como funciona -->
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/comoFunciona.php">Como Funciona</a>
                    </li>

                    <!-- Contato -->
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/contato.php">Contato</a>
                    </li>

<?php
if ($_SESSION['admin'] == TRUE) { //Se for admin mostrar mais dois botões, Motofretistas e Clientes ?>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/admin/motofretistas">Motofretistas</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/admin/clientes">Clientes</a>
                    </li>
<?php } ?>

                </ul> <!-- Fim dos links de navegação -->

<?php
if (isset($_SESSION['logado'])) {  //Se o usuario estiver logado mostrar botão SAIR ?>
                <ul class="nav navbar-nav navbar-right" >
                    <!-- BEM VINDO AO USUARIO -->
                    <li>
                        <span class="navbar-text text-white mr-3">Bem vindo, <span id="nome_sessao"><?= $_SESSION['nome'] ?></span></span>
                    </li>
                    <!--BOTÃO SAIR-->                                    
                    <li>
                        <div class="btn-nav" >
                            <a class="btn btn-sm btn-danger navbar-btn mt-1" href="/logout.php"> Sair <i class="fas fa-sign-out-alt"></i></a>                   
                        </div>
                    </li>                                
                </ul>
<?php } ?>
          </div>
        </nav> 
        <!--FIM da navbar-->    
            
    </header>
    <main role="main" class="flex-shrink-0">
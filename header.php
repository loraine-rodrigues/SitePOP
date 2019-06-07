<?php

session_start();

include 'adm/verificaAdm.php';

echo '<!doctype html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    <link rel="shortcut icon" type="image/x-icon" href="image/P.ico">
    ';

echo "<title>POP! - $title</title>"; //Para receber o titulo

echo '
    <script src="/terceiros/jquery/jquery.js"></script>
    <script src="/terceiros/popper/popper.js"></script>
    <script src="/terceiros/inputmask/inputmask.js"></script>
    <link rel="stylesheet" href="/terceiros/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/terceiros/bootstrap/css/sticky-footer.css">
    <script src="/terceiros/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> <!-- link importado para font Montserrat -->

    <link href="/terceiros/fontawesome/css/all.css" rel="stylesheet">
    
    
    <!--Style para padronização de todas as páginas -->
    <style>
    @media only screen and (min-width: 767px) {
      body {
        /* The file size of this background image is 93% smaller
           to improve page load speed on mobile internet connections */

      }
      

    }
    body {
            width: 100%;
           
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            font-family: \'Montserrat\', sans-serif;
            // fonte do site
           
            
            
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
          background: url("phone.svg") no-repeat scroll 0 0 transparent;
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
            <ul class="navbar-nav mr-auto">
             <li class="nav-item mx-2">
                <a class="nav-link" href="/catalogo.php">Catálogo</a>
              </li> 
            
              
              
              <li class="nav-item mx-2">
                <a class="nav-link" href="/comoFunciona.php">Como Funciona</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="/contato.php">Contato</a>
              </li>';

if ($_SESSION['adm'] == TRUE) {     //Se for adm mostrar mais dois botões
  echo '                  <li class="nav-item mx-2">
                <a class="nav-link" href="/adm/motofretistas">Motofretistas</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="/adm/clientes">Clientes</a>
              </li>
    ';
}

echo '            </ul>';


if (isset($_SESSION['logado'])) {  //Se o usuario estiver logado mostrar botão SAIR

  echo '        <!--BOTÃO SAIR-->                                    
                <ul class="nav navbar-nav navbar-right" >
                    <li >
                        <div class="btn-nav" >
                            <a class="btn btn-warning btn-small navbar-btn" href="/logout.php"> Sair <i class="fas fa-sign-out-alt"></i></a >                   
                        </div >
                    </li >                                
                </ul >';
}

echo '          
          </div>
        </nav> 
        <!--FIM da navbar-->    
            
    </header>
    <main role="main" class="flex-shrink-0">
    ';

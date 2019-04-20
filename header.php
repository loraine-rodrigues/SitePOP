<?php

echo '<!doctype html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    ';

echo "<title>POP! - $title</title>"; //Para receber o titulo

echo '
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="/terceiros/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/terceiros/bootstrap/css/sticky-footer.css">
    <script src="/terceiros/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> <!-- link importado para font Montserrat -->
    
    <!--Style para padronização de todas as páginas -->
    <style>
          body {              
            background-color: #009999;                      // cor de fundo da pagina 
            font-family: \'Montserrat\', sans-serif;        // fonte do site
         }
         .navbar-customizada{
            background-color:#6c6d6d;                       //COR DA NAVBAR
         }
         .card {
            border-radius: 25px;
         }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <header>    
        
       <!--INICIO da navbar-->
        <nav class="navbar navbar-expand-lg navbar-customizada navbar-dark"> 
          <a class="navbar-brand" href="/index.php">POP!</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <!--Iténs da navbar -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item mx-2">
                <a class="nav-link" href="/home.php">Home</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="/sobreNos.php">Sobre nós</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="/duvidas.php">Dúvidas Frequentes</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="/termos.php">Termos de uso</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="/catalogo.php">Catálogo</a>
              </li> 
              <li class="nav-item mx-2">
                <a class="nav-link" href="/contato.php">Contato</a>
              </li>
            </ul>
            
            <!--BOTÃO SAIR-->                                    
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="btn-nav">
                        <a class="btn btn-warning btn-smoll navbar-btn"> Sair </a>                   
                    </div>
                </li>                                
            </ul>
            
          </div>
        </nav> 
        <!--FIM da navbar-->    
            
    </header>
    <main role="main" class="flex-shrink-0">
    ';


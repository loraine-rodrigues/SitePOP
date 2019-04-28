<?php 
    session_start();
    if(isset($_SESSION['usuario']) && $_SESSION['usuario'] != null ) {
        header('location: admin/');
    }

    if(isset($_POST) && $_POST != null) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];             
        $sql = "select cd_login, nm_usuario, ic_nivel from tb_loginEx where ds_acesso = :email && ds_senha = :senha";        
        $conexao = new PDO("mysql:host=localhost;dbname=motofrete;","root","");
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":senha",$senha);
        $stmt->execute();
        if($stmt->rowCount() == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['usuario'] = $result['nm_usuario'];
            $_SESSION['nivel'] = $result['ic_nivel'];
            header('location: admin/');
        }else {
            header('location: ?erro="true"');
        }

    }

?>

<!doctype html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    <title>POP!</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lib/bootstrap/css/sticky-footer.css">
    <script src="./lib/bootstrap/js/bootstrap.bundle.min.js"></script>
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
          <a class="navbar-brand" href="index.php">POP!</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <!--Iténs da navbar -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item mx-2">
                <a class="nav-link" href="home.php">Home</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="sobreNos.php">Sobre nós</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="duvidas.php">Dúvidas Frequentes</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="termos.php">Termos de uso</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="catalogo.php">Catálogo</a>
              </li> 
              <li class="nav-item mx-2">
                <a class="nav-link" href="contato.php">Contato</a>
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
    <?php
        //var_dump($_GET);
        if(isset($_GET['erro']) && $_GET['erro'] != null) {
    ?>
    <div class="alert alert-danger text-center">
        <span class="text-danger">Erro ao tentar logar!</span>
        O usuario ou senha estão incorretos!
    </div>

    <?php
        }
    ?>
    <main role="main" class="flex-shrink-0">
         
        <div class="container text-center">
            <h1 class="display-1 font-weight-normal mb-n2" >POP!</h1>
            <h5 class="ml-4">Liberdade para negociar.</h5>
            <br>
            <div class="card m-auto text-left" style="width: 24rem;">
                <!--Div usada para formartar o card de login -->
                <div class="card-body">
                    <form id="test" method="post" name="login">

                        <!--Entrada de email para login-->
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input type="text" class="form-control" id="email" placeholder="Digite seu email" name="email">
                        </div>

                        <!--Entrada de senha para login-->
                        <div class="form-group">
                            <label for="senha"> Senha: </label>
                            <input type="password" class="form-control" id="senha" placeholder="Digite sua senha" name="senha">
                        </div>

                        <!-- Botão entrar -->
                        <button type="submit" class="btn btn-outline-primary btn-block">Entrar </button>
                    </form>

                    <!-- Esqueci a senha / Cadastre-se -->
                    <div class="text-right mt-3">
                        <span class="small"><a href="#">Esqueci minha senha</a> </span>
                        <span class="small ml-4 mr-2"><a href="#" data-toggle="modal" data-target="#modal">Cadastre-se</a> </span>
                    </div>
                </div>
            </div>
            <br>
        </div>

        <!--Modal para cadastro de CLIENTE ou MOTOFRETISTA-->
        <div id="modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Conteúdo do modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Para iniciar o cadastro selecione:</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <a href="Cadastro/motofretista.php" class="btn btn-outline-warning">Sou motofretista</a>
                        <a href="Cadastro/cliente.php" class="btn btn-outline-info float-right">Sou cliente</a>
                    </div>

                </div>

            </div>
        </div>





    </main>
    <footer class="footer mt-auto py-3 text-center bg-dark">
      <div class="container">
        <span class="text-white-50">&copy; 2019 - POP!</span>
      </div>
    </footer>
    <script>
        
    </script>
</body>
</html>

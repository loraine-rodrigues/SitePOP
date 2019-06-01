<!doctype html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="pt-br">
</head>
  <!--Entrada de email para login-->
<body>
<?php
$chave="";
if($_GET["chave"]){
    $chave= preg_replace('/[^[:alnum:]]/','',$GET["chave"]);

?>
                    <h5 class="modal-title">Informe seu email: </h5>
                   
                </div>

                    <form method="post" id="alterar" action="setNovaSenha.php">
                    <input type="hidden" class="form-control" name="chave" value="<?php echo $chave;?>" required>
                        <label for="email"> Email: </label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu email" required>
                        <label for="senha"> Nova Senha: </label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Nova senha" required>
                </div>
                 <!-- Botão entrar -->
                 <input class="btn btn-outline-info btn-entrar" type="submit" name="entrar" value="Entrar">

</form>
<?php
}else{
    echo '<h1>Pagina não encontrada';
}
?>
</body>
</html>
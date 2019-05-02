<?php

$title = "MOTOFRETISTAS";

include '../../header.php';

if (!$_SESSION['adm']) {
    header('Location: /home.php');      //Se não for adm redireciona para HOME
    exit();
}

require '../../conexao.php';

try {
    $comando = $conexao->prepare("CALL buscarMotofretistas()");      //Busca as informações dos motofretistas no banco
    $comando->execute();
}
catch (PDOException $excecao) {
    echo "Erro ao buscar motofretistas: " . $excecao->getMessage();
}
?>

    <div class="container text-center">
        <h1 class="font-weight-light text-white">MOTOFRETISTAS</h1>
        <table class="table table-responsive table-bordered table-hover table-dark border-primary" style="display: table;">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Email</th>
                    <th scope="col">Celular</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php        //Enquanto pegar linhas com resultado entra no while e mostra informações
            while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)):?>
                <tr>
                    <td><?php echo $resultado['id_motofretista']; ?></td>
                    <td><?php echo $resultado['nm_motofretista']; ?> </td>
                    <td><?php echo $resultado['dt_nascimento']; ?></td>
                    <td><?php echo $resultado['ic_genero']; ?></td>
                    <td><?php echo $resultado['nm_email']; ?></td>
                    <td><?php echo $resultado['id_celular']; ?></td>
                    <td><?php echo $resultado['id_cpf']; ?></td>                                    <!-- Excluiro motofretista do ID selecionado -->
                    <td nowrap><a class="btn btn-danger" href="excluir.php?id=<?php echo $resultado['id_motofretista']; ?>">Excluir <i class="fas fa-times"></i></a></td>
                </tr>
            <?php
            endwhile;
            ?>
            </tbody>
        </table>
    </div>

<?php
include '../../footer.php';
?>
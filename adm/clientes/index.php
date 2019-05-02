<?php

$title = "CLIENTES";

include '../../header.php';

if (!$_SESSION['adm']) {
    header('Location: /home.php');
    exit();
}

require '../../conexao.php';

try {
    $comando = $conexao->prepare("CALL buscarClientes()");
    $comando->execute();
}
catch (PDOException $excecao) {
    echo "Erro ao buscar clientes: " . $excecao->getMessage();
}
?>

<div class="container text-center">
    <h1 class="font-weight-light text-white">CLIENTES</h1>
    <table class="table table-bordered table-hover table-dark border-primary">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Nascimento</th>
            <th scope="col">CPF</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)):?>
        <tr>
            <td><?php echo $resultado['id_cliente']; ?></td>
            <td><?php echo $resultado['nm_cliente']; ?> </td>
            <td><?php echo $resultado['dt_nascimento']; ?></td>
            <td><?php echo $resultado['id_cpf']; ?></td>
            <td><?php echo $resultado['nm_email']; ?></td>
            <td><?php echo $resultado['cd_celular']; ?></td>
            <td><a class="btn btn-danger" href="excluir.php?id=<?php echo $resultado['id_cliente']; ?>">Excluir <i class="fas fa-times"></i></a></td>
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
<?php

$title = "CLIENTES";

include '../../header.php';

if (!$_SESSION['admin']) {
    header('Location: /home.php');
    exit();
}

require '../../conexao.php';

try {
    $comando = $conexao->prepare("CALL buscarClientes()");
    $comando->execute();
}
catch (PDOException $excecao) {
    $erro = "Erro ao mostrar clientes";
}
?>
<style>
    table{
       table-layout: fixed;
    }
    td{
        word-wrap:break-word
    }
</style>

    <div class="container text-center">
        <h1 class="font-weight-light">CLIENTES</h1>
        <table id="tabelaClientes" class="table table-striped table-responsive-lg table-bordered table-hover">
            <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Nascimento</th>
                <th scope="col">CPF</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <?php if (!isset($erro)) { ?>
                <tbody>
                <?php
                while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) {
                    if (!$resultado['ativo']) { continue; } ?>
                    <tr>
                        <td><?= $resultado['nm_cliente'] ?> </td>
                        <td><?= date("d/m/Y", strtotime($resultado['dt_nascimento'])) ?></td>
                        <td nowrap class="cpf"><?= $resultado['id_cpf'] ?></td>
                        <td><?= $resultado['nm_email'] ?></td>
                        <td nowrap class="celular"><?= $resultado['cd_celular'] ?></td>
                        <td>
                            <a class="btn btn-outline-warning" href="editar.php?id=<?= $resultado['id_cliente'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-danger" href="excluir.php?id=<?= $resultado['id_cliente'] ?>"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            <?php } ?>
        </table>
    </div>

    <script>
        $(document).ready(() => {
            $('#tabelaClientes').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum cliente encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ clientes",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 clientes",
                    "sInfoFiltered": "(Filtrados de _MAX_ clientes)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ clientes por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum clientes encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });


            $(".celular").inputmask("(99)9999-9999[9]");
            $(".cpf").inputmask("999.999.999-99");
            $(".nascimento").inputmask("datetime", {displayFormat: "dd/mm/yyyy"});
        });
    </script>

<?php
include '../../footer.php';
?>

<?php

$title = "MOTOFRETISTAS";

include '../../header.php';

if (!$_SESSION['admin']) {
    header('Location: /home.php');      //Se não for admin redireciona para HOME
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
        <h1 class="font-weight-light">MOTOFRETISTAS</h1>
        <table id="tabelaMotofretistas" class="table table-responsive-lg table-bordered table-hover" style="display: table;">
            <thead class="bg-dark text-white">
            <tr>
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
            while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) {
                if (!$resultado['ativo']) { continue; } ?>
                <tr>
                    <td nowrap><?= $resultado['nm_motofretista'] ?> </td>
                    <td><?= date("d/m/Y", strtotime($resultado['dt_nascimento'])) ?></td>
                    <td><?= $resultado['ic_genero'] ?></td>
                    <td><?= $resultado['nm_email'] ?></td>
                    <td nowrap class="celular"><?= $resultado['id_celular'] ?></td>
                    <td nowrap class="cpf"><?= $resultado['id_cpf'] ?></td>
                    <td nowrap>
                        <a class="btn btn-outline-warning"
                           href="editar.php?id=<?php echo $resultado['id_motofretista']; ?>"><i class="fas fa-edit"></i></a>
                        <!-- Editar o motofretista do ID selecionado -->
                        <a class="btn btn-outline-danger"
                           href="excluir.php?id=<?php echo $resultado['id_motofretista']; ?>"><i
                                    class="fas fa-times"></i></a> <!-- Excluir o motofretista do ID selecionado -->
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(() => {
            $('#tabelaMotofretistas').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum motofretista encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ motofretistas",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 motofretistas",
                    "sInfoFiltered": "(Filtrados de _MAX_ motofretistas)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ motofretistas por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum motofretistas encontrado",
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
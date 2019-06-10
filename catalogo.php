<?php
$title = "MOTOFRETISTAS";

include 'header.php';
require 'conexao.php';

try {
    $comando = $conexao->prepare("CALL buscarMotofretistas()"); //retorna os motofretistas do banco
    $comando->execute();
}
catch (PDOException $excecao) {
    $erro = "Erro ao buscar motofretistas";
}

?>
<!--Edição da foto para se adequar ao card mais arredondado -->
<style>
    img {
        width: 248px;
        height: 164px;
    }
</style>

<div class="container text-center">
    <div class="row">
        <div class="col-md-11 text-center">
            <h2 class="ml-5 ">MOTOFRETISTAS</h2>
        </div>
    </div>

    <table id="tabelaMotofretistas" class="table table-responsive table-hover">
        <thead style="visibility: hidden;"><th></th><th></th><th></th></thead>
        <tbody>
        <?php
        //Enquanto tiver resultados retornados da tabela
        while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td width="20%">
                    <img alt="Foto do motofretista" src="/image/motofretistas/<?= $resultado['urlFoto'] ?>" class="img-responsive">
                </td>

                <td width="70%">
                    <h5 class="text text-left text-truncate"><?= $resultado['nm_motofretista'] ?></h5>
                    <div class="d-flex flex-row flex-wrap">
                        <?php
                        $regioes = explode(",", $resultado['nm_regiao']);  //Separa as regiões por virgula
                        foreach ($regioes as $regiao) { // Loop para pegar cada região dentro de regiões ?>
                            <div style="border-radius: 20px" class="p-1 m-1 bg-light border"><?= $regiao ?></div>
                        <?php } ?>
                    </div>
                </td>

                <td width="10%">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal<?= $resultado['id_motofretista'] ?>">DETALHES</a>
                </td>
            </tr>
            <!--Modal para exibir detalhes do MOTOFRETISTA-->
            <div id="modal<?= $resultado['id_motofretista'] ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <?php if (isset($_SESSION['logado'])) { ?>
                                <h5 class="modal-title"><?= $resultado['nm_motofretista'] ?></h5>
                            <?php }
                            else { ?>
                                <h5 class="modal-title">Usuário não identificado</h5>
                            <?php } ?>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <?php if (isset($_SESSION['logado'])) { ?>
                                <div class="form-group text-left">
                                    <label for="telefone"><strong>Telefone: </strong></label>
                                    <input id="telefone" type="text" value="<?= $resultado['id_celular'] ?>" readonly/>
                                </div>
                                <div class="form-group text-left">
                                    <label><strong>Região de atuação: </strong></label>
                                </div>
                                <div class="d-flex flex-row flex-wrap justify-content-around">
                                    <?php
                                    foreach ($regioes as $regiao) { // Loop para pegar cada região dentro de regiões ?>
                                        <div style="border-radius: 20px" class="p-2 m-1 bg-light border"><?= $regiao ?></div>
                                    <?php } ?>
                                </div>
                            <?php }
                            else { ?>
                                <div class="row">
                                    <div class="col">
                                        <p>Para ver os dados do motofretista</p>
                                        <p>Clique <a href="home.php">aqui</a> para efetuar login ou se cadastrar.</p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
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

        $("input[type=text]").inputmask("(99) 9999-9999[9]"); //Mascara para formatar o celular
    });
</script>

<?php include 'footer.php' ?>

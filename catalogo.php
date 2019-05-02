<?php
$title = "CATÁLOGO DE MOTOFRETISTA";

include 'header.php';
require 'conexao.php';

try {
    $comando = $conexao->prepare("CALL buscarMotofretistas()"); //retorna os motofretistas do banco
    $comando->execute();
}
catch (PDOException $excecao) {
    echo "Erro ao buscar motofretistas:" . $excecao->getMessage();
}

?>
        <!--Edição da foto para se adequar ao card mais arredondado -->
        <style>
            .card-img-top {
                border-radius: 25px 25px 0 0;
            }
            img {
                width: 248px;
                height: 164px;
            }
        </style>

        <div class="container text-center">
            <h2 class="font-weight-light text-white">CATÁLOGO DE MOTOFRETISTAS</h2>
            <div class="container">

                <?php
                $contador = 0;
                while ($contador < $comando->rowCount()) { ?>
                    <div class="row mb-3">

                    <?php               //Equanto tiver resultados retornados da tabela
                    while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="col-4">
                            <div class="card">
                                <img src="avatar.svg" class="card-img-top">
                                <div class="card-body">                                                           <!--aponta para o modal que tem o id do motofretista-->
                                    <h5 class="card-title"><?php echo $resultado['nm_motofretista']; ?></h5>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $resultado['id_motofretista']; ?>">DETALHES</a>
                                </div>
                            </div>
                        </div>

                        <!--Modal para exibir detalhes do MOTOFRETISTA-->
                        <div id="modal<?php echo $resultado['id_motofretista']; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?php echo $resultado['nm_motofretista']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="telefone" class="col-sm-2 col-form-label"><strong>Telefone: </strong></label>
                                            <div class="col-sm-10">
                                                <input id="telefone" class="form-control-plaintext" type="text" value="<?php echo $resultado['id_celular']; ?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="mx-3"><strong>Região de atuação: </strong></label>
                                        </div>
                                        <div class="row justify-content-center">
                                            <?php
                                            $regioes = explode(",", $resultado['nm_regiao']);  //Separa as regiões por virgula
                                            foreach ($regioes as $regiao) { // Loop para pegar cada região dentro de regiões ?>
                                                <div style="border-radius: 20px" class="col-3 p-2 m-1 bg-light border"><?php echo $regiao; ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php
                        $contador++;
                        if ($contador % 3 == 0) break; //Contador de card
                    } ?>
                    </div>
                <?php
                }?>
            </div>
        </div>

<script>
    $(document).ready( function() {
        $("input[type=text]").inputmask("(99) 9999-9999[9]"); //Mascara para formatar o celular
    });
</script>

<?php include 'footer.php' ?>
<?php
$title = "SOBRE NÓS";

include 'header.php' ?>
<style type="text/css">
body {
        width: 100%;
        background-image: url(image/sobre.png) !important;
        background-repeat: no-repeat;
        background-position: 100% 100%;
        background-size: cover;
       
        
        
    }
</style>
<div class="container text-center">
    <div class="row">
        <div class="col-md-11 text-center">
             <h2 class="ml-5 align-middle ml-4">SOBRE NÓS</h2>
             
        </div>
    </div>
</div>
<br>
<div class="card m-auto text-left" >
    <div class="card-body">
            
            <div class="container text-center">
                <b>O POP!</b> é uma plataforma com o objetivo de promover ideias de tecnologia para integração digital de autônomos.
                Para atender as demandas de mobilidade e rapidez no estilo de vida urbano surgiu o POP! Motofrete.
                Nossa missão é facilitar e divulgar os prestadores de serviço para que sejam protagonistas do seu negócio.
                E permitir que clientes que buscam por essa mão de obra tenham maior comodidade acessando o POP! para encontrá-los.
                Priorizamos a transparência, ética e eficiência para que todos possam aproveitar o melhor dessa ferramenta.
                Comece agora mesmo!
                <!--CADASTRE-SE-->
                <a class="nav-item" href="#" data-toggle="modal" data-target="#modal">CADASTRE-SE</a>     

                <!--Modal para cadastro de CLIENTE ou MOTOFRETISTA-->
                   <div id="modal" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
                     <div class="modal-dialog">

                <!-- Conteúdo do modal -->
                 <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Para iniciar o cadastro selecione:</h5>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <a href="Cadastro/motofretista.php" class="btn btn-outline-warning">Sou motofretista</a>
                        <a href="Cadastro/cliente.php" class="btn btn-outline-info float-right">Sou cliente</a>
                    </div>

                </div>

            </div>
        </div> no POP! para escolher o Motofretista ideal para realizar serviços de entregas, retiradas,
                recebimentos e muito mais!
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>

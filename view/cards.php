<?php
require "../dao/conexao.php";

//select produtos totais
$sql_produtos_totais = "SELECT * FROM produto";
$result_produtos_totais = mysqli_query($conexao, $sql_produtos_totais);
$row_produtos_totais = mysqli_num_rows($result_produtos_totais);

//select fornecedores totais
$sql_fornecs_total = "SELECT * FROM fornecedores";
$result_fornecs_total = mysqli_query($conexao, $sql_fornecs_total);
$row_fornecs_total = mysqli_num_rows($result_fornecs_total);

//select últimos produtos
$sql_ultimos_produtos = "SELECT p.codigo,p.descricao,p.tipo,p.fornecedor,p.unidade,p.valor_unidade, f.id,f.nome
FROM produto as p INNER JOIN fornecedores as f ON p.fornecedor=f.id ORDER BY codigo DESC LIMIT 5";
$result_ultimos_produtos = mysqli_query($conexao, $sql_ultimos_produtos);

//select ultimos fornecedores
$sql_fornecs = "SELECT * FROM fornecedores ORDER BY id DESC LIMIT 5";
$result_fornecs = mysqli_query($conexao, $sql_fornecs);

//select Excesso de estoque
$sql_excesso = "SELECT * FROM produto WHERE quantidade > 100";
$result_excesso = mysqli_query($conexao, $sql_excesso);
$row_excesso = mysqli_num_rows($result_excesso);

//Abaixo do limite de estoque
$sql_abaixo = "SELECT * FROM produto WHERE quantidade <0";
$result_abaixo = mysqli_query($conexao, $sql_abaixo);
$row_abaixo = mysqli_num_rows($result_abaixo);

//select estoque total
$sql_total = "SELECT SUM(valor_unidade*quantidade) as total FROM produto";
$result_total = mysqli_query($conexao, $sql_total);

?>

<style>
    .cor {
        background-color: seagreen;
    }
    .fa-dinh{
        color: darkgreen;
    }
    .fa-alto{
        color:darkorange;
    }
    .fa-baixo{
        color: red;
    }
    .fa-cad{
        color: blue;
    }
</style>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-chart-area"></i>
        Avisos
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-dark bg-outline-dark o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-cad fa-fw fa-info-circle"></i>
                        </div>
                        <div>Produtos cadastrados:<strong> <?php echo $row_produtos_totais; ?></strong></div>
                        <div>Fornecedores cadastrados:<strong> <?php echo $row_fornecs_total; ?></strong></div>
                        <p style="font-size:70%;">Informações em tempo real. </p>
                    </div>
                    <a class="cursor card-footer text-dark clearfix small z-1" data-toggle="collapse" data-target="#collapseMais_usados" aria-expanded="false" aria-controls="collapseMais_usados">
                        <span class="float-left">Ver mais informações</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-outline-dark o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-alto fa-fw fa-angle-double-up"></i>
                        </div>
                        <div>Produtos em Excesso:<strong><?php echo " " . $row_excesso; ?></strong></div>
                        <p style="font-size:70%;">Produtos com quantidade superior a : 100 unidades</p>
                    </div>
                    <a class="cursor card-footer text-dark clearfix small z-1" data-toggle="collapse" data-target="#collapseExcesso" aria-expanded="false" aria-controls="collapseExcesso">
                        <span class="float-left">Ver detalhes</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-outline-dark o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-baixo fa-fw fa-exclamation-triangle"></i>
                        </div>
                        <div>Abaixo do Estoque:<strong><?php echo " " . $row_abaixo; ?></strong></div>
                        <p style="font-size:70%;">Produtos com quantidade inferior a : 0 unidades. </p>
                    </div>
                    <a class="cursor card-footer text-dark clearfix small z-1" data-toggle="collapse" data-target="#collapseAbaixo_estoque" aria-expanded="false" aria-controls="collapseAbaixo_estoque">
                        <span class="float-left">Ver Detalhes</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-outline-dark o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-dinh fa-fw fa-comment-dollar"></i>
                        </div>
                        <div>Valor em estoque atual:</div>

                        <!-- total estoque -->
                        <?php while ($dados_total = mysqli_fetch_array($result_total)) {
                            ?> <strong>R$ <?php
                                                $valor_total_formatado = number_format($dados_total['total'], 2, ',', '.');
                                                echo $valor_total_formatado; ?></strong>
                        <?php
                        }
                        ?>
                        <p style="font-size:70%;">Estoque em tempo real. </p>
                    </div>
                    <a href="lista_estoque.php" class="cursor card-footer text-dark clearfix small z-1" aria-expanded="false">
                        <span class="float-left">Verificar estoque</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Produtos/fornecedores -->
        <div class="collapse" id="collapseMais_usados">
            <div class="card card-body alert alert-primary" role="alert">
                <div class="row">
                    <!-- fornecedores -->
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-industry"></i>
                                Informações de fornecedores:</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                Últimos fornecedores cadastrados:</div>
                                            <div class="card-body">
                                                <!--Tabela abaixo estoque -->
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Id</th>
                                                            <th scope="col">Razão Social</th>
                                                            <th scope="col">CNPJ</th>
                                                            <th scope="col">UF</th>
                                                            <th scope="col">Estabelecimento</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($dados_fornecs = mysqli_fetch_array($result_fornecs)) {
                                                            echo "<tr>";
                                                            echo "<th scope='row'>" . $dados_fornecs['id'] . "</th>";
                                                            echo  "<td>" . $dados_fornecs['nome'] . "</td>";
                                                            echo  "<td>" . $dados_fornecs['cnpj'] . "</td>";
                                                            echo  "<td>" . $dados_fornecs['uf'] . "</td>";
                                                            echo  "<td>" . $dados_fornecs['tipo_estabelecimento'] . "</td>";
                                                            echo "<tr>";
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer small text-muted"> Atualizado em :
                                                <?php date_default_timezone_set('America/Sao_Paulo');
                                                $date = date('d-m-y H:i');
                                                echo $date; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <i class="fas fa-chart-pie"></i>
                                                Classificações de fornecedores:</div>
                                            <div class="card-body">
                                                <canvas id="fornecedores" width="100%" height="95,5"></canvas>
                                            </div>
                                            <div class="card-footer small text-muted"> Atualizado em :
                                                <?php date_default_timezone_set('America/Sao_Paulo');
                                                $date = date('d-m-y H:i');
                                                echo $date; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- produtos -->                                    
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-archive"></i>
                                Informações de produtos:</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                Últimos Produtos cadastrados:</div>
                                            <div class="card-body">
                                                <!--Tabela abaixo estoque -->
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Id</th>
                                                            <th scope="col">Descrição</th>
                                                            <th scope="col">Tipo</th>
                                                            <th scope="col">Fornecedor</th>
                                                            <th scope="col">Unidade</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($dados_ultimos_produtos = mysqli_fetch_array($result_ultimos_produtos)) {
                                                            echo "<tr>";
                                                            echo "<th scope='row'>" . $dados_ultimos_produtos['codigo'] . "</th>";
                                                            echo  "<td>" . $dados_ultimos_produtos['descricao'] . "</td>";
                                                            echo  "<td>" . $dados_ultimos_produtos['tipo'] . "</td>";
                                                            echo  "<td>" . $dados_ultimos_produtos['nome'] . "</td>";
                                                            echo  "<td>" . $dados_ultimos_produtos['unidade'] . "</td>";
                                                            echo "<tr>";
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer small text-muted"> Atualizado em :
                                                <?php date_default_timezone_set('America/Sao_Paulo');
                                                $date = date('d-m-y H:i');
                                                echo $date; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <i class="fas fa-chart-pie"></i>
                                                Classificações de produtos:</div>
                                            <div class="card-body">
                                                <canvas id="produtos" width="100%" height="95,5"></canvas>
                                            </div>
                                            <div class="card-footer small text-muted"> Atualizado em :
                                                <?php date_default_timezone_set('America/Sao_Paulo');
                                                $date = date('d-m-y H:i');
                                                echo $date; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <!-- Colapse excesso -->
        <div class="collapse" id="collapseExcesso">
            <div class="card card-body alert alert-warning" role="alert">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-archive"></i>
                                Produtos em excesso:</div>
                            <div class="card-body">

                                <?php if ($row_excesso >= 1) { ?>
                                    <!--Tabela excesso -->
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Descrição</th>
                                                <th scope="col">Quantidade</th>
                                                <th scope="col">Acertar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                require "modais/modal_saida.php";
                                                while ($dados_excesso = mysqli_fetch_array($result_excesso)) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $dados_excesso['codigo'] . "</th>";
                                                    echo  "<td>" . $dados_excesso['descricao'] . "</td>";
                                                    echo  "<td>" . $dados_excesso['quantidade'] . "</td>";
                                                    echo  "<td>" .
                                                        "<a href='' style='cursor:pointer;' data-toggle='modal' data-target='#modal_saida'><img src='../imagens/alterar.png' style='width:20%' class='media-object  img-responsive img-thumbnail'></a>"

                                                        . "</td>";
                                                    echo "<tr>";
                                                } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    Nenhum produto com excesso de estoque hoje ! <i class="fas fa-fw fa-check-circle"></i>
                                <?php } ?>

                            </div>
                            <div class="card-footer small text-muted"> Atualizado em :
                                <?php date_default_timezone_set('America/Sao_Paulo');
                                $date = date('d-m-y H:i');
                                echo $date; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Colapse Abaixo estoque-->
        <div class="collapse" id="collapseAbaixo_estoque">
            <div class=" card card-body alert alert-danger" role="alert">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-archive"></i>
                                Produtos abaixo do limite de estoque:</div>
                            <div class="card-body">

                                <?php if ($row_abaixo >= 1) { ?>
                                    <!--Tabela abaixo estoque -->
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Descrição</th>
                                                <th scope="col">Quantidade</th>
                                                <th scope="col">Acertar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                require "modais/modal_entrada.php";
                                                while ($dados_abaixo = mysqli_fetch_array($result_abaixo)) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $dados_abaixo['codigo'] . "</th>";
                                                    echo  "<td>" . $dados_abaixo['descricao'] . "</td>";
                                                    echo  "<td>" . $dados_abaixo['quantidade'] . "</td>";
                                                    echo  "<td>" .
                                                        "<a href='' style='cursor:pointer;' data-toggle='modal' data-target='#modal_entrada'><img src='../imagens/alterar.png' style='width:20%' class='media-object  img-responsive img-thumbnail'></a>"

                                                        . "</td>";
                                                    echo "<tr>";
                                                } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    Nenhum produto abaixo do estoque hoje ! <i class="fas fa-fw fa-check-circle"></i>
                                <?php } ?>
                            </div>
                            <div class="card-footer small text-muted"> Atualizado em :
                                <?php date_default_timezone_set('America/Sao_Paulo');
                                $date = date('d-m-y H:i');
                                echo $date; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
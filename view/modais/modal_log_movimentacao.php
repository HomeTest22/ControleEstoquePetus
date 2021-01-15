<?php
require "../dao/conexao.php";

$sql_log = "SELECT m.id,m.produto,m.quant_mov,m.motivo,m.data_mov,m.movimentacao,m.responsavel,p.codigo,p.descricao FROM movimentacoes_estoque as m
INNER JOIN produto as p ON m.produto=p.codigo";
$result_log = mysqli_query($conexao, $sql_log);


?>
<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="modal_log" id="modal_log" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div style="background-color:#007bff;" class="modal-header">
                <h5 class="modal-title" style="color:white;" id="exampleModalScrollableTitle">Log de Movimentações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Tabela de Movimentações</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Descrição</th>
                                        <th>Quantidade</th>
                                        <th>Motivo da movimentação</th>
                                        <th>Data de movimentação</th>
                                        <th>Tipo</th>
                                        <th>Responsável</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php while ($dados_log = mysqli_fetch_array($result_log)) {
                                            if($dados_log['movimentacao']==0){
                                                $mov='Entrada';
                                            }
                                            else{
                                                $mov='Saída';
                                            }
                                            echo "<tr>";
                                            echo "<td> " . $dados_log['id'] . "</td>";
                                            echo "<td> " . $dados_log['descricao'] . "</td>";
                                            echo "<td> " . $dados_log['quant_mov'] . "</td>";
                                            echo "<td> " . $dados_log['motivo'] . "</td>";
                                            echo "<td> " . date('d/m/Y', strtotime($dados_log['data_mov'])) . "</td>";
                                            echo "<td> " . $mov . "</td>";
                                            echo "<td> " . $dados_log['responsavel'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer small text-muted"> Atualizado em :
                        <?php date_default_timezone_set('America/Sao_Paulo');
                        $date = date('d-m-y H:i');
                        echo $date; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
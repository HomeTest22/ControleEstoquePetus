<?php
require "../dao/conexao.php";
$sql_devolucao = "SELECT * FROM produto";
$result_devolucao = mysqli_query($conexao, $sql_devolucao);

?>
<style>
    .cor {
        background-color: seagreen;
    }
</style>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_devolucao" tabindex="-1" role="dialog" aria-labelledby="modal_devolucaoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div style="background-color:#e67e00;" class="modal-header">
                <h5 class="modal-title" style="color:white;" id="modal_devolucaoTitle">Devolução para acerto de estoque:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../valida/valida_devolucao.php">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNome">Produto:</label>
                            <select class="form-control" value="" name="select_prod_devolucao" id="select_cliente">
                                <option value="" selected required>Selecione...</option>
                                <?php
                                while ($dados_devolucao = mysqli_fetch_array($result_devolucao)) {
                                    ?>
                                    <option value="<?php echo $dados_devolucao['codigo']; ?>">
                                        <?php
                                            echo $dados_devolucao['codigo'] . " - " . $dados_devolucao['descricao'];
                                            ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPreco">Motivo de devolução:</label>
                            <input type="text" name="motivo_devolucao" class="form-control" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPreco">Quantidade:</label>
                            <input type="number" name="quantidade_devolucao" class="form-control" required>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label" for="gridCheck">
                                Confirmar entrada
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" style="width:15%;" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" name="lancar_devolucao" style="background-color:#e67e00;" class="btn btn cor"><div style="color:white">Lançar</div></button>
            </div>
            </form>
        </div>
    </div>
</div>
</form>
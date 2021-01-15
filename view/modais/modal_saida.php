<?php
require "../dao/conexao.php";
$sql_acerto_saida = "SELECT * FROM produto";
$result_acerto_saida = mysqli_query($conexao, $sql_acerto_saida);

$sql_tabela_saida = "SELECT * FROM produto";
$result_tabela_saida = mysqli_query($conexao, $sql_tabela_saida);
?>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_saida" tabindex="-1" role="dialog" aria-labelledby="modal_saidaTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div style="background-color:#007bff;" class="modal-header">
                <h5 class="modal-title" style="color:white;" id="modal_saidaTitle">Saída para acerto de estoque:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../valida/valida_saida_estoque.php">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNome">Produto:</label>
                            <select class="form-control" value="" name="select_prod_saida" id="select_prod_saida">
                                <option value="" selected required>Selecione...</option>
                                <?php
                                while ($dados_acerto_saida = mysqli_fetch_array($result_acerto_saida)) {
                                    ?>
                                    <option value="<?php echo $dados_acerto_saida['codigo']; ?>">
                                        <?php
                                            echo $dados_acerto_saida['codigo'] . " - " . $dados_acerto_saida['descricao'];
                                            ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPreco">Motivo de acerto:</label>
                            <input type="text" name="motivo_saida" class="form-control" id="motivo" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPreco">Quantidade:</label>
                            <input type="number" name="quantidade_saida" class="form-control" id="quantidade" required>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label" for="gridCheck">
                                Confirmar Saída
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" style="width:15%;" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" style="width:15%;" name="lancar_saida" class="btn btn-primary"><div style="color:white">Lançar</div></button>
            </div>
            </form>
        </div>
    </div>
</div>
</form>
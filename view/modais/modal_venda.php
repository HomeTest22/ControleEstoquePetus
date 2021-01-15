<?php
require "../dao/conexao.php";

$sql_venda_produto = "SELECT * FROM produto";
$result_venda_produto = mysqli_query($conexao, $sql_venda_produto);

$sql_cliente_venda="SELECT * FROM clientes";
$result_cliente_venda = mysqli_query($conexao, $sql_cliente_venda);

?>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_venda" tabindex="-1" role="dialog" aria-labelledby="modal_vendaTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div style="background-color:#007bff;" class="modal-header">
        <h5 class="modal-title" style="color:white;" id="modal_cadastrar_produtoTitle">Venda:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Formulario-->
        <form method="POST" action="../valida/valida_venda.php">
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputAddress">Selecionar Produto:</label>
                <select class="form-control" value="" name="select_prod_venda" id="select_cliente">
                  <option value="" selected required>Selecione...</option>
                  <?php
                  while ($dados_venda_produto = mysqli_fetch_array($result_venda_produto)) {
                  ?>
                    <option value="<?php echo $dados_venda_produto['codigo']; ?>">
                      <?php
                      echo $dados_venda_produto['codigo'] . " - " . $dados_venda_produto['descricao'];
                      ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputAddress">Selecionar Cliente:</label>
                <select class="form-control" value="" name="select_cliente_venda" id="select_cliente">
                  <option value="" selected required>Selecione...</option>
                  <?php
                  while ($dados_cliente_venda = mysqli_fetch_array($result_cliente_venda)) {
                  ?>
                    <option value="<?php echo $dados_cliente_venda['id']; ?>">
                      <?php
                      echo $dados_cliente_venda['id'] . " - " . $dados_cliente_venda['nome'];
                      ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </div>

            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Pagamento:</label>
                <select id="inputState" name="pagamento" class="form-control" required>
                  <option value="" selected require>--Selecione--</option>
                  <option value="debito">Cartão Débito</option>
                  <option value="credito">Cartão Crédito</option>
                  <option value="crediario">Crediário</option>
                  <option value="dinheiro">Dinheiro</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Condição:</label>
                <select id="inputState" name="condicao" class="form-control" required>
                  <option value="" selected require>--Selecione--</option>
                  <option value="30">30 Dias</option>
                  <option value="60">60 Dias</option>
                  <option value="120">120 Dias</option>
                  <option value="vista">Vista</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" class="form-control" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="usuario">Data da venda:</label>
                <input type="date" class="form-control" name="data_venda" required>
              </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" required>
                <label class="form-check-label" for="gridCheck" required>
                  Confirmar Venda
                </label>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="finalizar_venda" class="btn btn-primary">
          <div style="color:white">Finalizar</div>
        </button>
      </div>
      </form>
    </div>
  </div>
</div>
</form>
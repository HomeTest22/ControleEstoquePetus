 <!-- select do código -->
 <?php
  require "../dao/conexao.php";
  $sql_fornecedor = "SELECT id FROM fornecedores ORDER BY id DESC LIMIT 1";
  $result_fornecedor = mysqli_query($conexao, $sql_fornecedor);
  $dados_fornecedor = mysqli_fetch_array($result_fornecedor);
  ?>
 <!-- Modal -->
 <div class="modal fade bd-example-modal-lg" id="modal_cadastrar_fornecedor" tabindex="-1" role="dialog" aria-labelledby="modal_cadastrar_fornecedorTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div style="background-color:#007bff;" class="modal-header">
         <h5 class="modal-title" style="color:white;" id="modal_cadastrar_fornecedorTitle">Cadastrar novo Fornecedor:</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <!--Formulario-->
         <form method="POST" action="../valida/valida_cadastro_fornecedor.php">
           <div class="modal-body">
             <div class="form-group">
               <label for="inputAddress">Nome do Fornecedor:</label>
               <input type="text" name="nome_fornecedor" class="form-control" id="nome_fornecedor" placeholder="Nome" required>

             </div>
             <div class="form-row">
               <div class="form-group col-md-6">
                 <label for="inputEmail4">Cnpj:</label>
                 <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="Cnpj" required>
               </div>
               <div class="form-group col-md-6">
                 <label for="tipo_produto">UF (Sigla):</label>
                 <input type="text" name="uf" class="form-control" id="uf" placeholder="UF" required>
               </div>
             </div>
             <div class="form-row">
               <div class="form-group col-md-4">
                 <label for="quantidade">Tipo de Estabelecimento:</label>
                 <select id="inputState" name="tipo_estabelecimento" class="form-control" required>
                   <option value="" selected require>--Selecione--</option>
                   <option value="Industria">Indústria</option>
                   <option value="distribuidora">Distribuidora</option>
                   <option value="Loja">Loja</option>
                   <option value="me">M.E</option>
                 </select>
               </div>
               <div class="form-group col-md-2">
                 <label for="data">Código:</label>
                 <input class="form-control" id="data_cadastro" value="<?php echo ($dados_fornecedor['id'] + 1); ?>" disabled>
               </div>

             </div>
             <div class="form-group">
               <div class="form-check">
                 <input class="form-check-input" type="checkbox" id="gridCheck" required>
                 <label class="form-check-label" for="gridCheck" required>
                   Confirmar Cadastro
                 </label>
               </div>
             </div>
           </div>
       </div>
       <div class="modal-footer">
         <button type="button" style="width:15%;" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
         <button type="submit" style="width:15%;" name="cadastrar" class="btn btn-primary"><div style="color:white">Cadastrar</div></button>
       </div>
       </form>
     </div>
   </div>
 </div>
 </form>
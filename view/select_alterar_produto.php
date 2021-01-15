<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

if ($_GET['id'] == "") {

  $_SESSION['select_vazio'] = true;
  header("Location:lista_produtos.php");
} else {

  $codigo_select = $_GET['id'];

  //select dos dados produtos
  $sql_selecionado = "SELECT p.codigo,p.descricao,p.unidade,p.tipo,p.fornecedor,p.valor_unidade,f.id,f.nome FROM produto as p
  INNER JOIN fornecedores as f ON p.fornecedor=f.id
  where codigo ='$codigo_select'";
  $result_selecionado = mysqli_query($conexao, $sql_selecionado);
  $dados_selecionado = mysqli_fetch_array($result_selecionado);

  //select dos fornecedores
  $sql_fornecedores = "SELECT * FROM fornecedores";
  $result_fornecedores = mysqli_query($conexao, $sql_fornecedores);

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="../js/sweetalert.min.js"></script>

    <title>Alterção de Produto</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <style>
      .img {
        margin-top: 10%;
        margin-left: 10%;
        width: 20%;
      }

      .cor {
        background-color: seagreen;
      }
    </style>

  </head>

  <body id="page-top">
    <?php
      include_once "nav.php";
      ?>
    <div id="wrapper">
      <?php
        include_once "menu.php";
        ?>
      <div id="content-wrapper">
        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="painel.php">Painel Principal</a>
            </li>
            <li class="breadcrumb-item active">Alteração de Produto</li>
          </ol>

          <!--Formulario-->
          <form method="POST" action="../valida/valida_alter_prod.php">
            <div class="modal-body">
              <div class="form-group">
                <label for="inputAddress">Descrição do Produto:</label>
                <input type="text" name="nova_descricao" class="form-control" id="nome_produto" placeholder="<?php echo $dados_selecionado['descricao']; ?>">

              </div><br>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Unidade:</label>
                  <select id="inputState" name="nova_unidade" class="form-control">
                    <option value=" <?php echo $dados['unidade'] ?>" selected require> <?php echo $dados_selecionado['unidade'] ?> </option>
                    <option value="Unidade">Unidade</option>
                  <option value="Pacote">Pacote</option>
                  <option value="Caixa">Caixa</option>

                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="tipo_produto">Tipo Produto:</label>
                  <select id="inputState" name="novo_tipo_produto" class="form-control">
                    <option value="<?php echo $dados['tipo'] ?>" selected require><?php echo $dados_selecionado['tipo'] ?></option>
                    <option value="Biquini">Biquíni</option>
                  <option value="Blusa">Blusa</option>
                  <option value="Body">Body</option>
                  <option value="Calca">Calça</option>
                  <option value="Camisa">Camisa</option>
                  <option value="Camiseta">Camiseta</option>
                  <option value="Cropped">Cropped</option>
                  <option value="Jaqueta">Jaqueta</option>
                  <option value="Maio">Maiô</option>
                  <option value="Regata">Regata</option>
                  <option value="Short">Short</option>
                  <option value="Moletom">Moletom</option>
                  <option value="Diversos">Diversos</option>

                  </select>
                </div>
              </div><br>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="quantidade">Fornecedor:</label>
                  <select class="form-control" value="" name="novo_fornecedor" id="select_serv">
                    <option value="" selected required><?php echo $dados_selecionado['id'] . " - " . $dados_selecionado['nome'] ?></option>
                    <?php
                      while ($dados_fornecedor = mysqli_fetch_array($result_fornecedores)) {
                        ?>
                      <option value="<?php echo $dados_fornecedor['id']; ?>">
                        <?php
                            echo $dados_fornecedor['id'] . " - " . $dados_fornecedor['nome'];
                            ?>
                      </option>
                    <?php
                      }
                      ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="usuario">Custo unidade</label>
                  <input type="number" step="0.01" class="form-control" name="novo_valor_unidade" id="valor_unidade" placeholder="R$<?php echo $dados_selecionado['valor_unidade']; ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="data">Código do produto:</label>
                  <input class="form-control" value="<?php echo $dados_selecionado['codigo']; ?>" disabled>
                  <input type="hidden" name="cod_prod" value="<?php echo $dados_selecionado['codigo']; ?>">

                </div>

              </div><br>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck" required>
                  <label class="form-check-label" for="gridCheck" required>
                    Confirmar Alteração
                  </label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="lista_produtos.php.php" style="width:15%" type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
              <button type="submit"style="width:15%"  name="alterar" class="btn btn-primary"><div style="color:white">Alterar</div></button>
            </div>
          </form>



        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>OutCloud© Controle de Estoque 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

  
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>

  </body>

  </html>
<?php } ?>
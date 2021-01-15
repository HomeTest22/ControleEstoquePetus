<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

//select do select
$sql_alterar = "SELECT * FROM produto";
$result_alterar = mysqli_query($conexao, $sql_alterar);

//select dos dados dos produtos para lista
$sql2 = "SELECT p.codigo,p.descricao,p.tipo,p.unidade,p.data_cadastro,p.quantidade,p.fornecedor,p.valor_unidade,
f.nome,f.id
FROM produto AS p
INNER JOIN fornecedores as f
ON p.fornecedor=f.id";
$result2 = mysqli_query($conexao, $sql2);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Alterar Produto</title>

  <script src="../js/sweetalert.min.js"></script>

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
    .preload {
      position: fixed;
      z-index: 99999;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.50;
      -moz-opacity: 0.50;
      filter: alpha(opacity=50);
      background: black;
      background-image: url('../imagens/loader.gif');
      background-size: 60px 60px;
      background-position: center;
      background-repeat: no-repeat;
      overflow: hidden;
    }
  </style>

</head>

<body id="page-top">
    <div id="preload" class="preload"></div>
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
          <li class="breadcrumb-item active">Alterar Produto</li>
        </ol>

        <!--alerts -->
        <?php if (isset($_SESSION['prod_alterado'])) { ?>
          <script>
            swal("Feito!", "Produto alterado com sucesso!", "success")
          </script>
        <?php
          unset($_SESSION['prod_alterado']);
        } ?>

        <?php if (isset($_SESSION['select_vazio'])) { ?>
          <script>
            swal("Ops...", "Selecione um produto!", "warning")
          </script>
        <?php
          unset($_SESSION['select_vazio']);
        } ?>

        <?php if (isset($_SESSION['prod_nao_alterado'])) { ?>
          <script>
            swal("Ops...", "Produto não pôde ser alterado!", "error")
          </script>
        <?php
          unset($_SESSION['prod_nao_alterado']);
        } ?>

        <!--Formulário para alteração -->
        <form  method="POST" action="select_alterar_produto.php">
          <div class="row">
            <div class="col">
            <select class="form-control" value="" name="select_prod" id="select_serv">
                <option value="selecione" selected required>Selecione...</option>
                <?php
                while ($dados_alterar = mysqli_fetch_array($result_alterar)) {
                  ?>
                  <option value="<?php echo $dados_alterar['codigo']; ?>">
                    <?php
                      echo $dados_alterar['codigo'] . " - " . $dados_alterar['descricao'];
                      ?>
                  </option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="col">
              <button type="submit" name="alterar" class="btn btn-success mb-2"><div style="color:white">Mostrar</div></button>
            </div>
          </div>
        </form>



        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Tabela de Produtos</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Fornecedor</th>
                    <th>Unidade</th>
                    <th>Valor unitário</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Fornecedor</th>
                    <th>Unidade</th>
                    <th>Valor unitário</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php while ($dados2 = mysqli_fetch_array($result2)) {

                    $valor_unidade_formatado = number_format($dados2['valor_unidade'], 2, ',', '.');

                    echo "<tr>";
                    echo "<td> " . $dados2['codigo'] . "</td>";
                    echo "<td> " . $dados2['descricao'] . "</td>";
                    echo "<td> " . $dados2['tipo'] . "</td>";
                    echo "<td> " . $dados2['nome'] . "</td>";
                    echo "<td> " . $dados2['unidade'] . "</td>";
                    echo "<td> " . "R$" . $dados2['valor_unidade'] . "</td>";
                    echo "</tr>";
                  }
                  ?>
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

      <!--Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          <span>Petus © Controle de Estoque 2020</span>
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
  <script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 1000);
    });
  </script>

</body>

</html>
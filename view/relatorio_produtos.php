<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

$sql_produtos = "SELECT * FROM produto ORDER BY codigo";
$result_produtos = mysqli_query($conexao, $sql_produtos);
$row_produtos = mysqli_num_rows($result_produtos);

//select estoque total
$sql_total_prod = "SELECT SUM(valor_unidade*quantidade) as total FROM produto";
$result_total_prod = mysqli_query($conexao, $sql_total_prod);


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Relatório Produtos</title>

  <script src="../js/sweetalert.min.js"></script>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style>
    .cursor {
      cursor: pointer;
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
  <!--Incluindo o nav-->
  <?php
  include_once "nav.php";
  ?>

  <div id="wrapper">
    <!-- Incluindo o menu -->
    <?php
    include_once "menu.php";
    ?>

    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="planilha_produtos.php">Exportar excel</a>
          </li>
          <li class="breadcrumb-item">
            <a href="gerar_pdf_produtos.php">Exportar PDF</a>
          </li>
        </ol>

        <h4 style="text-align:center"><strong> Relatório Produtos</strong></h4><br>

        <?php
        if ($row_produtos == "0") { ?>
          <div class="alert alert-warning" role="alert">
            Nenhum produto cadastrado <i class="fas fa-fw fa-exclamation-triangle"></i>
          </div>

        <?php
        } else { ?>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Descrição</th>
                  <th>Unidade</th>
                  <th>Quantidade</th>
                  <th>Valor unitário</th>
                  <th>Valor em Estoque</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($dados_produtos = mysqli_fetch_array($result_produtos)) {

                    $valor_produtos = ($dados_produtos['quantidade'] * $dados_produtos['valor_unidade']);
                    $valor_unidade_formatado = number_format($dados_produtos['valor_unidade'], 2, ',', '.');
                    $valor_produtos_formatado = number_format($valor_produtos, 2, ',', '.');

                    echo "<tr>";
                    echo "<td> " . $dados_produtos['codigo'] . "</td>";
                    echo "<td> " . $dados_produtos['descricao'] . "</td>";
                    echo "<td> " . $dados_produtos['unidade'] . "</td>";
                    echo "<td> " . $dados_produtos['quantidade'] . "</td>";
                    echo "<td> " . "R$" . $dados_produtos['valor_unidade'] . "</td>";
                    echo "<td> " . "R$" . $valor_produtos_formatado . "</td>";
                    echo "</tr>";
                  }
                  ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th> </th>
                  <th>Total:
                    <!-- total estoque -->
                    <?php while ($dados_total_prod = mysqli_fetch_array($result_total_prod)) {
                        ?> <strong>R$ <?php
                                              $valor_total_formatado = number_format($dados_total_prod['total'], 2, ',', '.');
                                              echo $valor_total_formatado; ?></strong>
                    <?php
                      }
                      ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
        <?php
        }
        ?>


      </div>
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Petus © Controle de Estoque 2020</span>
          </div>
        </div>
      </footer>

    </div>
  </div>

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
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>
<script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 1000);
    });
  </script>
</body>

</html>
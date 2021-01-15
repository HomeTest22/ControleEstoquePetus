<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

$sql_estoque = "SELECT p.codigo,p.descricao,p.tipo,p.unidade,p.data_cadastro,p.quantidade,p.fornecedor,p.valor_unidade,
f.nome,f.id
FROM produto AS p
INNER JOIN fornecedores as f
ON p.fornecedor=f.id";
$result_estoque = mysqli_query($conexao, $sql_estoque);


//select estoque total
$sql_total2 = "SELECT SUM(valor_unidade*quantidade) as total FROM produto";
$result_total2 = mysqli_query($conexao, $sql_total2);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Estoque Atual</title>

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
      
      .canto {

   position: fixed;

   left: 0pt;

}
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
          <li class="breadcrumb-item active">Estoque Atual</li>
        </ol>

        <!--alerts-->
        <?php if (isset($_SESSION['entrada_feita'])) { ?>
          <script>
            swal("Feito", "Entrada efetuada com sucesso!", "success")
          </script>
        <?php

          unset($_SESSION['entrada_feita']);
        } ?>

        <?php if (isset($_SESSION['saida_feita'])) { ?>
          <script>
            swal("Feito", "Saída efetuada com sucesso!", "success")
          </script>
        <?php

          unset($_SESSION['saida_feita']);
        } ?>

        <?php if (isset($_SESSION['devolucao_feita'])) { ?>
          <script>
            swal("Feito", "Devolução efetuada com sucesso!", "success")
          </script>
        <?php

          unset($_SESSION['devolucao_feita']);
        } ?>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
              Estoque Atual
              
        <?php require "modais/modal_entrada.php";
        require "modais/modal_saida.php";
        require "modais/modal_devolucao.php"; ?>
        
            <button type="button" data-toggle="modal" style="width:110px;" data-target="#modal_entrada" class="btn btn-outline-primary canto"> <i class="fa fa-plus" aria-hidden="true"></i> Entrada</button>
              <button type="button" data-toggle="modal" style="width:110px;;" data-target="#modal_saida" class="btn btn-outline-primary canto"> <i class="fa fa-minus" aria-hidden="true"></i> Saída</button>
              
              </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                    <th>Unidade</th>
                    <th>Quantidade</th>
                    <th>Valor unitário</th>
                    <th>Valor em Estoque</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php while ($dados_estoque = mysqli_fetch_array($result_estoque)) {

                    $valor_estoque = ($dados_estoque['quantidade'] * $dados_estoque['valor_unidade']);
                    $valor_unidade_formatado = number_format($dados_estoque['valor_unidade'], 2, ',', '.');
                    $valor_estoque_formatado = number_format($valor_estoque, 2, ',', '.');

                    echo "<tr>";
                    echo "<td> " . $dados_estoque['codigo'] . "</td>";
                    echo "<td> " . $dados_estoque['descricao'] . "</td>";
                    echo "<td> " . $dados_estoque['unidade'] . "</td>";
                    echo "<td> " . $dados_estoque['quantidade'] . "</td>";
                    echo "<td> " . "R$" . $valor_unidade_formatado . "</td>";
                    echo "<td> " . "R$" . $valor_estoque_formatado . "</td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">

            <!-- hora de atualização-->
            Atualizado em :
            <?php date_default_timezone_set('America/Sao_Paulo');
            $date = date('d-m-y H:i');
            echo $date; ?>

            <!-- total estoque -->
            <?php while ($dados_total2 = mysqli_fetch_array($result_total2)) {
              ?> <strong>Total em estoque : R$ <?php
              $valor_total_formatado2 = number_format($dados_total2['total'], 2, ',', '.');
              echo $valor_total_formatado2; ?></strong>
            <?php
            }
            ?>
          </div>
        </div>
      </div>

      <!-- Botão exportar-->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div style="margin-left:94%" class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="planilha_produtos.php"><button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button></a>
          </div>
        </div>
      </div>
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
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  
  <script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 500);
    });
  </script>

</body>

</html>
<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

$sql_lista_fornec = "SELECT * FROM fornecedores";
$result_lista_fornec = mysqli_query($conexao, $sql_lista_fornec);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Lista de Fornecedores</title>

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
          <li class="breadcrumb-item active">Tabela de Fornecedores</li>
        </ol>

        <!-- Alerts-->
        <?php if (isset($_SESSION['cadastrado'])) { ?>
          <script>
            swal("Feito", "Fornecedor cadastrado com sucesso!", "success")
          </script>
        <?php

          unset($_SESSION['cadastrado']);
        } ?>
        <?php if (isset($_SESSION['nao_cadastrado'])) { ?>
          <script>
            swal("Ops", "Fornecedor não pôde ser cadastrado!", "error")
          </script>
        <?php

          unset($_SESSION['nao_cadastrado']);
        } ?>
        <?php if (isset($_SESSION['fornec_alterado'])) { ?>
          <script>
            swal("Feito!", "Fornecedor alterado com sucesso!", "success")
          </script>
        <?php
          unset($_SESSION['fornec_alterado']);
        } ?>

        <?php if (isset($_SESSION['select_vazio'])) { ?>
          <script>
            swal("Ops...", "Selecione um produto!", "warning")
          </script>
        <?php
          unset($_SESSION['select_vazio']);
        } ?>

        <?php if (isset($_SESSION['fornec_nao_alterado'])) { ?>
          <script>
            swal("Ops...", "Fornecedor não pôde ser alterado!", "error")
          </script>
        <?php
          unset($_SESSION['fornec_nao_alterado']);
        } ?>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Tabela de Fornecedores 
            <?php require "modais/modal_cadastrar_fornecedor.php"?>
            <button style="" type="button" data-toggle="modal" data-target="#modal_cadastrar_fornecedor" class="btn btn-outline-primary fixed-right"> <i class="fa fa-user-plus" aria-hidden="true"></i> Cadastrar</button>
            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Cnpj</th>
                    <th>UF</th>
                    <th>Opções</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Cnpj</th>
                    <th>UF</th>
                    <th>Opções</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php while ($dados_lista_fornec = mysqli_fetch_array($result_lista_fornec)) {
                
                    echo "<tr>";
                    echo "<td> " . $dados_lista_fornec['id'] . "</td>";
                    echo "<td> " . $dados_lista_fornec['nome'] . "</td>";
                    echo "<td> " . $dados_lista_fornec['cnpj'] . "</td>";
                    echo "<td> " . $dados_lista_fornec['uf'] . "</td>";
                    echo "<td> " . "<a href='select_alterar_fornecedor.php?id=".$dados_lista_fornec['id']."' type='button' class='btn btn-outline-warning btn-sm 'data-toggle='tooltip' data-placement='top' title='Alterar' style='width:20%;'><i class='fa fa-cogs' aria-hidden='true'></i></a>"." "."<a href='' type='button' class='btn btn-outline-danger btn-sm' data-toggle='tooltip' data-placement='top' title='Excluir' style='width:20%;'><i class='fa fa-window-close' aria-hidden='true'></i></a>"."</td>";
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
        </div
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
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/demo/grafico_fornecedores.js"></script>
  <script src="../js/demo/grafico_produtos.js"></script>
<script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 500);
    });
  </script>
</body>

</html>
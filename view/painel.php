<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Painel Principal</title>

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
    <!-- Alerts-->
    <?php if (isset($_SESSION['mensagem_enviada'])) { ?>
      <script>
        swal("Feito", "Mensagem enviada com sucesso!", "success")
      </script>
    <?php

      unset($_SESSION['mensagem_enviada']);
    } ?>

    <?php if (isset($_SESSION['mensagem_nao_enviada'])) { ?>
      <script>
        swal("Ops", "Mensagem não pôde ser enviada!", "error")
      </script>
    <?php

      unset($_SESSION['mensagem_nao_enviada']);
    } ?>

    <?php if (isset($_SESSION['venda_feita'])) { ?>
      <script>
        swal("Feito", "Venda finalizada com sucesso!", "success")
      </script>
    <?php

      unset($_SESSION['venda_feita']);
    } ?>

    <?php if (isset($_SESSION['venda_nao_feita'])) { ?>
      <script>
        swal("Ops", "Venda não pôde ser finalizada!", "error")
      </script>
    <?php

      unset($_SESSION['venda_nao_feita']);
    } ?>

    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Painel Principal</a>
          </li>
          <li class="breadcrumb-item active">Visão global</li>
        </ol>

        <!--Incluindo Cards-->
        <?php
        include_once "cards.php";
        ?>

        <!--Mensagem de bem vindo -->
        <?php if (isset($_SESSION['bem_vindo'])) { ?>

          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
            <div class="toast-header">
              <img style="width:20%;" src="../imagens/logo_branca.png" class="rounded mr-2">
              <strong class="mr-auto">Seja bem vindo!</strong>
              <small>Hoje : <?php date_default_timezone_set('America/Sao_Paulo');
                            $date = date('H:i');
                            echo $date; ?></small>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body">
              <?php echo $_SESSION['usuario'];  ?>,Todas as suas informações foram atualizadas!
            </div>
          </div>
        <?php
          unset($_SESSION['bem_vindo']);
        } ?>

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
    $(document).ready(function() {

      $('.toast').toast('show');

    });
  </script>
  <script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 500);
    });
  </script>


</body>

</html>
<?php
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
  <title>Cadastro de Serviços</title>

  <script src="../js/sweetalert.min.js"></script>
  <!-- mask -->
  <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

  <title>Phantom Clientes</title>
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
  </style>
</head>

<body id="page-top">
  <?php
  include_once "nav.php";
  ?>

  <div id="wrapper">

    <?php
    $pagina = "clientes";
    include_once "menu.php";
    ?>
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="painel.php">Painel Principal</a>
          </li>
          <li class="breadcrumb-item active">Cadastrar Serviços</li>
        </ol>
        <?php if (isset($_SESSION['serv_cadastrado'])) { ?>
          <script>
            swal("Cadastrado", "Serviço cadastrado com sucesso!", "success");
          </script>
        <?php
          unset($_SESSION['serv_cadastrado']);
        } ?>

        <form method="POST" action="../valida/valida_cad_serv.php">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputNome">Descrição do Serviço: (corte, pigmentação, barba...)</label>
              <input type="text" name="nome_servico" class="form-control" id="inputNome" required>
            </div>
            <div class="form-group col-md-4">
              <label for="inputTipo">Tipo: (masculino, feminino, infantil...)</label>
              <input type="text" name="tipo_servico" class="form-control" id="inputTipo" required>

            </div>
            <div class="form-group col-md-2">
              <label for="inputPreco">Valor:</label>
              <input type="text" id="preco" name="preco_servico" class="dinheiro form-control" style="display:inline-block" placeholder="R$ 00,00" required />
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck" required>
              <label class="form-check-label" for="gridCheck">
                Confirmar cadastro
              </label>
            </div>
          </div>
          <button type="submit" style="width:10%" name="cadastrar" class="btn btn-primary">Cadastrar</button>
        </form>

      </div><br>
      <!--tabela de serviços -->
      <?php include "tabelas/tabela_servicos.php"; ?>

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

  <script>
  $(function() {
    $('.preco').mask('#.##0,00', {
      reverse: true
    });
  });
</script>

</body>



</html>
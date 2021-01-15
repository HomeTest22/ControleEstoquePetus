<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Controle de Estoque</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  
  <!-- alerts-->
  <script src="js/sweetalert.min.js"></script>

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Entrar no sistema</div>
      <div class="card-body">

        <form method="POST" action="valida/valida_login.php">
          <div class="form-group">

            <center>
              <img src="imagens/logo_index.png" style="width:45%; margin-top:-15%; margin-bottom:-10%">
            </center>
            <!-- Alerta de não autenticado -->
            <?php if (isset($_SESSION['nao_autenticado'])) { ?>
              <script>
                    swal("Ops", "Usuário ou senha incorretos!", "error")
              </script>
            <?php
              unset($_SESSION['nao_autenticado']);
            } ?>

            <div class="form-label-group">
              <input type="text" id="inputUsuario" name="usuario" class="form-control" placeholder="Usuário" required="required" autofocus="autofocus">
              <label for="inputUsuario">Usuário</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required="required">
              <label for="inputPassword">Senha</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Lembrar-me
              </label>
            </div>

          </div>
          <button type="submit" name="entrar" style="width:100%" class="btn btn-primary">Entrar </button>
        </form>
        <div class="text-center"><br>
          <a class="d-block small" href="forgot-password.html">Perdeu sua senha?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
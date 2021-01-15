<?php
session_start();
//include na conexão
require_once "../dao/conexao.php";

//Verifica se foi feito o post no Submit
if (isset($_POST['entrar'])) {

    //verifica se o usuário digitou algo nos campos
    if (empty($_POST['usuario']) && empty($_POST['senha'])) {
        
        echo "<script> alert('Digite um usuário ou senha válidos') </script>";
        header('Location: ../index.php');
        session_destroy();
    }

    //Se Digitou
    else {

        //tratando caracteres e previnindo SQL injection.
        $usuario = mysqli_real_escape_string($conexao, $_POST["usuario"]);
        $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);

        //Montando a query com o select ja verificando se o usuário e senha digitados conferem com os do banco.
        $query = "SELECT * from usuarios where usuario ='$usuario' and senha = '" . md5($senha) . "'";

        $result = mysqli_query($conexao, $query);

        //quantidade de linhas do result
        $row = mysqli_num_rows($result);

        //verificando se teve retorno de linha 
        if ($row == 1) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['bem_vindo'] = true;
            header("Location: ../view/painel.php");
        } else {
            $_SESSION['nao_autenticado'] = true;
            header("Location:../index.php");
        }
    }
}

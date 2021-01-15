<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['cadastrar_cliente'])) {

    $nome_cliente= ($_POST['nome_cli']);
    $identidade = ($_POST['identidade']);
    $uf = ($_POST['uf']);
    $tipo_cliente = ($_POST['tipo_cliente']);
    

    //inserir no banco.
    $sql = "INSERT INTO clientes (nome,identidade,uf,tipo)
          VALUE ('$nome_cliente','$identidade','$uf','$tipo_cliente')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        $_SESSION['cliente_nao_cadastrado'] = true;
        header('Location:../view/lista_clientes.php');

    } else {
        $_SESSION['cliente_cadastrado'] = true;
        header('Location:../view/lista_clientes.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}

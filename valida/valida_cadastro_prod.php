<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['cadastrar'])) {

    $descricao = ($_POST['descricao']);
    $quantidade = ($_POST['quantidade']);
    $unidade = ($_POST['unidade']);
    $tipo_produto = ($_POST['tipo_produto']);
    $select_fornecedor = ($_POST['select_fornecedor']);
    $valor_unidade = ($_POST['valor_unidade']);
    $responsavel = $_SESSION['usuario'];

    //inserir no banco.
    $sql = "INSERT INTO produto (descricao,quantidade,unidade,tipo,fornecedor,valor_unidade,responsavel)
          VALUE ('$descricao','$quantidade','$unidade','$tipo_produto','$select_fornecedor','$valor_unidade','$responsavel')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        echo "Falha ao inserir dados!";
        $_SESSION['nao_cadastrado'] = true;
        header('Location:../view/lista_produtos.php');

    } else {
        $_SESSION['cadastrado'] = true;
        header('Location:../view/lista_produtos.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}

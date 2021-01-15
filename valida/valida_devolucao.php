<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['lancar_devolucao'])) {

    $prod_devolucao= ($_POST['select_prod_devolucao']);
    $motivo = ($_POST['motivo_devolucao']);
    $quantidade_devolucao = ($_POST['quantidade_devolucao']);
    $responsavel=$_SESSION['usuario'];


    $quantidade_formatada = str_replace(',', '.', str_replace('.', '', $quantidade_devolucao));

    //inserir no banco.
    $sql1 = "INSERT INTO movimentacoes_estoque (produto,quant_mov,motivo,movimentacao,responsavel) VALUES ('$prod_devolucao','$quantidade_formatada','$motivo',2,'$responsavel)";
    $sql2="UPDATE produto set quantidade=quantidade+'$quantidade_formatada' WHERE codigo='$prod_devolucao'";

    //Incluir
    $resultado1 = mysqli_query($conexao, $sql1);
    $resultado2 = mysqli_query($conexao, $sql2);


    if (isset($resultado1) && isset($resultado2)) {
        $_SESSION['devolucao_feita'] = true;
        header('Location:../view/lista_estoque.php');
        exit();
    } else {
        echo "<script> alert('Não foi possível fazer a entrada');</script>";
    }
} else {
    echo "<script> alert('Não foi possível fazer a entrada');</script>";
}

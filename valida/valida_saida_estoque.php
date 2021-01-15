<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['lancar_saida'])) {


    $prod_saida = ($_POST['select_prod_saida']);
    $motivo = ($_POST['motivo_saida']);
    $quantidade_saida = ($_POST['quantidade_saida']);
    $responsavel=$_SESSION['usuario'];

    $quantidade_formatada = str_replace(',', '.', str_replace('.', '', $quantidade_saida));

    //inserir no banco.
    $sql1 = "INSERT INTO movimentacoes_estoque (produto,quant_mov,motivo,movimentacao,responsavel) VALUES ('$prod_saida','$quantidade_formatada','$motivo',1,'$responsavel')";
    $sql2="UPDATE produto set quantidade = quantidade - '$quantidade_formatada' WHERE codigo='$prod_saida'";

    //Incluir
    $resultado1 = mysqli_query($conexao, $sql1);
    $resultado2 = mysqli_query($conexao, $sql2);


    if (isset($resultado1) && isset($resultado2)) {
        $_SESSION['saida_feita'] = true;
        header('Location:../view/lista_estoque.php');
        exit();
    } else {
        echo "<script> alert('Não foi possível fazer a entrada');</script>";
    }
} else {
    echo "<script> alert('Não foi possível fazer a entrada');</script>";
}

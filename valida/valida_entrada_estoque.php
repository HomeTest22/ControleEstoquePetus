<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['lancar_entrada'])) {

    $prod_entrada = ($_POST['select_prod_entrada']);
    $motivo = ($_POST['motivo_entrada']);
    $quantidade_entrada = ($_POST['quantidade_entrada']);
    $responsavel=$_SESSION['usuario'];

    $quantidade_formatada = str_replace(',', '.', str_replace('.', '', $quantidade_entrada));

    //inserir no banco.
    $sql1 = "INSERT INTO movimentacoes_estoque (produto,quant_mov,motivo,movimentacao,responsavel) VALUES ('$prod_entrada','$quantidade_formatada','$motivo',0,'$responsavel')";
    $sql2="UPDATE produto set quantidade='$quantidade_formatada'+quantidade WHERE codigo='$prod_entrada'";

    //Incluir
    $resultado1 = mysqli_query($conexao, $sql1);
    $resultado2 = mysqli_query($conexao, $sql2);


    if (isset($resultado1) && isset($resultado2)) {
        $_SESSION['entrada_feita'] = true;
        header('Location:../view/lista_estoque.php');
        exit();
    } else {
        echo "<script> alert('Não foi possível fazer a entrada');</script>";
    }
} else {
    echo "<script> alert('Não foi possível fazer a entrada');</script>";
}

<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['excluir_mov'])) {

    $id_mov = ($_POST['id_mov']);


    //inserir no banco.
    $sql = "DELETE FROM movimentacoes WHERE id_mov='$id_mov'";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        echo "Falha ao inserir dados!";
    } else {
        $_SESSION['deletado'] = true;
        header('Location:../view/manutencao_servico.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}

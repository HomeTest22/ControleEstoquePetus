<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['excluir_cliente'])) {

    $id_cliente = ($_POST['id_cliente']);


    //inserir no banco.
    $sql = "DELETE FROM clientes WHERE id='$id_cliente'";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        echo "Falha ao deletar cliente!";
    } else {
        $_SESSION['cliente_deletado'] = true;
        header('Location:../view/alterar_cadastro.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível excluir cliente');</script>";
}

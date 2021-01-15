<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['alterar'])) {

    $id_servico = ($_POST['select_serv']);
    $valor = ($_POST['novo_preco']);

    //Formatando valor para decimal
    $valor_formatado = str_replace(',', '.', str_replace('.', '', $valor));

    //inserir no banco.
    $sql="UPDATE servicos SET valor ='$valor_formatado' WHERE id='$id_servico' ";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        echo "<script> alert('Não foi possível fazer a alteração');</script>";
    } else {
        $_SESSION['serv_alterado'] = true;
        header('Location:../view/alterar_servico.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}

<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['cadastrar'])) {

    $nome = ($_POST['nome_servico']);
    $valor = ($_POST['preco_servico']);
    $tipo = ($_POST['tipo_servico']);

    $valor_formatado = str_replace(',', '.', str_replace('.', '', $valor));

    //inserir no banco.
    $sql = "INSERT INTO servicos (nome,valor,tipo) VALUES ('$nome','$valor_formatado','$tipo')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (isset($resultado)) {
        $_SESSION['serv_cadastrado'] = true;
        header('Location:../view/cadastrar_servico.php');
        exit();
    } else {
        echo "<script> alert('Não foi possível fazer o cadastroa');</script>";
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}

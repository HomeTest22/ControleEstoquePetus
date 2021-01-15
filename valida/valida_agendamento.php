<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['agendar'])) {

    $cliente = ($_POST['select_cliente']);
    $dia = ($_POST['data_agendamento']);
    $hora=($_POST['horario_agendamento']);
    
    //inserir no banco.
    $sql = "INSERT INTO agendamentos (cod_cli,dia,hora,situacao) VALUES ('$cliente','$dia','$hora',0)";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (isset($resultado)) {
        $_SESSION['agendado'] = true;
        header('Location:../view/agendar.php');
        exit();
    } else {
        $_SESSION['nao_agendado'] = true;
        header('Location:../view/agendar.php');
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
    header('Location:../view/agendar.php');
}

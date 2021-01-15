<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['excluir_agendamento'])) {

    $id_agendamento = ($_POST['id_agendamento']);


    //inserir no banco.
    $sql = "DELETE FROM agendamentos WHERE id='$id_agendamento'";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        echo "Falha ao deletar agendamento!";
    } else {
        $_SESSION['agendamento_deletado'] = true;
        header('Location:../view/consulta_agenda.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível deletar o agendamento');</script>";
}

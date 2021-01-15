<?php
session_start();
ob_start();
require "../dao/conexao.php";

if (isset($_POST['lancar'])) {

    $cliente = ($_POST['select_cliente']);
    $servico = ($_POST['select_servicos']);
    $data_movimentacao = ($_POST['data_movimentacao']);
    $observacao = ($_POST['observacao']);

    //select valor
    $sql_valor="SELECT valor FROM servicos WHERE id='$servico'";
    $result_valor=mysqli_query($conexao,$sql_valor);
    $dados = mysqli_fetch_array($result_valor);
    $valor=$dados['valor'];
    

    //inserir no banco.
    $sql = "INSERT INTO movimentacoes (cliente,servico,valor,data_movimentacao,observacoes)
          VALUE ('$cliente','$servico','$valor','$data_movimentacao','$observacao')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        echo "Falha ao inserir dados!";
    } else {
        $_SESSION['lancado'] = true;
        header('Location:../view/lancar_servico.php');
        exit();
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}

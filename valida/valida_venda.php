<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['finalizar_venda'])) {

    $nome_prod= ($_POST['select_prod_venda']);
    $nome_cli= ($_POST['select_cliente_venda']);
    $pagamento = ($_POST['pagamento']);
    $condicao = ($_POST['condicao']);
    $quantidade= ($_POST['quantidade']);
    $data_venda=($_POST['data_venda']);
    

    //inserir no banco.
    $sql = "INSERT INTO vendas (produto,cliente,pagamento,condicao,quantidade,data_venda)
          VALUE ('$nome_prod','$nome_cli','$pagamento','$condicao','$quantidade','$data_venda')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (isset($resultado)){
        $_SESSION['venda_feita'] = true;
        header('Location:../view/painel.php');

    } else {
        $_SESSION['venda_nao_feita'] = true;
        header('Location:../view/painel.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer a venda');</script>";
}

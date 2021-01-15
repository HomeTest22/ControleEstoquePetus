<?php
ob_start();
session_start();
require "../dao/conexao.php";

$id_cliente = $_POST['id_cliente'];

$sql_cli = "SELECT * FROM clientes where id='$id_cliente'";
$result = mysqli_query($conexao, $sql_cli);
$dados = mysqli_fetch_array($result);


if (isset($_POST['alterar'])) {

    //verificando posts
    if (isset($_POST['novo_nome']) && ($_POST['novo_nome']) != "") {

        $novo_nome = ($_POST['novo_nome']);

        $sql = "UPDATE clientes SET nome='$novo_nome' WHERE id ='$id_cliente'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['cliente_alterado'] = true;
        }
    }

    if (isset($_POST['nova_identidade']) && ($_POST['nova_identidade']) != "") {

        $novo_cnpj = ($_POST['nova_identidade']);

        $sql = "UPDATE clientes SET identidade='$novo_cnpj' WHERE id ='$id_cliente'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['cliente_alterado'] = true;
        }
    }

    if (isset($_POST['novo_uf']) && ($_POST['novo_uf']) != "") {

        $novo_uf = ($_POST['novo_uf']);

        $sql = "UPDATE clientes SET uf='$novo_uf' WHERE id ='$id_cliente'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['cliente_alterado'] = true;
        }
    }


    if (isset($_POST['novo_tipo']) && ($_POST['novo_tipo']) != "") {

        $novo_tipo = ($_POST['novo_tipo']);

        $sql = "UPDATE clientes SET tipo='$novo_tipo' WHERE id ='$id_tipo'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['cliente_alterado'] = true;
        }
    }

    if (isset($_SESSION['cliente_alterado'])) {
        header('Location:../view/alterar_cliente.php');
    } else {
        $_SESSION['cliente_nao_alterado'] = true;
        header('Location:../view/alterar_cliente.php');
    }
} else {
    echo "<script> alert('Não foi possível fazer a alteração');</script>";
}

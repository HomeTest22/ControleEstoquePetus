<?php
ob_start();
session_start();
require "../dao/conexao.php";

$id_fornec = $_POST['id_fornec'];

$sql_prods = "SELECT * FROM fornecedores where id='$id_fornec'";
$result = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($result);


if (isset($_POST['alterar'])) {

    //verificando posts
    if (isset($_POST['novo_nome']) && ($_POST['novo_nome']) != "") {

        $novo_nome = ($_POST['novo_nome']);

        $sql = "UPDATE fornecedores SET nome='$novo_nome' WHERE id ='$id_fornec'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['fornec_alterado'] = true;
        }
    }

    if (isset($_POST['novo_cnpj']) && ($_POST['novo_cnpj']) != "") {

        $novo_cnpj = ($_POST['novo_cnpj']);

        $sql = "UPDATE fornecedores SET cnpj='$novo_cnpj' WHERE id ='$id_fornec'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['fornec_alterado'] = true;
        }
    }

    if (isset($_POST['novo_uf']) && ($_POST['novo_uf']) != "") {

        $novo_uf = ($_POST['novo_uf']);

        $sql = "UPDATE fornecedores SET uf='$novo_uf' WHERE id ='$id_fornec'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['fornec_alterado'] = true;
        }
    }


    if (isset($_POST['novo_estabelecimento']) && ($_POST['novo_estabelecimento']) != "") {

        $novo_estabelecimento = ($_POST['novo_estabelecimento']);

        $sql = "UPDATE fornecedores SET tipo_estabelecimento='$novo_estabelecimento' WHERE id ='$id_fornec'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['fornec_alterado'] = true;
        }
    }

    if (isset($_SESSION['fornec_alterado'])) {
        header('Location:../view/lista_fornecedores.php');
    } else {
        $_SESSION['fornec_nao_alterado'] = true;
        header('Location:../view/lista_fornecedores.php');
    }
} else {
    echo "<script> alert('Não foi possível fazer a alteração');</script>";
}

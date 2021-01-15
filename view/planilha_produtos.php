<?php
require "../dao/conexao.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Planilha Produtos</title>
</head>
<body>

<?php 
//Definir o nome da planilha
$arquivo='planilha_produtos.xlsx';

//Criando tabela HTML com o formato da planilha
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="5">Planilha Produtos</tr>';
$html .= '</tr>';


$html .= '<tr>';
$html .= '<td><b>Código</b></td>';
$html .= '<td><b>Descrição</b></td>';
$html .= '<td><b>Unidade</b></td>';
$html .= '<td><b>Tipo</b></td>';
$html .= '<td><b>Quantidade</b></td>';
$html .= '<td><b>Data Cadastro</b></td>';
$html .= '<td><b>Valor unitário</b></td>';
$html .= '<td><b>Valor em estoque</b></td>';
$html .= '</tr>';

//Selecionar os itens da tabela
$sql = "SELECT * FROM produto ORDER BY codigo";
$result = mysqli_query($conexao, $sql);

while($row_dados = mysqli_fetch_assoc($result)){
    $html .= '<tr>';
    $html .= '<td>'.$row_dados["codigo"].'</td>';
    $html .= '<td>'.$row_dados["descricao"].'</td>';
    $html .= '<td>'.$row_dados["unidade"].'</td>';
    $html .= '<td>'.$row_dados["tipo"].'</td>';
    $html .= '<td>'.$row_dados["quantidade"].'</td>';
    $html .= '<td>'.$row_dados["data_cadastro"].'</td>';
    $html .= '<td>'.$row_dados["valor_unidade"].'</td>';
    $html .= '<td>'.$row_dados["valor_estoque"].'</td>';
    $html .= '</tr>';
    ;
}
// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
// Envia o conteúdo do arquivo
echo $html;
exit;

?>    
</body>
</html>
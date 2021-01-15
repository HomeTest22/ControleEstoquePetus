<?php
require "../dao/conexao.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Planilha Fornecedores</title>
</head>
<body>

<?php 
//Definir o nome da planilha
$arquivo='planilha_fornecedores.xlsx';

//Criando tabela HTML com o formato da planilha
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="5">Planilha Fornecedores</tr>';
$html .= '</tr>';


$html .= '<tr>';
$html .= '<td><b>Id</b></td>';
$html .= '<td><b>Razão Social</b></td>';
$html .= '<td><b>CNPJ</b></td>';
$html .= '<td><b>UF</b></td>';
$html .= '<td><b>Tipo de estabelecimento</b></td>';
$html .= '</tr>';

//Selecionar os itens da tabela
$sql = "SELECT * FROM fornecedores ORDER BY codigo";
$result = mysqli_query($conexao, $sql);

while($row_dados = mysqli_fetch_assoc($result)){
    $html .= '<tr>';
    $html .= '<td>'.$row_dados["id"].'</td>';
    $html .= '<td>'.$row_dados["nome"].'</td>';
    $html .= '<td>'.$row_dados["cnpj"].'</td>';
    $html .= '<td>'.$row_dados["uf"].'</td>';
    $html .= '<td>'.$row_dados["tipo_estabelecimento"].'</td>';
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
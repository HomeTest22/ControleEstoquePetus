<?php
require "../dao/conexao.php";
require "../pdf/mpdf.php";

$sql_pdf_prod = "SELECT p.codigo,p.descricao,p.tipo,p.unidade,p.data_cadastro,p.quantidade,p.fornecedor,p.valor_unidade,
f.nome,f.id
FROM produto AS p
INNER JOIN fornecedores as f
ON p.fornecedor=f.id";
$result_pdf_prod = mysqli_query($conexao, $sql_pdf_prod);



$pagina =
	"<html>
			<body>
				<table>
					<thead>
					<tr>
						<th>Id</th>
						<th>Descrição</th>
						<th>Tipo</th>
						<th>Fornecedor</th>
						<th>Unidade</th>
						<th>Valor unitário</th>
					</tr>
					</thead>
					<tbody>
					<?php while ($dados_pdf_prod =  mysqli_fecth_array($result_pdf_prod)) {?>
						<tr>
						<td> " . $dados_pdf_prod['codigo'] . "</td>
						<td> " . $dados_pdf_prod['descricao'] . "</td>
						<td> " . $dados_pdf_prod['tipo'] . "</td>
						<td> " . $dados_pdf_prod['nome'] . "</td>
						<td> " . $dados_pdf_prod['unidade'] . "</td>
						<td> " . "R$" . $dados_pdf_prod['valor_unidade'] . "</td>
						</tr>
					<?php
					}
					?>
					</tbody>
				</table>
			</body>
		</html>
		";

$arquivo = "Cadastro01.pdf";

$mpdf = new mPDF();
$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário

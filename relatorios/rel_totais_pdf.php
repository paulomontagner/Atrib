<?php
require_once('../estrutura/base.php');
$sql = "SELECT a.nome AS tipo, 
sum(CASE c.tipo WHEN 1 THEN 1 ELSE 0 END) AS '1',
sum(CASE c.tipo WHEN 2 THEN 1 ELSE 0 END) AS '2',
sum(CASE c.tipo WHEN 3 THEN 1 ELSE 0 END) AS '3',
sum(CASE c.tipo WHEN 4 THEN 1 ELSE 0 END) AS '4',
sum(CASE c.tipo WHEN 5 THEN 1 ELSE 0 END) AS '5',
sum(CASE c.tipo WHEN 6 THEN 1 ELSE 0 END) AS '6',
sum(CASE c.tipo WHEN 7 THEN 1 ELSE 0 END) AS '7'
FROM classifica_professor c
LEFT JOIN agrupamento a ON c.painel = a.id
GROUP BY a.nome
WITH ROLLUP";
$cont = mysql_query($sql, $conexao);
$qcont = mysql_num_rows($cont);
$sql1 = "select l.nome,
count(case when p.horasdia = 4 and t.grupo <> 15 then t.id end) as '24horas',
count(case when p.horasdia = 5 and t.grupo <> 15 then t.id end) as '30horas',
count(case when p.horasdia = 5 and t.grupo = 15 then t.id end) as 'ef30horas'
from turmas t, locais l, periodo p
where t.periodo = p.id and t.local = l.id and t.status = 0
group by l.nome 
WITH ROLLUP
";
//echo $sql;
$escola = mysql_query($sql1, $conexao);
$qescola = mysql_num_rows($escola);
ob_start(); // Inicia o fluxo
?>
<!--Início do que deve ser impresso-->
<html>
<body style="font-family: serif; font-size: 7pt;">
<table width="100%">
			<tr>
              <th>Tipo</th>
			  <th>PEB I 24H CONCURSADOS</th>
			  <th>PEB I 24H ESTAVEIS</th>
			  <th>PEB I 30H CONCURSADOS</th>
			  <th>PEB I 24H CLT</th>
			  <th>PEB I ADJUNTO</th>
			  <th>PEB II DISCIPLINAS</th>
			  <th>PEB II EDUCA&Ccedil;&Atilde;O F&Iacute;SICA</th>
			</tr>
			<?php 
			for($i=0; $i<$qcont; $i++){
			?>
			<tr>
                <td align="left">
                <?php echo utf8_encode(mysql_result($cont, $i, 'tipo'));?>
				</td>
				<td align="center">
                <?php echo mysql_result($cont, $i, '1');?>
				</td>
				<td align="center">
                <?php echo mysql_result($cont, $i, '2');?>
				</td>
				<td align="center">
                <?php echo mysql_result($cont, $i, '3');?>
				</td>
				<td align="center">
                <?php echo mysql_result($cont, $i, '4');?>
				</td>
				<td align="center">
                <?php echo mysql_result($cont, $i, '5');?>
				</td>
				<td align="center">
                <?php echo mysql_result($cont, $i, '6');?>
				</td>
				<td align="center">
                <?php echo mysql_result($cont, $i, '7');?>
				</td>
			</tr>
			<?php } ?>
			<tr>
              <th colspan="5">Escola</th>
			  <th>24 Horas</th>
			  <th>30 Horas</th>
			  <th>Educa&ccedil;&atilde;o F&iacute;sica</th>
			</tr>
			<?php 
			for($i=0; $i<$qescola; $i++)
			{
			?>
			<tr>
                <td colspan="5" align="left">
                <?php echo utf8_encode(mysql_result($escola, $i, 'nome'));?>
				</td>
				<td align="right">
                <?php echo mysql_result($escola, $i, '24horas');?>
				</td>
				<td align="right">
                <?php echo mysql_result($escola, $i, '30horas');?>
				</td>
				<td align="right">
                <?php echo mysql_result($escola, $i, 'ef30horas');?>
				</td>
			</tr>
			<?php }  mysql_close($conexao);	?>	
	  </table>
      </body>
      </html>
<!--Fim do conteúdo a ser impresso-->
<?php
$html = ob_get_contents();
ob_end_clean(); // Finaliza o fluxo

define('MPDF_PATH', '../../mpdf50/');
include(MPDF_PATH.'mpdf.php');

$mpdf=new mPDF();
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='iso-8859-1';

$mpdf->SetDisplayMode('fullpage', 'two');
$mpdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Emitido pelo sistema de atribuição');

$mpdf->WriteHTML(utf8_decode($html));

$arquivo = date("ymdhis").'_relDP_turmas.pdf';

$mpdf->Output($arquivo,'I');
exit();
?>
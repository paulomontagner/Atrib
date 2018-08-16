<?php
require_once('../estrutura/base.php');
header("Content-type: text/html; charset=iso-8859-1");
		$local = $_REQUEST['local'];
		$result = mysql_query("SELECT t.id, l.nome, g.grupo, CONCAT('(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, m.nome as motivo,(select f.nome from funcionarios f where f.codmatricula = t.titular) as nome_titular, (select f.nome from funcionarios f where f.codmatricula = t.suplente) as nome_suplente,
CASE t.status WHEN 0 THEN 'Aberta' WHEN 1 THEN 'Fechada' end as status FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.local = ".$local." order by t.id;", $conexao);

	  	$total = mysql_num_rows($result);

ob_start(); // Inicia o fluxo

?>
<!--Início do que deve ser impresso-->
Resultados encontrados nesta busca: <?php echo $total; ?>
<table width="740" border="0" align="left">
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
    <td width="5%" align="left" bgcolor="#FFFFC0">C&oacute;digo</td>
    <td width="5%" align="left" bgcolor="#FFFFC0">Grupo </td>
    <td width="20%" align="left" bgcolor="#FFFFC0">Periodo</td>
    <td width="20%" align="left" bgcolor="#FFFFC0">HTPC</td>
    <td width="35%" align="left" bgcolor="#FFFFC0">Titular</td>
    <td width="10%" align="left" bgcolor="#FFFFC0">Motivo</td>
    <td width="5%" align="left" bgcolor="#FFFFC0">Situa&ccedil;&atilde;o</td>
  </tr>
  <?php for($i=0; $i<$total; $i++)
			{?>
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
    <td align="left"><?php echo mysql_result($result, $i, 'id');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'grupo');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'periodo');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'htpc');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'nome_titular');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'motivo');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'status');?></td>
  </tr>
  <?php }	?>
</table>
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
$mpdf->SetFooter('{DATE j/m/Y; H:i}|{PAGENO}/{nb}|REL DP / INTRANET');

$mpdf->WriteHTML($html);

$arquivo = date("ymdhis").'_relDP_turmas.pdf';

$mpdf->Output($arquivo,'I');
exit();
?>
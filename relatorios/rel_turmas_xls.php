<?php
require_once('../estrutura/base.php');
// Definimos o nome do arquivo que será exportado
$arquivo = 'relDP_turmas.xls';

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");//Data antiga para limpar o cache
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
		$local = $_REQUEST['local'];
		$result = mysql_query("SELECT t.id, l.nome, g.grupo, CONCAT('(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, m.nome as motivo,(select f.nome from funcionarios f where f.codmatricula = t.titular) as nome_titular, (select f.nome from funcionarios f where f.codmatricula = t.suplente) as nome_suplente,
CASE t.status WHEN 0 THEN 'Aberta' WHEN 1 THEN 'Fechada' end as status FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.local = ".$local." order by t.id;", $conexao);

	  	$total = mysql_num_rows($result);

?>
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
exit;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
				$tipo = $_REQUEST['tipo'];
		switch ($tipo) {
			case 1 : 
			$texto = "Turmas disponiveis para atribui&ccedil;&atilde;o";
			$and = " and t.status = 0";
			break;
		}
		$result = mysql_query("SELECT t.id, l.nome, g.grupo, CONCAT(p.nome,'(', p.entrada, '-', p.saida, ')(',p.grupo,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, m.nome as motivo, CASE t.titular WHEN 99999 THEN '' else (select f.nome from funcionarios f where f.codmatricula = t.titular) end as titular FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.mostra = 1".$and." order by l.nome;", $conexao);

	  	$total = mysql_num_rows($result);

?>
<?php echo $total." : ".$texto; ?>
<table width="740" border="0" align="left">
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
    <td width="5%" align="left" bgcolor="#FFFFC0">Turma</td>
    <td width="25%" align="left" bgcolor="#FFFFC0">Local</td>
    <td width="5%" align="left" bgcolor="#FFFFC0">Grupo</td>
    <td width="10%" align="left" bgcolor="#FFFFC0">Hor&aacute;rio</td>
    <td width="10%" align="left" bgcolor="#FFFFC0">HTPC</td>
    <td width="35%" align="left" bgcolor="#FFFFC0">Titular</td>
    <td width="10%" align="left" bgcolor="#FFFFC0">Descri&ccedil;&atilde;o</td>
  </tr>
  <?php for($i=0; $i<$total; $i++)
			{?>
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
    <td align="left"><?php echo mysql_result($result, $i, 'id');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'nome');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'grupo');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'periodo');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'htpc');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'titular');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'motivo');?></td>
  </tr>
  <?php }	?>
</table>
<!--Fim do conteúdo a ser impresso-->
<?php
exit;
?>
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
switch($_GET['tipo']){
case 1: 
$texto = "PEB I 24h concursados"; 
$and = "AND tipo = 1 "; 
break;
case 2: 
$texto = "PEB I 24h est&aacute;veis"; 
$and = "AND tipo = 2 ";
break;
case 3: 
$texto = "PEB I 30h concursados"; 
$and = "AND tipo = 3 ";
break;
case 4: 
$texto = "PEB I 24h CLT"; 
$and = "AND tipo = 4 ";
break;
case 5: 
$texto = "PEB I Adjunto"; 
$and = "AND tipo = 5 ";
break;
case 6: 
$texto = "PEB II Disciplinas"; 
$and = "AND tipo = 6 ";
break;
case 7: 
$texto = "PEB II Educa&ccedil;&atilde;o F&iacute;sica"; 
$and = "AND tipo = 7 ";
break;
}
	
		$result = mysql_query("SELECT c.Classifica, c.pontos, c.matricula, case c.tipo when 1 then 'PEB I 24h concursados' when 2 then 'PEB I 24h est&aacute;veis' when 3 then 'PEB I 30h concursados' when 4 then 'PEB I 24h CLT' when 5 then 'PEB I Adjunto' when 6 then 'PEB II Disciplinas' when 7 then 'PEB II Educa&ccedil;&atilde;o F&iacute;sica' end as tipo, f.nome FROM classifica_professor c, funcionarios f WHERE c.matricula = f.codmatricula and c.turma = 0 ".$and."order by pontos desc", $conexao);

	  	$total = mysql_num_rows($result);

?>
<?php echo $total." : ".$texto; ?>
<?php echo $total." : ".$texto; ?>
<table width="740" border="0" align="left">
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
    <td width="10%" align="left" bgcolor="#FFFFC0">Coloca&ccedil;&atilde;o</td>
    <td width="15%" align="left" bgcolor="#FFFFC0">Pontua&ccedil;&atilde;o</td>
    <td width="15%" align="left" bgcolor="#FFFFC0">Matr&iacute;cula</td>
    <td width="20%" align="left" bgcolor="#FFFFC0">Tipo</td>
    <td width="40%" align="left" bgcolor="#FFFFC0">Nome</td>
  </tr>
  <?php for($i=0; $i<$total; $i++)
			{?>
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
    <td align="left"><?php echo mysql_result($result, $i, 'Classifica');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'pontos');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'matricula');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'tipo');?></td>
    <td align="left"><?php echo mysql_result($result, $i, 'nome');?></td>
  </tr>
  <?php }	?>
</table>
<!--Fim do conteúdo a ser impresso-->
<?php
exit;
?>
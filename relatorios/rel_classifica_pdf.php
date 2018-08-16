<?php
require_once('../estrutura/base.php');
header("Content-type: text/html; charset=iso-8859-1");
$tipo = $_REQUEST['tipo'];
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
	
		$result = mysql_query("SELECT c.Classifica, c.pontos, c.matricula, case c.tipo when 1 then 'PEB I 24h concursados' when 2 then 'PEB I 24h est&aacute;veis' when 3 then 'PEB I 30h concursados' when 4 then 'PEB I 24h CLT' when 5 then 'PEB I Adjunto' when 6 then 'PEB II Disciplinas' when 7 then 'PEB II Educa&ccedil;&atilde;o F&iacute;sica' end as tipo, f.nome FROM classifica_professor c, funcionarios f WHERE c.matricula = f.codmatricula and c.turma = 0 ".$and."order by Classifica asc", $conexao);

	  	$total = mysql_num_rows($result);

ob_start(); // Inicia o fluxo

?>
<!--Início do que deve ser impresso-->
<?php echo $total." : ".$texto; ?>
<table width="740" border="0" align="left">
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:3px">
    <td width="10%" align="left" bgcolor="#FFFFC0">Coloca&ccedil;&atilde;o</td>
    <td width="15%" align="left" bgcolor="#FFFFC0">Pontua&ccedil;&atilde;o</td>
    <td width="15%" align="left" bgcolor="#FFFFC0">Matr&iacute;cula</td>
    <td width="20%" align="left" bgcolor="#FFFFC0">Tipo</td>
    <td width="40%" align="left" bgcolor="#FFFFC0">Nome</td>
  </tr>
  <?php for($i=0; $i<$total; $i++)
			{?>
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:3px">
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
$html = ob_get_contents();
ob_end_clean(); // Finaliza o fluxo

define('MPDF_PATH', '../../mpdf50/');
include(MPDF_PATH.'mpdf.php');

$mpdf=new mPDF();
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='iso-8859-1';

$mpdf->SetDisplayMode('fullpage', 'two');
$mpdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Emitido pelo sistema de atribuição');

$mpdf->WriteHTML($html);

$arquivo = date("ymdhis").'_relDP_classifica.pdf';

$mpdf->Output($arquivo,'I');
exit();
?>
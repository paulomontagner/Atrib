<?php
require_once('../estrutura/base.php');
// Definimos o nome do arquivo que será exportado
$arquivo = 'processo_seletivo.xls';

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");//Data antiga para limpar o cache
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
function converteMaiusculo($string)
{
$string = strtoupper ($string);
$string = str_replace ("â", "Â", $string);
$string = str_replace ("á", "Á", $string);
$string = str_replace ("ã", "Ã", $string);
$string = str_replace ("à", "A", $string);
$string = str_replace ("ê", "Ê", $string);
$string = str_replace ("é", "É", $string);
$string = str_replace ("Î", "I", $string);
$string = str_replace ("í", "Í", $string);
$string = str_replace ("ó", "Ó", $string);
$string = str_replace ("õ", "Õ", $string);
$string = str_replace ("ô", "Ô", $string);
$string = str_replace ("ú", "Ú", $string);
$string = str_replace ("Û", "U", $string);
$string = str_replace ("ç", "Ç", $string);
return $string;
}
function sn($opc){
switch ($opc) {
		case 0: //sn
		return "Não";
		break;
		case 1: //sn
		return "Sim";
		break;
		}
}
$tipo = ($_REQUEST['tipo'] == "") ? '' : " and opcao = ".$_REQUEST['tipo'];
$sit = ($_REQUEST['sit'] == "") ? '>=0' : "=".$_REQUEST['sit'];
$nome = ($_REQUEST['nome'] == "") ? '' : " and upper(nome) like upper('%".$_REQUEST['nome']."%')";
//$sql = "SELECT id, nome, rg, diploma, ponto_tempo, ponto_curso, ponto_pos, ponto_mestrado, ponto_doutorado, (diploma + ponto_tempo + ponto_curso + ponto_pos + ponto_mestrado + ponto_doutorado) as pontos FROM pseletivo where ativo ".$sit.$tipo.$nome." order by pontos desc";
$sql = "SELECT id, nome, rg, casamento, nascimento, diploma, ponto_tempo, ponto_curso, ponto_pos, ponto_mestrado, ponto_doutorado, (diploma + ponto_tempo + ponto_curso + ponto_pos + ponto_mestrado + ponto_doutorado) as pontos FROM pseletivo where ativo ".$sit.$tipo.$nome." order by pontos desc, casamento desc, nascimento desc";
//echo $sql;
$lista = mysql_query($sql, $conexao);
$qlista = mysql_num_rows($lista);
 ?>
<table width="740" border="0" align="left">
			<tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
              <td>Ordem</td>
			  <td>Nome</td>
			  <td>RG</td>
			  <td>Casamento</td>
			  <td>Filhos</td>
              <td>05.1.1</td>
			  <td>05.1.2</td>
			  <td>05.1.3</td>
			  <td>05.1.4</td>
			  <td>05.1.5</td>
			  <td>05.1.6</td>
			  <td>Pontos</td>
			 </tr>
  <?php for($i=0; $i<$qlista; $i++)
			{?>
  <tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">  			
            <td align="right"><?php echo $i+1; ?></td>    
            <td>
            <?php echo converteMaiusculo(mysql_result($lista, $i, 'nome'));?></td>
			<td>
            <?php echo converteMaiusculo(mysql_result($lista, $i, 'rg'));?></td>
			<td align="center">
			<?php echo utf8_decode(sn(mysql_result($lista, $i, 'casamento'))); ?> </td>
			<td align="right">
			<?php echo mysql_result($lista, $i, 'nascimento'); ?> </td>
			<td align="right">
            <?php echo number_format(mysql_result($lista, $i, 'ponto_tempo'), 2, ',', ' ');?></td>  
            <td align="right">
            <?php echo number_format(mysql_result($lista, $i, 'diploma'), 2, ',', ' ');?></td>  
            <td align="right">
            <?php echo number_format(mysql_result($lista, $i, 'ponto_curso'), 2, ',', ' ');?></td>  
            <td align="right">
            <?php echo number_format(mysql_result($lista, $i, 'ponto_pos'), 2, ',', ' ');?></td>  
            <td align="right">
            <?php echo number_format(mysql_result($lista, $i, 'ponto_mestrado'), 2, ',', ' ');?></td>
            <td align="right">
            <?php echo number_format(mysql_result($lista, $i, 'ponto_doutorado'), 2, ',', ' ');?></td>
            <td align="right">
            <?php echo number_format(mysql_result($lista, $i, 'pontos'), 2, ',', ' ');?></td>
  </tr>
  <?php }
echo $qlista." registros";  ?>
</table>
<!--Fim do conteúdo a ser impresso-->
<?php
exit;
?>
<?php
include_once("estrutura/base.php");
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
$sql = "SELECT id, nome, rg, casamento, nascimento, diploma, ponto_tempo, ponto_curso, ponto_pos, ponto_mestrado, ponto_doutorado, (diploma + ponto_tempo + ponto_curso + ponto_pos + ponto_mestrado + ponto_doutorado) as pontos, ativo FROM pseletivo where ativo ".$sit.$tipo.$nome." order by pontos desc, casamento desc, nascimento desc";
//echo $sql;
$lista = mysql_query($sql, $conexao);
$qlista = mysql_num_rows($lista);
?>	
<a href='relatorios/pseletivo_pdf.php?tipo=<?php echo $_REQUEST['tipo']; ?>&sit=<?php echo $_REQUEST['sit']; ?>&nome=<?php echo $_REQUEST['nome']; ?>' target='_blank'>Exportar para PDF<img src="imagens/pdf.gif" /></a>
<a href='relatorios/pseletivo_XLS.php?tipo=<?php echo $_REQUEST['tipo']; ?>&sit=<?php echo $_REQUEST['sit']; ?>&nome=<?php echo $_REQUEST['nome']; ?>' target='_blank'>Exportar para Excel<img src="imagens/xls.png" /></a>
<table width="100%" id="tb1">
			<tr>
              <th>Ordem</th>
			  <th>Nome</th>
			  <th>RG</th>
			  <th>Casamento</th>
			  <th>Filhos</th>
              <th>05.1.1</th>
			  <th>05.1.2</th>
			  <th>05.1.3</th>
			  <th>05.1.4</th>
			  <th>05.1.5</th>
			  <th>05.1.6</th>
			  <th>Pontuação</th>
			  <th>Edição</th>
			</tr>

			<?php 
			
			for($i=0; $i<$qlista; $i++)
			{?>
			<tr>
            <td align="right"><?php echo $i+1; ?></td>    
            <td>
            <?php echo converteMaiusculo(utf8_encode(mysql_result($lista, $i, 'nome')));?></td>
			<td>
            <?php echo converteMaiusculo(utf8_encode(mysql_result($lista, $i, 'rg')));?></td>
			<td align="center">
			<?php echo sn(mysql_result($lista, $i, 'casamento')); ?> </td>
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
			<td align="Left">
			<a href="edita_pseletivo.php?id=<?php echo mysql_result($lista, $i, 'id');?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>"}); return false;'><img src="imagens/edit.png" alt="Cadastro de candidato" /></a>
			<img src="imagens/img/<?php echo mysql_result($lista, $i, 'ativo'); ?>.png" />
			</td>
          	<?php } 
			mysql_close($conexao);	?>
	  </table>
<div id="subturma"></div>      	
<div id="pageNav"></div>
    <script>
        var pager = new Pager('tb1', 50); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNav'); 
        pager.showPage(1);
    </script>

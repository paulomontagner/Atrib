<?php
header("Content-type: text/html; charset=iso-8859-1");
include_once("../estrutura/base.php");
$tipo = $_REQUEST['tipo'];
$local = $_REQUEST['local'];
$status = $_REQUEST['status'];
$grupo = $_REQUEST['grupo'];
$sql = "SELECT t.id, l.nome, g.grupo, CONCAT(p.grupo,'-', p.nome, '(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, (select f.nome from funcionarios f where f.codmatricula = t.titular) as nome_titular, t.afastamento, m.nome as motivo_afast, t.suplente, (select f.nome from funcionarios f where f.codmatricula = t.suplente) as nome_suplente,(select f.nome from funcionarios f where f.codmatricula = t.2suplente) as nome_2suplente, s.nome as status, t.educ_fisica, (select sum(s.a)+sum(s.b)+sum(s.c)+sum(s.d)+sum(s.e) from subturmas s where s.turma = t.id) as aulas, (select sum(s.docencia)from subturmas s where s.turma = t.id) as docencia FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id".$local.$tipo.$status.$grupo." and t.mostra = 1 order by l.nome ;";
//echo $sql;
$turma = mysql_query($sql, $conexao);
$qturma = mysql_num_rows($turma);
ob_start(); // Inicia o fluxo
?>
<head>
<style>
#tb1
{
	/*width:300px;*/
	padding:3px;
}
tr.d0 td {
	background-color:#000;
	color:#FFF;
}
tr.d1 td {
	background-color:#09F;
	color:#000;
}
tr:nth-child(odd){
	background-color:#DFEEFF;
}

th
{
	padding:3px;
	font:bold 12px verdana;
	color:#333;
	background-color:#dde;
}

td
{
	padding:3px;
	font:11px verdana;
	color:#333;
	/*background-color:#f9f9f9;*/
}
</style>
</head>
<body>
<table width="100%" id="tb1">
			<tr>
              <th>C&oacute;digo</th>
			  <th>Turma</th>
			  <th>Atribui&ccedil;&atilde;o</th>
			  <th>Status</th>
			</tr>
			<?php 
			
			for($i=0; $i<$qturma; $i++)
			{?>
<?php
if ($i % 2) {
echo '<tr style="background-color: #DFEEFF;">';
} else {
echo "<tr>";
}
?>
                <td align="center">
                <?php echo utf8_encode(mysql_result($turma, $i, 'id'));?></td>
				<td align="left">
                  <b>Escola:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome'));?><br />
				  <b>Grupo:</b><?php echo utf8_encode(mysql_result($turma, $i, 'grupo'));?><br />
                  <b>Periodo:</b><?php echo utf8_encode(mysql_result($turma, $i, 'periodo'));?><br />
                  <b>HTPC:</b><?php echo utf8_encode(mysql_result($turma, $i, 'htpc'));?>
            </td>
				<td align="left">
					<b>Titular:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome_titular'));?><br />
                     <?php if (mysql_result($turma, $i, 'afastamento') > 0 ){?>
                     <b>Afastamento:</b><?php echo utf8_encode(mysql_result($turma, $i, 'motivo_afast'));?><br />
                     <b>1&deg;Suplente:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome_suplente'));?><br />
                     <b>2&deg;Suplente:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome_2suplente'));?><br />
					 <?php } ?>						
              </td>
				<td align="left">
					<b>Status:</b><?php echo utf8_encode(mysql_result($turma, $i, 'status'));?><br />
                    <b>Turmas:</b><?php echo utf8_encode(mysql_result($turma, $i, 'aulas'));?><br />
                    <b>horas doc&ecirc;ncia:</b><?php echo utf8_encode(mysql_result($turma, $i, 'docencia'));?>
		      </td>
			</tr>
			<?php }
			echo "<tr><td colspan='3'>Foram listadas $qturma turmas";
			 mysql_close($conexao);	?>
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

$mpdf->WriteHTML(utf8_decode($html));

$arquivo = date("ymdhis").'_relDP_classifica.pdf';

$mpdf->Output($arquivo,'I');
exit();
?>
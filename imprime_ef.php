<?php
include_once("estrutura/base.php");
$titular = mysql_query("SELECT t.id, l.nome, g.grupo,  CONCAT(p.grupo,'-', p.nome, '(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, t.afastamento, m.nome as motivo, t.suplente, (select l.nome from locais l where l.id = t.local_htpc) as nome_htpc, t.hora_atrib FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.titular = ". $_GET['matricula'].";", $conexao);
$qtitular = mysql_num_rows($titular);
$linha1 = mysql_fetch_assoc($titular);
$suplente = mysql_query("SELECT t.id, l.nome, g.grupo, CONCAT(p.grupo,'-', p.nome, '(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, t.afastamento, m.nome as motivo, t.suplente FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.suplente = ". $_GET['matricula'].";", $conexao);
$qsuplente = mysql_num_rows($suplente);
$linha2 = mysql_fetch_assoc($suplente);
$professor = mysql_query("SELECT c.*, f.nome from classifica_professor c, funcionarios f where c.matricula = f.codmatricula and c.id = ". $_GET['id']." order by f.nome", $conexao);
$qprofessor = mysql_num_rows($professor);
$linha = mysql_fetch_assoc($professor);
$id_docente = $_GET['id'];
$cabec = '<html>
<head>
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/paging_rel.css">
</head>
<body>';
$recibo = '
    <h2 align="center">
        SECRETARIA MUNICIPAL DE EDUCA&Ccedil;&Atilde;O DE SUZANO
  </h2>
    <h3 align="center">
        ENCAMINHAMENTO DE FUNCION&Aacute;RIO &Agrave; UNIDADE ESCOLAR
    </h3>
<table width="100%">	
<tr>
  <th>Matricula</th>
  <th>Nome</th>
  <th>Classifica&ccedil;&atilde;o</th>
  <th>Pontos</th>
</tr>';
if($qprofessor > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
$matricula = $linha['matricula'];	
$recibo .= "<tr><td align='center'>".$matricula."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha['nome'])."</td>";
$recibo .= "<td align='center'>".$linha['Classifica']."&ordm;</td>";
$recibo .= "<td align='center'>".$linha['pontos']."</td><tr>";
// finaliza o loop que vai mostrar os dados
		}while($linha = mysql_fetch_assoc($professor));
	// fim do if 
	}
$recibo .= '</table>
<table width="100%">
<tr>
  <th>Turma</th>
  <th>Escola</th>
  <th>Grupo</th>
  <th>Periodo</th>
  <th>HTPC</th>
  <th>Atribui&ccedil;&atilde;o</th>
</tr>'; 
if($qtitular > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
$recibo .= "<tr><td align='center'>".utf8_encode($linha1['id'])."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha1['nome'])."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha1['grupo'])."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha1['periodo'])."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha1['htpc'])."</td>";
$recibo .= "<td align='center'>". date('d/m/Y H:i', strtotime($linha1['hora_atrib']))."</td>";
$hora_atrib = $linha1['hora_atrib'];
$detalhe = mysql_query("SELECT s.*, l.nome, CONCAT(p.entrada, ' - ', p.saida) as nome_periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as nome_htpc
FROM subturmas s, locais l, periodo p, htpc h
WHERE s.local = l.id and s.periodo = p.id and s.htpc = h.id and turma = ".$linha1['id'].";", $conexao);
$qdetalhe = mysql_num_rows($detalhe);
$linha3 = mysql_fetch_assoc($detalhe);
if($qdetalhe > 0) { 
$recibo .='<tr>
<td colspan="6">
<table width="100%">
<tr>
<th width="20%">Local</th>
<th width="20%">Periodo</th>
<th width="10%">1&ordm; ano</th>
<th width="10%">2&ordm; ano</th>
<th width="10%">3&ordm; ano</th>
<th width="10%">4&ordm; ano</th>
<th width="10%">5&ordm; ano</th>
<th width="10%">Doc&ecirc;ncia</th>
</tr>';
do {
$recibo .= "<tr><td>".utf8_encode($linha3['nome']);
$recibo .= "</td><td align='center'>".$linha3['nome_periodo']."</td>";
$recibo .= "<td align='center'>".$linha3['a']."</td>";
$recibo .= "<td align='center'>".$linha3['b']."</td>";
$recibo .= "<td align='center'>".$linha3['c']."</td>";
$recibo .= "<td align='center'>".$linha3['d']."</td>";
$recibo .= "<td align='center'>".$linha3['e']."</td>";
$recibo .= "<td align='center'>".$linha3['docencia']."</td>";
//$recibo .= "<td align='center'>".$linha3['nome_htpc'];
$recibo .= "</td><tr>";
	}while($linha3 = mysql_fetch_assoc($detalhe));
$recibo .= "</table></td></tr>";	
	// fim do if 
	}

// finaliza o loop que vai mostrar os dados
		}while($linha1 = mysql_fetch_assoc($titular));
	// fim do if 
	} else { ?>
<?php } ?>
<?php
if($qsuplente > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
$recibo .= "<tr><td align='center'>".utf8_encode($linha2['id'])."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha2['nome'])."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha2['grupo'])."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha2['periodo'])."</td>";
$recibo .= "<td align='center'>".utf8_encode($linha2['htpc'])."</td>";
$recibo .= "<td align='center'>Suplente</td><tr>";
// finaliza o loop que vai mostrar os dados
		}while($linha1 = mysql_fetch_assoc($suplente));
	// fim do if 
	} 

mysql_close($conexao);
$recibo .= '</table>
   <p align="center"><font size="1">
      O Servidor acima, ao fazer a escolha, declara estar ciente do hor&aacute;rio de HTPC a ser cumprido na nova unidade escolar.</font>
    </p>
    <p align="center"><font size="1">
        Este documento dever&aacute; ser apresentado na nova Unidade Escolar no primeiro dia &uacute;til ap&oacute;s a atribui&ccedil;&atilde;o.</font>
    </p>
<table width="100%">
<tr>
<td width="50%"><hr align="center" width="200"></td>
<td width="50%"><hr align="center" width="200"></td>
</tr>
<tr>
<td width="50%" align="center">Assinatura do servidor</td>
<td width="50%" align="center">Funcion&aacute;rio RH</td>
</tr>
<tr><td colspan="2" style="border-top:solid;" align="right"><font size="-1">S&eacute;rie/Grupo atribuido em '. date("d/m/Y H:i", strtotime($hora_atrib)).'</font></td></tr></table>';
$fim = '<body></html>';
$html = $cabec.$recibo.$recibo.$fim;
//echo $html;
define('MPDF_PATH', 'mpdf/');
include(MPDF_PATH.'mpdf.php');
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
exit();
?>
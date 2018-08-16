<?php 
header("Content-Type: text/html; charset=UTF-8",true); 
if (empty($_POST['ordem'])){
$ordem = 'id'; } else {	
$ordem = $_POST['ordem'];}
include_once("estrutura/base.php");
$sql = "SELECT t.id, l.nome, g.grupo, CONCAT('(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, t.afastamento, m.nome as motivo, t.suplente, t.status, l.dificil FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.status < 2 and t.mostra = 1 order by ".$ordem.";";
//echo $sql;
//$sql = "SELECT t.id, l.nome, g.grupo, CONCAT('(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, t.afastamento, m.nome as motivo, t.suplente FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.mostra = 1 order by ".$ordem.";";
$turmas = mysql_query($sql, $conexao);
$qturmas = mysql_num_rows($turmas);
$linha1 = mysql_fetch_assoc($turmas);
?>	
    <html>
    <head>
    <title>Mostrando vagas</title>
    <link rel="stylesheet" href="css/paging.css">
    </head>
     
    <body onLoad="Rolar()">
<table width="100%" border="1">
<tr>
  <th>Turma</th>
  <th>Escola</th>
  <th>Grupo</th>
  <th>Periodo</th>
  <th>HTPC</th>
  <th>Atribui&ccedil;&atilde;o</th>
</tr>    
<?php
if($qturmas > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
if ($linha1['status'] == 1){
	echo '<tr class="d0">'; $sala = "Turma encerrada"; } else {	
if ($linha1['titular'] == '99999') {
	echo "<tr>"; $sala = "Turma livre"; } else { echo '<tr class="d1">'; $sala = "Turma em substitui&ccedil;&atilde;o";} }
echo "<td align='center'>".utf8_encode($linha1['id']);
if ($linha1['dificil'] == 1){ echo "<img src='imagens/img/Red tag.png' />"; } else { echo "<img src='imagens/img/Green tag.png' />"; }
echo "</td>";	
echo "<td align='center'>".utf8_encode($linha1['nome']);
echo "</td><td align='center'>".utf8_encode($linha1['grupo'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['periodo'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['htpc'])."</td>";
if ($linha1['titular'] == '99999'){?>
<td align='center'><?php echo $sala; ?></td>
</tr>
<?php 
$detalhe = mysql_query("SELECT s.*, l.nome, l.dificil, CONCAT(p.entrada, ' - ', p.saida) as nome_periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as nome_htpc
FROM subturmas s, locais l, periodo p, htpc h
WHERE s.local = l.id and s.periodo = p.id and s.htpc = h.id and turma = ".$linha1['id'].";", $conexao);
$qdetalhe = mysql_num_rows($detalhe);
$linha3 = mysql_fetch_assoc($detalhe);
if($qdetalhe > 0) { ?>
<tr>
<td colspan="9">
<table width="100%">
<tr>
<th>Local</th>
<th>Periodo</th>
<th>1&ordm; ano</th>
<th>2&ordm; ano</th>
<th>3&ordm; ano</th>
<th>4&ordm; ano</th>
<th>5&ordm; ano</th>
<th>Doc&ecirc;ncia</th>
<th>HTPC</th>
</tr>
<?php		
do {
echo "<tr><td>";
if ($linha3['dificil'] == 1) { echo "<img src='imagens/img/Alert.png' alt='Dificil Lota&ccedil;&atilde;o'>";}
echo utf8_encode($linha3['nome']);
echo "</td><td align='center'>".$linha3['nome_periodo']."</td>";
echo "<td align='center'>".$linha3['a']."</td>";
echo "<td align='center'>".$linha3['b']."</td>";
echo "<td align='center'>".$linha3['c']."</td>";
echo "<td align='center'>".$linha3['d']."</td>";
echo "<td align='center'>".$linha3['e']."</td>";
echo "<td align='center'>".$linha3['docencia']."</td>";
echo "<td align='center'>".$linha3['nome_htpc'];?>
<?php echo "</td><tr>";
	}while($linha3 = mysql_fetch_assoc($detalhe));
echo "</table></td></tr>";	
	// fim do if 
	}
} else { 
echo "<td align='center'>$sala</td>";
 } ?>
</tr>
<?php 
// finaliza o loop que vai mostrar os dados
		}while($linha1 = mysql_fetch_assoc($turmas));
	// fim do if 
	} else { ?>
		<tr><td colspan="6" align="center">Sem turmas para mostrar</td></tr>
<?php } 
mysql_close($conexao);	 ?>
</table>
</div>
<form method="post">
<select id="ordem" name="ordem" >
<option value="id">C&oacute;digo</option>
<option value="nome">Nome da escola</option>
<option value="grupo">Grupo</option>
<option value="periodo">Periodo</option>
<option value="htpc">HTPC</option>
<option value="t.afastamento">Motivos</option>
</select>
<button type="submit" value="Ordenar">
</form>    
    </body>
    </html>
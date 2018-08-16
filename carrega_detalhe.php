<?php
include_once("estrutura/base.php");
switch ($_GET['tipo']){
case 0: $sql = 'SELECT * FROM locais where id = '.$_GET['detalhe'].' ORDER BY nome;';
	$result = mysql_query($sql, $conexao);
	while ($dados = mysql_fetch_assoc($result)) {
	echo utf8_decode('<div class="idea"><strong>Endere&ccedil;o:</strong>'.$dados['endereco'].', '.$dados['numero'].' - '.$dados['bairro'].' Telefone : '. $dados['telefone'].' Regi&atilde;o: '.$dados['regiao'].' </strong></div>'); }
break;
case 1: $detalhe = mysql_query("SELECT s.*, l.nome, CONCAT(p.entrada, ' - ', p.saida) as nome_periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as nome_htpc
FROM subturmas s, locais l, periodo p, htpc h
WHERE s.local = l.id and s.periodo = p.id and s.htpc = h.id and turma = ".$_GET['detalhe'].";", $conexao);
$qdetalhe = mysql_num_rows($detalhe);
$linha3 = mysql_fetch_assoc($detalhe);
if($qdetalhe > 0) { ?>
<div class="info">
<table width="100%">
<tr><th colspan="9">Mostrando detalhes da turma <?php echo $_GET['detalhe'];?></th></tr>
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
echo "<tr><td>".$linha3['nome'];
echo "</td><td align='center'>".$linha3['nome_periodo']."</td>";
echo "<td align='center'>".$linha3['a']."</td>";
echo "<td align='center'>".$linha3['b']."</td>";
echo "<td align='center'>".$linha3['c']."</td>";
echo "<td align='center'>".$linha3['d']."</td>";
echo "<td align='center'>".$linha3['e']."</td>";
echo "<td align='center'>".$linha3['docencia']."</td>";
echo "<td align='center'>".$linha3['nome_htpc'];
echo "</td><tr>";
	}while($linha3 = mysql_fetch_assoc($detalhe));
echo '</table></div>';	
	// fim do if 
} else {
echo '<div class="info">N&atilde;o h&aacute; subturmas cadastradas</div>';	
}
break;
}
mysql_close($conexao);
?>

			  
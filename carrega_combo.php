<?php
include_once("estrutura/base.php");
switch ($_GET['campo']){
case "t.local": $sql = 'SELECT id, nome FROM locais ORDER BY nome;';
break;
case "t.grupo": $sql = "SELECT id, concat(grupo, ' - ', modalidade) as nome FROM grupos;";
break;
case "t.periodo": $sql = "select id, CONCAT(grupo,'-', nome, '(', entrada, '-', saida, ')(',horasdia,' horas)') as nome from periodo ;";
break;
case "t.htpc": $sql = "SELECT id, concat(dia, ' (', inicio, '-', fim, ')') as nome from htpc;";
break;
case "t.afastamento": $sql = 'SELECT id, nome from motivos;';
break;
}
$result = mysql_query($sql, $conexao);
$qresult = mysql_num_rows($result);
$linha = mysql_fetch_assoc($result);
if($qresult > 0) {
do {
echo '<option value="'.$linha['id'].'">'.utf8_encode($linha['nome']).'</option>';
		}while($linha = mysql_fetch_assoc($result));
	// fim do if 
	}
mysql_close($conexao);
?>

			  
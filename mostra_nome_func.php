<?php
include_once("estrutura/base.php");
if ($_GET['id'] == 0) {
	echo 'Em aberto';
} else {
$edresult = mysql_query("SELECT nome FROM funcionarios WHERE codmatricula = ".$_GET['id'].";", $conexao);
echo utf8_encode(mysql_result($edresult, 0, nome));
}
?>
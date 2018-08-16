<?php 
$i = 0;
include_once("../estrutura/base.php");
$SQL = "SELECT c.id, c.matricula, f.nome FROM classifica_professor c, funcionarios f WHERE c.matricula = f.codmatricula and painel = 1 order by c.classifica limit 0, 1";
$result = mysql_query($SQL, $conexao);
while ($row = mysql_fetch_object($result)) {
$id = $row->id;
echo $row->matricula."|8|".$row->nome;
$i++;
}
if ($i > 0) {
$SQL1 = "update classifica_professor set painel = 2 where id = ".$id;
$result1 = mysql_query($SQL1, $conexao);
}
mysql_close($conexao);
?>
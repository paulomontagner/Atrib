<?php
include_once("estrutura/base.php");
switch ($_GET['tipo']) {
case 0:
$sql = "select f.id as funcionario, l.codigo as local, p.id as turno, p.entrada as entrada, p.saida as saida, g.grupo as grupo, g.modalidade as modalidade from funcionarios f, turmas t, locais l, periodo p, grupos g where f.codmatricula = t.titular and l.id = t.local and p.id = t.periodo and g.id = t.grupo and t.titular <> 99999";
$func = "Titular";
break;
case 1:
$sql = "select f.id as funcionario, l.codigo as local, p.id as turno, p.entrada as entrada, p.saida as saida, g.grupo as grupo, g.modalidade as modalidade from funcionarios f, turmas t, locais l, periodo p, grupos g where f.codmatricula = t.suplente and l.id = t.local and p.id = t.periodo and g.id = t.grupo and t.suplente <> 99999";
$func = "1&ordm; suplente";
break;
case 2:
$sql = "select f.id as funcionario, l.codigo as local, p.id as turno, p.entrada as entrada, p.saida as saida, g.grupo as grupo, g.modalidade as modalidade from funcionarios f, turmas t, locais l, periodo p, grupos g where f.codmatricula = t.2suplente and l.id = t.local and p.id = t.periodo and g.id = t.grupo and t.2suplente <> 99999";
$func = "2&ordm; suplente";
break;
}
$result = mysql_query($sql, $conexao);
while($linha = mysql_fetch_assoc($result)){
$query = mysql_query("insert into atribuicoes (ano, funcionario, local, turno, entrada, saida, inicio, grupo, modalidade, funcao) values(2015,".$linha['funcionario'].",".$linha['local'].",".$linha['turno'].",'".$linha['entrada']."','".$linha['saida']."','2015-02-02','".$linha['grupo']."','".$linha['modalidade']."','".$func."');");
}
echo "Terminado";
mysql_close($conexao); 
?>
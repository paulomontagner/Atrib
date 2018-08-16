<?php
include_once("estrutura/base.php");
$tipo = $_REQUEST['oper'];
switch ($tipo){
case 0 : // remove professor da lista de classificação tipo_atrib 0 - titular, 1 - suplente 2 - 2º suplente e 3 - readaptado
$sql = "update classifica_professor set turma = -1, tipo_atrib = 3 where id = ".$_REQUEST['id'].";";
$ende = "<script>carrega('http://10.0.0.163/atrib/classifica_docente.php?tipo=', ".$_REQUEST['tipo'].", 'conteudo')</script>";
break;
}
$result = mysql_query($sql, $conexao);
if ($sql1 <> ''){
$result1 = mysql_query($sql1, $conexao);}
if($result) echo $ende;
	else echo '<script>alert("Erro no cadastro. Tente novamente.")</script>';
mysql_close($conexao); 
?>

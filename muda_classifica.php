<?php
include_once("estrutura/base.php");
$tipo = $_GET['tipo'];
$turma = $_GET['turma'];
$docente = $_GET['docente'];
$id_docente = $_GET['id_docente'];
switch ($tipo){
case 0 : // atribuição titular
$sql = "update turmas set titular = ".$docente.", status = 1, afastamento = 1, hora_atrib = current_timestamp where id = ".$turma.";";
$sql1 = "update classifica_professor set turma = ".$turma.", tipo_atrib = ".$tipo." where id = ".$id_docente.";";
break;
case 1 : //atribuição suplente
$sql = "update turmas set suplente = ".$docente.", status = 1, hora_atrib = current_timestamp where id = ".$turma.";";
$sql1 = "update classifica_professor set turma = ".$turma.", tipo_atrib = ".$tipo." where id = ".$id_docente.";";
break;
case 2 : //cancela atribuição titular
$sql = "update turmas set titular = 99999, afastamento = 0, status = 0, hora_atrib = current_timestamp where id = ".$turma.";";
$sql1 = "update classifica_professor set turma = 0, tipo_atrib = 0 where id = ".$id_docente.";";
break;
case 3 : //cancela atribuição suplencia
$sql = "update turmas set suplente = 99999, status = 0 where id = ".$turma.";";
$sql1 = "update classifica_professor set turma = 0, tipo_atrib = 0 where id = ".$id_docente.";";
break;
case 4 : // altera o local da sede da turma
$sql = "update turmas set local = ".$_GET['local']." where id = ".$turma.";";
$sql1 = "update turmas set local = ".$_GET['local']." where id = ".$turma.";";
break;
case 5 : //altera o htph onde houver a opção na subturma
$sql = "update turmas set local_htpc = ".$_GET['local'].", htpc = ".$_GET['htpc']." where id = ".$turma.";";
$sql1 = "update turmas set local_htpc = ".$_GET['local'].", htpc = ".$_GET['htpc']." where id = ".$turma.";";
break;
}
$result = mysql_query($sql, $conexao);
$result1 = mysql_query($sql1, $conexao);
if($result) echo "<script>carrega('atribui_docente1.php?id=".$id_docente."&matricula=', $docente, 'conteudo')</script>";
else echo '<script>alert("Erro no cadastro. Tente novamente.")</script>';
mysql_close($conexao); 
?>

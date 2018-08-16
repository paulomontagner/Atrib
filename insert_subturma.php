<?php
	include_once("estrutura/base.php");
	$opera = $_POST['opera'];
	$local = $_POST['local'];
	$id = $_POST['id'];
	$periodo = $_POST['periodo'];
	$htpc = $_POST['htpc'];
	$turma = $_POST['turma'];
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$d = $_POST['d'];
	$e = $_POST['e'];
	$docencia = $_POST['docencia'];
	if (empty($opera)){
		$opera = $_GET['opera'];
		$id = $_GET['id'];
	}
	
	switch ($opera){
      case 0:
       $sql0 = "INSERT INTO subturmas (local, turma, periodo, a, b, c, d, e, docencia, mostra, htpc) values (".$local.",".$turma.",".$periodo.",".$a.",".$b.",".$c.",".$d.",".$e.",".$docencia.",1,".$htpc.");";
		$result = mysql_query($sql0, $conexao);
		//echo $sql0;
      break;
	  case 1:
	    $sql = "UPDATE subturmas SET local = ".$local.", turma = ".$turma.", periodo = ".$periodo.", a = ".$a.", b = ".$b.", c = ".$c.",d = ".$d.",e = ".$e.", docencia = ".$docencia.", htpc = ".$htpc." WHERE id = ".$id.";";
		$result = mysql_query($sql, $conexao);
	  break;
	  case 2:
	  $sql2 = "UPDATE subturmas SET mostra = 0 WHERE id = ".$id.";";
      $result = mysql_query($sql2, $conexao);
		}
	if($result) echo "<script>carrega('carrega_lista_atrib.php?id=', $local, 'resultado')</script>";
	else echo '<script>alert("Erro no cadastro. Tente novamente.")</script>';	
?>
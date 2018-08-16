<?php
	include_once("estrutura/base.php");
	$opera = $_POST['opera'];
	$local = $_POST['local'];
	$grupo = $_POST['grupo'];
	$id = $_POST['id'];
	$periodo = $_POST['periodo'];
	$htpc = $_POST['htpc'];
	$titular = $_POST['titular'];
	$motivos = $_POST['motivos'];
	$suplente = $_POST['suplente'];
	$status = $_POST['status'];
	$sub = $_POST['sub'];
	if (empty($opera)){
		$opera = $_GET['opera'];
		$id = $_GET['id'];
	}
	if (empty($titular)){$titular = '99999';}
	if (empty($suplente)){$suplente = '99999';}

	
	switch ($opera){
      case 0:
       	$sql0 = "INSERT INTO turmas (local, grupo, periodo, htpc,titular, afastamento, suplente, status, mostra, educ_fisica, local_htpc, 2suplente) VALUES (".$local.", ".$grupo.", ".$periodo.", ".$htpc.", ".$titular.", ".$motivos.", ".$suplente.", ".$status.",1,".$sub.",".$local.",99999);";		
		$result = mysql_query($sql0, $conexao);
		$turma0 = mysql_query("SELECT id FROM turmas WHERE id = LAST_INSERT_ID();");
		$row = mysql_fetch_array($turma0);
		if($titular <> '99999'){
		$sql01 = "update classifica_professor set turma = ".$row[0]." where matricula = ".$titular.";";
		$result = mysql_query($sql01, $conexao);	
		}
      break;
	  case 1:
	    $sql = "UPDATE turmas SET local = ".$local.", grupo = ".$grupo.", periodo = ".$periodo.", htpc = ".$htpc.", titular = ".$titular.", afastamento = ".$motivos.", suplente = ".$suplente.", educ_fisica = ".$sub.",  status = ".$status."  WHERE id = ".$id.";";	    
		$result = mysql_query($sql, $conexao);
        if($titular <> '99999'){
		$sql01 = "update classifica_professor set turma = ".$id." where matricula = ".$titular.";";
		$result = mysql_query($sql01, $conexao);
		}
	  break;
	  case 2:
	  $sql2 = "UPDATE turmas SET mostra = 0 WHERE id = ".$id.";";
      $result = mysql_query($sql2, $conexao);
		}
	if($result) echo "<script>carrega('carrega_lista_atrib.php?id=', $local, 'resultado')</script>";
	else echo '<script>alert("Erro no cadastro. Tente novamente.")</script>';	
?>
<?php
	include_once("estrutura/base.php");
	function converteMaiusculo($string)
	{
	$string = strtoupper ($string);
	$string = str_replace ("â", "Â", $string);
	$string = str_replace ("á", "Á", $string);
	$string = str_replace ("ã", "Ã", $string);
	$string = str_replace ("à", "A", $string);
	$string = str_replace ("ê", "Ê", $string);
	$string = str_replace ("é", "É", $string);
	$string = str_replace ("Î", "I", $string);
	$string = str_replace ("í", "Í", $string);
	$string = str_replace ("ó", "Ó", $string);
	$string = str_replace ("õ", "Õ", $string);
	$string = str_replace ("ô", "Ô", $string);
	$string = str_replace ("ú", "Ú", $string);
	$string = str_replace ("Û", "U", $string);
	$string = str_replace ("ç", "Ç", $string);
	return $string;
	} 
	function calcula($valor, $ponto, $maximo){
	  $sum = 0;
	  $sum = $valor * $ponto;
	  if ($sum > $maximo) {
		  return $maximo;
	  } else {
	  return $sum;
	  }
	}	
$opcao = $_REQUEST['opcao'];
$nome = converteMaiusculo(utf8_decode($_REQUEST['nome']));
$rg = $_REQUEST['rg'];
$cpf = $_REQUEST['cpf'];
$titulo = $_REQUEST['titulo'];
$sexo = $_REQUEST['sexo'];
$reservista = $_REQUEST['reservista'];
$casamento = $_REQUEST['casamento'];
$nascimento = $_REQUEST['nascimento'];
$residencia = $_REQUEST['residencia'];
$diploma = $_REQUEST['diploma'];
$historico = $_REQUEST['historico'];
$tempo = $_REQUEST['tempo'];
$ponto_tempo = calcula($tempo, 0.01, 10);
$cursos = $_REQUEST['cursos'];
$ponto_curso = calcula($cursos, 0.2, 2);
$pos = $_REQUEST['pos'];
$ponto_pos = calcula($pos, 1, 5);
$mestrado = $_REQUEST['mestrado'];
$ponto_mestrado = calcula($mestrado, 5, 10);
$doutorado = $_REQUEST['doutorado'];
$ponto_doutorado = calcula($doutorado, 10, 20);
$obse = $_REQUEST['obs'];
$ativo = $_REQUEST['ativo'];
//$sql = "insert into pseletivo (nome, opcao, rg, cpf, titulo, sexo, reservista, casamento, nascimento, residencia, diploma, historico, tempo, cursos, pos, mestrado, doutorado) values ('".$nome."', '".$opcao."', '".$rg."', ".$cpf.", ".$titulo.", '".$sexo."', ".$reservista.", ".$casamento.", ".$nascimento.", ".$residencia.", ".$diploma.", ".$historico.", ".$tempo.", ".$cursos.", ".$pos.", ".$mestrado.", ".$doutorado.");";
$sql = "insert into pseletivo (nome, opcao, rg, cpf, titulo, sexo, reservista, casamento, nascimento, residencia, diploma, historico, tempo, cursos, pos, mestrado, doutorado, ponto_tempo, ponto_curso, ponto_pos, ponto_mestrado, ponto_doutorado, obs, ativo) values ('".$nome."', '".$opcao."', '".$rg."', ".$cpf.", ".$titulo.", '".$sexo."', ".$reservista.", ".$casamento.", ".$nascimento.", ".$residencia.", ".$diploma.", ".$historico.", ".$tempo.", ".$cursos.", ".$pos.", ".$mestrado.", ".$doutorado.", ".$ponto_tempo.",  ".$ponto_curso.", ".$ponto_pos.", ".$ponto_mestrado.", ".$ponto_doutorado.", '".$obse."',".$ativo.");";
       // echo $sql;
	   	$result = mysql_query($sql, $conexao);
	    if($result) 
		//echo "<script>carrega('pseletivo.php', $opcao, 'conteudo')</script>";
       include_once('pseletivo.php');
	   else echo '<script>alert("Erro no cadastro. Tente novamente.")</script>';

?>
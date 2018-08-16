<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
 $id = $_POST["id"]; 
 $grupo = $_POST["grupo"];
 $periodo = $_POST["periodo"];
 $idfunc = $_POST["idfunc"];
 $status = $_POST["status"]; 
 $nome = utf8_decode($_POST["nome"]); 
 if ($id != 0){
 	$sql = "UPDATE dp_atrib_escola SET nome = '$nome', grupo = $grupo, periodo = $periodo, funcionario = $idfunc, motivo = $status WHERE id = $id;";
 } else {
 	$sql = "INSERT INTO dp_atrib_escola (local, nome, grupo, periodo, funcionario, motivo, status) VALUES (".$_SESSION["localsme"].", '$nome', $grupo, $periodo, $idfunc, $status, 1);";
 }
 $exec = $con->query($sql);
 $Json = new json();
 if ($exec){
 	$Json->add('message','Turma cadastrado com sucesso');
 } else {
 	$Json->add('message','Houve um erro reveja os valores');
 }
 $Json->send(); 
 ?>
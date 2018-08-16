<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
include_once("inc_atrib.php");
 $id = $_POST["id"]; 
 $grupo = $_POST["grupo"];
 $periodo = $_POST["periodo"];
 $local = $_POST["tlocal"];
 $status = $_POST["status"]; 
 $nome = utf8_decode($_POST["nome"]); 
 if ($id != 0){
 	$sql = "UPDATE dp_atrib_turma SET turmalocal = $local, turmagrupo = $grupo, turmaperiodo = $periodo, turmastatus = $status, turmaativo = 1, turmanome = '$nome' WHERE turmaid = $id;";
 } else {
 	$sql = "INSERT INTO dp_atrib_turma (turmalocal, turmagrupo, turmaperiodo, turmastatus, turmaativo, turmanome, turmaano) VALUES ($local, $grupo, $periodo, $status, 1, '$nome', '$ano');";
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
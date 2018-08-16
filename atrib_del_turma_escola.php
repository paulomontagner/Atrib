<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
 $id = $_POST["id"]; 
 $sql = "UPDATE dp_atrib_escola SET status = 0 WHERE id = $id;";
 $exec = $con->query($sql);
 $Json = new json();
 if ($exec){
 	$Json->add('message','Turma excluida com sucesso');
 } else {
 	$Json->add('message','Houve um erro reveja os valores');
 }
 $Json->send(); 
 ?>
<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
$id = $_REQUEST["id"];
$abon = $con->query("SELECT * from dp_atrib_turma where turmaid = $id");
$row = $abon->fetch(PDO::FETCH_ASSOC);
$Json = new json();  
  $Json->add('turmaid', $row["turmaid"]);
  $Json->add('turmalocal', $row["turmalocal"]);
  $Json->add('turmagrupo', $row["turmagrupo"]);	
  $Json->add('turmaperiodo', $row["turmaperiodo"]);	
  $Json->add('turmanome', $row["turmanome"]);	    
  $Json->add('turmastatus', $row["turmastatus"]);	
$Json->send();
?>
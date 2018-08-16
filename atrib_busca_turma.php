<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
$id = $_REQUEST["id"];
$abon = $con->query("SELECT dp_atrib_escola.*, dp_atrib_classifica.matricula, dp_atrib_classifica.funcid, dp_atrib_classifica.nome as professor, dp_atrib_classifica.classifica FROM dp_atrib_escola, dp_atrib_classifica WHERE dp_atrib_escola.funcionario = dp_atrib_classifica.funcid and dp_atrib_escola.id = $id");
$row = $abon->fetch(PDO::FETCH_ASSOC);
$Json = new json();  
  $Json->add('nome', utf8_encode($row["nome"]));
  $Json->add('grupo', $row["grupo"]);	
  $Json->add('periodo', $row["periodo"]);	
  $Json->add('matricula', $row["matricula"]);	
  $Json->add('idfunc', $row["funcionario"]);	
  $Json->add('professor', utf8_encode($row["professor"]));		
  $Json->add('classifica', $row["classifica"]);	
  $Json->add('status', $row["motivo"]);	
$Json->send();
?>
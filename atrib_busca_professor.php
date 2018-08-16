<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
$matricula = $_REQUEST["matricula"];
$matricula = str_pad($matricula, 5, "0", STR_PAD_LEFT);
$abon = $con->query("select c.*, p.tipo from dp_atrib_classifica as c, dp_tipo_professor as p where c.tipo = p.id and c.matricula = '$matricula'");
$row = $abon->fetch(PDO::FETCH_ASSOC);
$Json = new json();
  $Json->add('funcid', $row["funcid"]);	
  $Json->add('nome', utf8_encode($row["nome"]));	
  $Json->add('classifica', $row["classifica"]);
  $Json->add('funcao', $row["tipo"]);	
$Json->send();
?>
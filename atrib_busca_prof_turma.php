<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
$id = $_POST["id"];
$abon = $con->query("SELECT dp_atrib_item.*, dp_funcionarios.nome, dp_funcionarios.codmatricula  FROM dp_atrib_item , dp_funcionarios  WHERE dp_atrib_item.itemfunc = dp_funcionarios.id and dp_atrib_item.itemid = $id");
$row = $abon->fetch(PDO::FETCH_ASSOC);
$Json = new json();
  $Json->add('itemid', $row["itemid"]);
  $Json->add('itemfunc', $row["itemfunc"]);
  $Json->add('turmaid', $row["turmaid"]);
  $Json->add('itemstatus', $row["itemstatus"]);
  $Json->add('itemmotivo', $row["itemmotivo"]);
  $Json->add('itemposicao', $row["itemposicao"]);
  $Json->add('profmatricula', $row["codmatricula"]);
  $Json->add('nomeprof', utf8_encode($row["nome"]));	
$Json->send();
?>
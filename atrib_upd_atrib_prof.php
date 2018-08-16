<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
$itemid = $_POST["itemid"];
$itemfunc = $_POST["itemfunc"];
$turmaid = $_POST["turmaid"];
$itemstatus = $_POST["itemstatus"];
$itemmotivo = $_POST["itemmotivo"];
$itemposicao = $_POST["itemposicao"];
$profmatricula = $_POST["profmatricula"];
$nomeprof = $_POST["nomeprof"]; 
 if ($itemid != 0){
 	$sql = "UPDATE dp_atrib_item SET itemfunc = $itemfunc ,turmaid = $turmaid ,itemstatus = $itemstatus ,itemmotivo = $itemmotivo ,itemposicao = $itemposicao WHERE itemid = $itemid;";
 } else {
 	$sql = "INSERT INTO dp_atrib_item(itemfunc, turmaid, itemstatus, itemativo, itemmotivo, itemposicao) VALUES ($itemfunc, $turmaid, $itemstatus, 1, $itemmotivo, $itemposicao);";
 	if ($itemmotivo == 1){
 		$sql .= "UPDATE dp_atrib_turma SET turmastatus = 0, turmaqtde = turmaqtde + 1 WHERE turmaid = $turmaid;"; 		
 	}
 	$sql .= "UPDATE dp_atrib_classifica SET turma = $turmaid WHERE funcid = $itemfunc;";
 }
 $exec = $con->query($sql);
 $Json = new json();
 if ($exec){
 	$Json->add('message','Solicitação cadastrada com sucesso');
 } else {
 	$Json->add('message','Houve um erro reveja os valores');
 }
 $Json->send(); 
 ?>
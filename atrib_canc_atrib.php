<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
$id = $_POST["id"];
$turma = $_POST["turma"];
$sql = "UPDATE dp_atrib_turma SET turmaqtde = turmaqtde - 1 WHERE turmaid = $turma;";
$sql .= "UPDATE dp_atrib_item SET itemativo = 0 WHERE itemfunc  = $id and turmaid  = $turma;";
$sql .= "UPDATE dp_atrib_classifica SET turma = 0 WHERE funcid = $id;";
$exe = $con->exec($sql);
$Json = new json();  
if ($exe){
  $Json->add('message', "Atribuição cancelada");
} else {
  $Json->add('message', "Erro ao cancelar");
}  
$Json->send();	
?>
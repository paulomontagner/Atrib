<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
include_once("inc_atrib.php");
$sql = "";
$rs = $con->prepare("SELECT * from dp_atrib_escola where id = :id");
foreach($_POST["turma"] as $key => $value){
    $rs->execute([':id' => $value]);
    foreach ($rs as $linha) {
    	if ($linha["funcionario"] != 0){ 
    		if ($linha["motivo"] == 1){
    			$status = 0;
    		} else {
    			$status = 1; }
    		 } else { $status = 1;}
    	$sql .= "INSERT INTO dp_atrib_turma (turmalocal, turmagrupo, turmaperiodo, turmastatus, turmaativo, turmanome, turmaano) VALUES (".$linha["local"].", ".$linha["grupo"].", ".$linha["periodo"].", $status, 1, '".$linha["nome"]."', '$ano');";    	
    	if ($linha["funcionario"] != 0){
        $sql .= "SET @ultimo = LAST_INSERT_ID();";
    	$sql .= "INSERT INTO dp_atrib_item (itemfunc, turmaid, itemstatus, itemativo, itemmotivo, itemposicao) VALUES (".$linha["funcionario"].", @ultimo, 1, 1, ".$linha["motivo"].",1);";
    	$sql .= "UPDATE dp_atrib_classifica SET turma = @ultimo WHERE funcid = ".$linha["funcionario"].";";
        $sql .= "UPDATE dp_atrib_turma set turmaqtde = turmaqtde + 1 where turmaid = @ultimo;";
        }
    	$sql .= "UPDATE dp_atrib_escola SET import = 1 WHERE id = ".$linha["id"].";";
    }
}
//echo $sql;
$Json = new json(); 
$ok = $con->exec($sql);
if ($ok){
  $Json->add('Mensagem', 'Turmas importadas com sucesso');
} else {
  $Json->add('Mensagem', 'Houve um erro durante a importação das turmas');
}
$Json->send();
?>
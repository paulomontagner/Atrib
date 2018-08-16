<?php
include_once("../include/base.php");
require('../plugin/fpdf/fpdf.php');
$incturma = $_POST["turma"];
$incidfunc = $_POST["idfunc"];
$incposicao = $_POST["posicao"];
$incmotivo = $_POST["motivo"];
if ($incmotivo == 1){
	$statusturma = 0; 
} else {
	$statusturma = 1; 
}
++$incposicao;
$sql = "UPDATE dp_atrib_turma SET turmastatus = $statusturma, turmaqtde = turmaqtde + 1 WHERE turmaid = $incturma;";
$sql .= "INSERT INTO dp_atrib_item (itemfunc, turmaid, itemstatus, itemativo, itemmotivo, itemposicao) values ($incidfunc, $incturma, 1, 1, $incmotivo, $incposicao);";
$sql .= "UPDATE dp_atrib_classifica SET turma = $incturma WHERE funcid = $incidfunc;";
$exe = $con->exec($sql);
if ($exe){
include_once("atrib.php");
}
?>
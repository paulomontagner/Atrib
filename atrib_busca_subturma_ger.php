<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
$id = $_REQUEST["id"];
$abon = $con->query("SELECT * from dp_atrib_sub where subid = $id");
$row = $abon->fetch(PDO::FETCH_ASSOC);
$Json = new json();  
  $Json->add('subid', $row["subid"]);
  $Json->add('turmaid', $row["turmaid"]);
  $Json->add('sublocal', $row["sublocal"]);  
  $Json->add('subperiodo', $row["subperiodo"]);	
  $Json->add('a', $row["a"]);	    
  $Json->add('b', $row["b"]);
  $Json->add('c', $row["c"]);
  $Json->add('d', $row["d"]);
  $Json->add('e', $row["e"]);
  $Json->add('f', $row["f"]);  
$Json->send();
?>
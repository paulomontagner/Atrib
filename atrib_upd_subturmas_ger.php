<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("../include/json.php");
 $subid = $_POST["subid"]; 
 $subperiodo = $_POST["subperiodo"];
 $sublocal = $_POST["sublocal"];
 $a = $_POST["a"];
 $b = $_POST["b"];
 $c = $_POST["c"];
 $d = $_POST["d"];
 $e = $_POST["e"];
 $f = $_POST["f"];
 $subturmaid = $_POST["subturmaid"];
  if ($subid != 0){
 	$sql = "UPDATE  dp_atrib_sub SET subperiodo  = $subperiodo , turmaid  = $subturmaid , sublocal  = $sublocal , a  = $a , b  = $b , c  = $c , d  = $d , e  = $e , f  = $f , subativo  = 1  WHERE subid = $subid;";
 } else {
 	$sql = "INSERT INTO  dp_atrib_sub ( subperiodo ,  turmaid ,  sublocal ,  a ,  b ,  c ,  d ,  e ,  f ,  subativo ) VALUES ( $subperiodo ,  $subturmaid ,  $sublocal ,  $a ,  $b ,  $c ,  $d ,  $e ,  $f ,  1 );";
 }
 $exec = $con->query($sql);
 $Json = new json();
 if ($exec){
 	$Json->add('message','Subturma cadastrado com sucesso');
 } else {
 	$Json->add('message','Houve um erro reveja os valores');
 }
 $Json->send(); 
 ?>
<?php
// Abre seu template
$file = "desistencia.rtf";
//Headers
header("Content-type: application/msword");
header("Content-Disposition: inline, filename=$file");
$dia = date('d');
$mes = date('m');
$ano = date('Y');
switch ($mes){
case 1: $mes = "Janeiro"; break;
case 2: $mes = "Fevereiro"; break;
case 3: $mes = utf8_decode("Março"); break;
case 4: $mes = "Abril"; break;
case 5: $mes = "Maio"; break;
case 6: $mes = "Junho"; break;
case 7: $mes = "Julho"; break;
case 8: $mes = "Agosto"; break;
case 9: $mes = "Setembro"; break;
case 10: $mes = "Outubro"; break;
case 11: $mes = "Novembro"; break;
case 12: $mes = "Dezembro"; break;
}
require_once('../estrutura/base.php');
$id = $_REQUEST['id'];
$classifica = $_REQUEST['classifica'];
$sql = "select nome from funcionarios where codmatricula = $id";
$pre = mysql_query($sql);
$linha = mysql_fetch_assoc($pre);
$fp = fopen( $file, "r" );

//Le o template na variavel
$output = fread( $fp, filesize( $file ) );

fclose ( $fp );

//Substitui as tags pelas variáveis

$output = str_replace( "#nome#", $linha['nome'], $output );
//$output = str_replace( "#rg#", $linha['rg'], $output );
$output = str_replace( "#id#", $linha['id'], $output );
$output = str_replace( "#hs#", '30 horas', $output );
$output = str_replace( "#classifica#", $classifica, $output );
$output = str_replace( "#data#", "$dia de $mes de $ano", $output );

//Serve o documento
echo $output;
?>
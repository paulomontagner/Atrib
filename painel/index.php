<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>secretaria de Desenvolvimento Econômico</title>
<script type="text/javascript" src="../funcoes/Ajax.js"></script> 
<script type="text/javascript"> 
function senha(resultado){
 if (resultado != '') {
 var palavras= resultado.split("|");
 var td = document.getElementById("senha1");
 var td1 = document.getElementById("mesa1");
 var td2 = document.getElementById("imagem");
 td.innerHTML = "<p align='center' class='style2'>"+palavras[0]+"</p>";
 td1.innerHTML ="<p align='center' class='style2'>"+palavras[1]+"</p>";
 td2.innerHTML ="<p align='center' class='style2'>"+palavras[2]+"</p>";
 document.getElementById("sound_element").innerHTML= "<embed src='doorbell.wav' hidden='true' autostart='true' loop='false'>";
 document.getElementById("3c").innerHTML = document.getElementById("2c").innerHTML;
 document.getElementById("3d").innerHTML = document.getElementById("2d").innerHTML;
 document.getElementById("2c").innerHTML = document.getElementById("1c").innerHTML;
 document.getElementById("2d").innerHTML = document.getElementById("1d").innerHTML;
 document.getElementById("1c").innerHTML = palavras[0];
 document.getElementById("1d").innerHTML = palavras[1];
 }}
 function verifica() {
	ajaxGo({url: "index1.php", callback: senha}); return false;
	var y = setTimeout ("verifica()", 5000);
}
</script> 
<style type="text/css">
<!--
.td {
font-size: 100px;
color:#0000CC;
font-style:oblique;
font-weight:bold;
margin: 10px;
border-top-left-radius: 1em;
background: #f7f7f7;
padding: 20px;

color: #000;
}
.td1 {
font-size: 70px;
color:#0000CC;
font-style:oblique;
font-weight:bold;
margin: 10px;
border-top-right-radius: 1em;
background: #f7f7f7;
padding: 20px;

color: #000;
}
.tdd {
font-size: 100px;
color:#0000CC;
font-style:oblique;
font-weight:bold;
margin: 10px;
border-bottom-left-radius: 1em;
background: #f7f7f7;
padding: 20px;

color: #000;
}
.tdd1 {
font-size: 100px;
color:#0000CC;
font-style:oblique;
font-weight:bold;
margin: 10px;
border-bottom-right-radius: 1em;
background: #f7f7f7;
padding: 20px;

color: #000;
}
.meio {
font-size: 100px;
color:#0000CC;
font-style:oblique;
font-weight:bold;
margin: 10px;
background: #f7f7f7;
padding: 20px;

color: #000;
opacity:0.50;
}


-->
</style>
</head> 
<body background="img/background.png" style="padding:0; margin:0"  Onload="verifica()">
<div id="sound_element"></div>
<table width="100%" border="0" align="center">
<tr><td colspan="2" class="td" align="center" id="imagem">&nbsp;</td></tr>
<tr>
<th width="50%" class="meio">Matricula</th>
<th width="50%" class="meio">Sala</th>
</tr>
<tr><td height="119" align="center" class="tdd" id="senha1"></td>
<td class="tdd1" align="center" id="mesa1"></td>
</tr>
<tr><td colspan="2"><table width="100%" bgcolor="#FFFFFF" style="font-size:70px;">
<tr>
  <th colspan="4" align="center">Ultimas matriculas chamadas</th></tr>
<tr>
  <td width="25%">Matricula</td><td width="25%" id="1c"><div align="center">1</div></td><td width="25%" id="2c"><div align="center">2</div></td><td width="25%" id="3c"><div align="center">3</div></td></tr>
<tr>
  <td width="25%">Sala</td><td width="25%" id="1d"><div align="center">1</div></td><td width="25%" id="2d"><div align="center">2</div></td><td width="25%" id="3d"><div align="center">3</div></td></tr>
</table>
</table>
</body> 
</html>
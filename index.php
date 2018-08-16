<?php include_once('protect.php');
include_once("estrutura/base.php");?>
<head>
   <link rel="shortcut icon" href="/imagens/cubo.png" />
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/paging.css">
   <link rel="stylesheet" href="css/form.css">
   <link rel="stylesheet" href="css/msg.css">
   <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
   <link href="scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" src="funcoes/ajax.js"></script>
   <script type="text/javascript" src="funcoes/funcoes.js"></script>
   <script type="text/javascript" src="funcoes/mascara.js"></script>
   <script type="text/javascript" src="funcoes/func.js"></script>
   <script type="text/javascript" src="funcoes/paging.js"></script>
   <script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
   <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
   <script src="scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
   <script src="scripts/jtable/jquery.jtable.min.js" type="text/javascript"></script>
   <script src="scripts/grp/highcharts.js"></script>
   <script src="scripts/grp/modules/exporting.js"></script>
<script type="text/javascript">
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}
document.onkeypress = stopRKey;
</script>   
   <title>Secretaria Municipal de Educação de Suzano</title>
</head>
<body>
    <div id="header">      
    <img src="imagens/logo1.png" align="left"><h1 align="center">Intranet Educacional<a href="logout.php"><img src="imagens/crias.png" width="132" height="112" align="right"></a></h1>
    </div>
<div id='cssmenu'>
<ul>
    
    <?php
    $selec = "SELECT id_menu, texto, link FROM menus";
    $exec = mysql_query($selec, $conexao) or die(mysql_error());
    ?>

    <?php
    // menus principais
    while($campos=mysql_fetch_array($exec)) {
    extract($campos);
	echo "<li class='active has-sub'><a href=\"$link\">$texto</a><ul>";

    // submenu
    $selec2 = "SELECT id_submenu, texto, link FROM submenu WHERE id_menu='$id_menu' and acesso like '%".$_SESSION["acesso"]."%';";
    $exec2 = mysql_query($selec2, $conexao) or die(mysql_error());
	while($campos2=mysql_fetch_array($exec2)) {
    extract($campos2);
    echo "<li><a href=\"$link\" class=\"micoxajax\" target=\"conteudo\">$texto</a></li>";
    } // fim do submenu
	echo "</ul></li>";

    } // fim do menu principal
    ?>
   
</ul>
</div>
<div id="conteudo">
  	</div>    
  	<div id="tela">
  	</div>
 <div id="rodape">

    <p align="left"><a href="mailto:informatica.sme@suzano.sp.gov.br"><?php if(isset($_SESSION["nome"])){
			echo $_SESSION["id"]." - ".$_SESSION["nome"];
} ?></a>  </p>
</div>    
</body>
<html>

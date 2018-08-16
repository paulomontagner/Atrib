<?php header("Content-Type: text/html; charset=UTF-8",true) ?>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/paging.css">
   <link rel="stylesheet" href="css/form.css">
   <link rel="stylesheet" href="css/msg.css">
   <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
   <link href="Scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" src="funcoes/ajax.js"></script>
   <script type="text/javascript" src="funcoes/funcoes.js"></script>
   <script type="text/javascript" src="funcoes/mascara.js"></script>
   <script type="text/javascript" src="funcoes/func.js"></script>
   <script type="text/javascript" src="funcoes/paging.js"></script>
   <script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
   <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
   <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
   
   <title>Secretaria Municipal de Educação de Suzano</title>
</head>
<body>
    <div id="header">      
    <img src="imagens/logo1.png" align="left"><h1 align="center">Intranet Educacional<img src="imagens/crias.png" width="132" height="112" align="right"></h1>
    </div>
<div id='cssmenu'>
<ul>
    <?php
    $conexao = mysql_connect("localhost", "root", "muf2kafu") or die(mysql_error());
    $db = mysql_select_db("atrib");
    ?>

    <?php
    $selec = "SELECT id_menu, texto, link FROM menus";
    $exec = mysql_query($selec, $conexao) or die(mysql_error());
    ?>

    <?php
    // menus principais
    while($campos=mysql_fetch_array($exec)) {
    extract($campos);
	echo "<li class='active has-sub'><a href=\"$link\" class=\"micoxajax\" target=\"conteudo\">$texto</a><ul>";

    // submenu
    $selec2 = "SELECT id_submenu, texto, link FROM submenu WHERE id_menu='$id_menu'";
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

    <p align="right"><a href="mailto:informatica.sme@suzano.sp.gov.br"><?php if(isset($_SESSION["nome"])){
			echo $_SESSION["id"]." - ".$_SESSION["nome"];
} ?></a>  </p>
</div>    
</body>
<html>

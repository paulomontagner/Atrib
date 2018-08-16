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
   <li><a href='#'><span>Home</span></a></li>
   <li class='active has-sub'><a href='#'><span>Cadastros</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Atribuição</span></a>
            <ul>
               <li><a href='admlocais.php' class='micoxajax' target='conteudo'>Gerenciar turmas</a></li>
               <li><a href='jgrupo.php' class='micoxajax' target='conteudo'>Grupos</a></li>
               <li><a href='jhtpc.php' class='micoxajax' target='conteudo'>HTPC</a></li>
               <li class='last'><a href='jmotivos.php' class='micoxajax' target='conteudo'>Tipos de afastamentos</a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Atribuição docentes</span></a>
            <ul>
               <li><a href='classifica_docente.php?tipo=1' class='micoxajax' target='conteudo'>PEB I 24h Concursados</a></li>
               <li><a href='classifica_docente.php?tipo=2' class='micoxajax' target='conteudo'>PEB I 24h Estáveis</a></li>
               <li><a href='classifica_docente.php?tipo=3' class='micoxajax' target='conteudo'>PEB I 30h Concursados</a></li>
               <li><a href='classifica_docente.php?tipo=4' class='micoxajax' target='conteudo'>PEB I 24h CLT</a></li>
               <li><a href='classifica_docente.php?tipo=5' class='micoxajax' target='conteudo'>PEB I Adjunto</a></li>
               <li><a href='classifica_docente.php?tipo=6' class='micoxajax' target='conteudo'>PEB II Disciplinas</a></li>
               <li><a href='classifica_docente.php?tipo=7' class='micoxajax' target='conteudo'>PEB II Educa&ccedil;&atilde;o F&iacute;sica</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='classifica_docente.php?tipo=7' class='micoxajax' target='conteudo'>PEB II Educa&ccedil;&atilde;o F&iacute;sica</a></li>
   <li class='last'><a href='#'><span>Contact</span></a></li>
</ul>
</div>
<div id="conteudo">
  	</div>    
  	<div id="tela">
  	</div>
 <div id="rodape">
    <p align="right"><a href="mailto:informatica.sme@suzano.sp.gov.br">2014 -  Setor de Inform&aacute;tica - SME</a>  </p>
</div>    
</body>
<html>

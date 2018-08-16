<?php
	// Iniciar Session PHP 
	include_once('options.php');
	session_start();

	// Se o usuário não estiver logado manda ele para o formulário de login
	if (isset($_SESSION["Login"]) AND $_SESSION["Login"]!='YES' OR !isset($_SESSION["Login"])){
			// Se não tiver sessão iniciada
			echo '<html>
					<head>
						<title>'.TITULO_PAGINA_PROTEGIDA.'</title>
						<link rel="stylesheet" href="css/style.css" type="text/css"/>
						<link rel="stylesheet" href="css/le-frog.css" />
						<script type="text/javascript" src="scripts/jquery-1.6.4.min.js"></script>
						<script type="text/javascript" src="scripts/jquery-ui-1.8.16.custom.min.js"></script>
						<script type="text/javascript">
							window.onload=function(){
								var count='.TIME_REDIRECT.';
								var counter=setInterval(timer, 1000);
								function timer(){
									count=count-1;
									document.getElementById("counter").innerHTML=count;
									if (count <= 0){
										clearInterval(counter);
										return;
									}
								}
								var refresh_period = 1000;
								var max_value = '.TIME_REDIRECT.';
								var valueProgress = 0;
								intervalU = setInterval(updateValue, 1000);
								function updateValue(){
									valueProgress=valueProgress+1;
									if(valueProgress>='.TIME_REDIRECT.'){
										clearInterval(intervalU);
										return;
									}
									$( "#progress_bar" ).progressbar({ 
										max: '.TIME_REDIRECT.',
										value: valueProgress
									});
								}
							}
						</script>
					</head>
					<body>
						<meta HTTP-EQUIV="REFRESH" content="'.TIME_REDIRECT.'; url=login.php">
						<div id="content">
							<p class="erro"><img src="imagens/exclamation.png" height="30px"> É necessário iniciar sessão para visualizar esta página.</p>
							<p class="text">Será redirecionado dentro de <span id="counter"></span> segundos.</p>
							<br />
							<div id="progress_bar">
							</div><!--Progress_bar-->						
							</div><!--Content-->
					</body>
				</html>';
			exit;
	}

?>

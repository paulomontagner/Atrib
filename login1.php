<?php
	//HEADER
	header("Content-type: text/html; charset=utf-8");
	// Sess�o
	session_start();
	
	if(isset($_POST['username'])){
		include_once('estrutura/base.php');
		
		// Verifica se j� tinha sess�o iniciada
		if(isset($_POST['username'])){
		$usuario = $_POST['username'];
		$usuario = strtoupper($usuario);
		$senha = $_POST["password"];
		$senha = strrev($senha);
			// Verifica se usu�rio e senha conferem
			$logged=false;
			$SQL = "select * from usuario where upper(usuario) = '$usuario' and senha = '$senha'";
            $Result = mysql_query($SQL, $conexao);
            $row = mysql_fetch_assoc($Result);
			$id = $row['id'];
			$nome = $row['nome'];
			$user = $row['usuario'];
			$pass = $row['senha'];
			$acesso = $row['acesso'];

				if($usuario == $user && $senha == $pass) {
					$logged=true;
				}			
			if($logged==true){
			// Se usu�rio e senha conferir definimos session para YES
					$_SESSION["Login"] = "YES";
					$_SESSION["nome"] = $nome;
					$_SESSION["id"] = $id;
					$_SESSION["acesso"] = $acesso;
					//window.open('index.php');
					header('Location: index.php');
						 
				}else{
			 
				// Se usu�rio e senha conferir definimos session para NO
					$_SESSION ["Login"] = "NO";
                  header('Location: login.php');
				}
		}
	}
	if(isset($_GET['check']) && $_GET['check']=='true'){
		if($_SESSION["Login"] == "YES"){
			echo 'yes';
		}else{
			echo 'no';
		}
	}
	if(isset($_GET['userLogin'])){
		if(isset($_SESSION['User'])){
			echo $_SESSION['User'];
		}
	}
?>
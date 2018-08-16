<?
	@session_start();
	
	if(!isset($_SESSION['usuario_validado']))
	{
		include_once("index.php");
		exit;
	}
?>

<?php
	//Função para verificar campos obrigatórios. Caso o campo esteja em branco ou com valor nulo
	//é exibida mensagem de erro e retorna-se a página anterior
	function verificaObrigatorio($campo, $mesagem)
	{
		if(empty($campo) or !$campo)
		{
			echo "<script>alert('$mesagem');history.back(-1);</script>";
			exit();
		}
	}
?>
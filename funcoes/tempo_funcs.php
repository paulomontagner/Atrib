<?php
	//Converter data formato brasileiro -> formato ingles
	function dataing($databr, $dia = 0)
	{
		$data = explode("/", $databr);
		if(!$dia)
		{
			$valida = checkdate((int)$data[1], (int)$data[0], (int)$data[2]);
			$dataing = $data[2]."-".$data[1]."-".$data[0];
		}
		else {
			$valida = checkdate((int)$data[1], $dia, (int)$data[2]);
			$dataing = $data[1]."-".$data[0]."-".$dia;
		}
		
		if($valida) return $dataing;
		else return false;
	}
?>
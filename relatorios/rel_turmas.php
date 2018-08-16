<?php
@session_start();
include_once("../../include/base.php");
require_once('../../plugin/fpdf/fpdf.php'); // inclui a classe FPDF
$sb = $con->prepare("SELECT dp_atrib_sub.*, locais.nome, dp_turnos.grupo, dp_turnos.nome as periodo, dp_turnos.entrada, dp_turnos.saida FROM dp_atrib_sub, locais, dp_turnos WHERE locais.id = dp_atrib_sub.sublocal and dp_turnos.id = dp_atrib_sub.subperiodo and dp_atrib_sub.turmaid = :turma");
function limite($texto, $tamanho){
    $rest = substr($texto, 0, $tamanho);
    return iconv('utf-8','iso-8859-1', $rest);
}
$status = array('0' => 'Livre', '1' => 'Atribuição do 1º Suplente', '2' => 'Atribuição do 2º Suplente', '3' => 'Atribuição do 3º Suplente');
$aberto = array('0' => 'Encerrada', '1' => 'liberada');
class PDF extends FPDF
{
	function Header()
	{
	    global $title;
	    $this->Image("../../imagens/logo1.png" , 15, 5, 16, 16,"PNG");	    
	    $this->SetFont('Arial','B',15);	    
	    $w = $this->GetStringWidth($title)+6;
	    $this->SetX((210-$w)/2);	    
	    $this->SetDrawColor(0,80,180);
	    $this->SetFillColor(250,250,250);
	    $this->Cell($w,9,$title,0,1,'C',true);	    
	    $this->Ln(10);
	}

	function Footer()
	{
	    
	    $this->SetY(-20);
	    $this->SetFont('Arial','I',8);
	    $this->SetTextColor(128);
	    $this->Cell(0,5,iconv('utf-8','iso-8859-1','Rua Aurora, 303 - Vila São Francisco - Suzano/SP'),0,0,'C');
	    $this->Ln();
	    $this->Cell(0,5,iconv('utf-8','iso-8859-1','Tel: (11) 4744-8900 e-mail: educacao@suzano.sp.gov.br'),0,0,'C');
	    $this->Ln();
	    $this->Cell(0,5,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$title = 'Secretaria Municipal de Educação';
$title = iconv('UTF-8', 'ISO-8859-1', $title);
$pdf->SetTitle($title);
$pdf->AddPage();
		$sql = "SELECT dp_atrib_turma.turmaid, dp_atrib_turma.turmagrupo, dp_atrib_turma.turmastatus, dp_atrib_turma.turmanome, locais.nome, locais.dificil, grupos.grupo, dp_turnos.grupo as grupo1, dp_turnos.nome as periodo, dp_turnos.entrada, dp_turnos.saida, dp_atrib_turma.turmaqtde FROM dp_atrib_turma , locais , grupos , dp_turnos  WHERE dp_atrib_turma.turmaativo = 1 and dp_atrib_turma.turmalocal = locais.id and grupos.id = dp_atrib_turma.turmagrupo and dp_turnos.id = dp_atrib_turma.turmaperiodo";
		$tipo = $_REQUEST["tipo"];		
		switch ($tipo) {
			case 1:	
			$sql .= " and dp_atrib_turma.turmastatus = 1 and dp_turnos.horasdia = 4 and dp_atrib_turma.turmaqtde = 0"; 
			$titulo = "Turmas 24 horas livres";
			break; //30 horas livres
			case 2:	
			$sql .= " and dp_atrib_turma.turmastatus = 1 and dp_turnos.horasdia = 4 and dp_atrib_turma.turmaqtde > 0"; 
			$titulo = "Turmas 24 horas em substituição";
			break; //24 horas suplementação
			case 3:
			$sql .= " and dp_atrib_turma.turmastatus = 1 and dp_turnos.horasdia = 5 and dp_atrib_turma.turmagrupo != 21 and dp_atrib_turma.turmaqtde = 0"; 
			$titulo = "Turmas 30 horas livres";
			break; //30 horas livre
			case 4:
			$sql .= " and dp_atrib_turma.turmastatus = 1 and dp_turnos.horasdia = 5 and dp_atrib_turma.turmagrupo != 21 and dp_atrib_turma.turmaqtde > 0"; 
			$titulo = "Turmas 30 horas em substituição";
			break; //30 horas suplementação
			case 5:	
			$sql .= " and dp_atrib_turma.turmastatus = 1 and dp_turnos.horasdia = 6 and dp_atrib_turma.turmaqtde = 0"; 
			$titulo = "Turmas adjunto livres";
			break; //Adjunto
			case 6:	
			$sql .= " and dp_atrib_turma.turmastatus = 1 and dp_turnos.horasdia = 6 and dp_atrib_turma.turmaqtde > 0"; 
			$titulo = "Turmas adjunto em substituição";
			break; //24 horas clt
			case 7:
			$sql .= " and dp_atrib_turma.turmastatus = 1 and dp_turnos.horasdia = 5 and dp_atrib_turma.turmagrupo = 21 and dp_atrib_turma.turmaqtde = 0"; 
			$titulo = "Turmas educação fisica livres";
			break; //30 horas livre
			case 8:
			$sql .= " and dp_atrib_turma.turmastatus = 1 and dp_turnos.horasdia = 5 and dp_atrib_turma.turmagrupo = 21 and dp_atrib_turma.turmaqtde > 0"; 
			$titulo = "Turmas educação fisica para suplementação";
			break; //30 horas suplementação
			case 9:	
			$sql .= " and dp_atrib_turma.turmastatus = 1";
			$titulo = "Todas as turmas disponiveis para atribuição";
			break; //30 horas suplementação
			case 10:	
			$sql .= " and dp_turnos.horasdia = 6"; 
			$titulo = "Turmas adjunto todas";
			break; //Adjunto
		}
		$sql .= " order by nome, grupo, turmanome";
		$pdf->SetFont('Arial','B',14);
        $pdf->Cell( 192, 10, iconv('utf-8','iso-8859-1',$titulo),1, 1, 'C', false);               
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(190,190,190);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(12,5, iconv('utf-8','iso-8859-1','Código'),1, 0, 'L', true);
        $pdf->Cell(80,5, iconv('utf-8','iso-8859-1','Local'),1, 0, 'L', true);
        $pdf->Cell(30,5, iconv('utf-8','iso-8859-1','Turma'),1, 0, 'L', true);
        $pdf->Cell(35,5, iconv('utf-8','iso-8859-1','Período'),1, 0, 'L', true);
        $pdf->Cell(35,5, iconv('utf-8','iso-8859-1','Status'),1, 1, 'L', true);
        $pdf->SetFont('Arial','',8);
        $cor = false;
        $cont = 0;
        $rs = $con->query($sql);
        foreach ($rs as $linha) {
        	$pdf->SetFillColor(190,190,190);
	        $pdf->Cell(12,5, iconv('utf-8','iso-8859-1',str_pad($linha["turmaid"], 6, "0", STR_PAD_LEFT)),1, 0, 'L', $cor);
	        $pdf->Cell(80,5, iconv('utf-8','iso-8859-1',utf8_encode($linha["nome"])),1, 0, 'L', $cor);
	        $pdf->Cell(30,5, iconv('utf-8','iso-8859-1',utf8_encode($linha["grupo"]." ".$linha["turmanome"])),1, 0, 'L', $cor);
	        $pdf->Cell(35,5, iconv('utf-8','iso-8859-1',utf8_encode($linha["periodo"]." (".$linha["entrada"]."-".$linha["saida"].")")),1, 0, 'L', $cor);
	        if($tipo == 10){
	        	$st = $status[$linha["turmaqtde"]]."-".$aberto[$linha["turmastatus"]];
	        } else {
	        	$st = $status[$linha["turmaqtde"]];
	        }
	        $pdf->Cell(35,5, iconv('utf-8','iso-8859-1', $st),1, 1, 'L', $cor);
	        $cor = !$cor;
	        ++$cont;
	        if ($linha["turmagrupo"] == 21){	        
	        	$pdf->SetFillColor(207,207,190);	
		        $pdf->Cell(70, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', 'Local'), 1,0,'L', true);
		        $pdf->Cell(40, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', 'Periodo'), 1,0,'C', true);
		        $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', '1º Ano'), 1,0,'C', true);
		        $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', '2º Ano'), 1,0,'C', true);
		        $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', '3º Ano'), 1,0,'C', true);
		        $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', '4º Ano'), 1,0,'C', true);
		        $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', '5º Ano'), 1,0,'C', true);
		        $pdf->Cell(27, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', 'Horas de projeto'), 1,1,'C', true);
		        $cor = false;		        
		        $sb->execute([':turma' => $linha["turmaid"]]);
		        foreach ($sb as $ln) {            		            
		            $pdf->Cell(70, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', utf8_encode($ln["nome"])), 1,0,'L', $cor);
		            $pdf->Cell(40, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', utf8_encode($ln["entrada"]."-".$ln["saida"])), 1,0,'C', $cor);
		            $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', $ln["a"]), 1,0,'C', $cor);
		            $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', $ln["b"]), 1,0,'C', $cor);
		            $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', $ln["c"]), 1,0,'C', $cor);
		            $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', $ln["d"]), 1,0,'C', $cor);
		            $pdf->Cell(11, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', $ln["e"]), 1,0,'C', $cor);
		            $pdf->Cell(27, 5, iconv('UTF-8', 'ISO-8859-1//IGNORE', $ln["f"]), 1,1,'C', $cor);
		            $cor = !$cor;
		         }
		        $pdf->Ln();
	        }
        }
        $pdf->Cell( 192, 10, iconv('utf-8','iso-8859-1',$cont." turmas listadas para atribuição"),0, 0, 'C', false);
$pdf->Output();
?>
<?php
@session_start();
include_once("../../include/base.php");
require_once('../../plugin/fpdf/fpdf.php'); // inclui a classe FPDF
$sb = $con->prepare("SELECT dp_atrib_sub.*, locais.nome, dp_turnos.grupo, dp_turnos.nome as periodo, dp_turnos.entrada, dp_turnos.saida FROM dp_atrib_sub, locais, dp_turnos WHERE locais.id = dp_atrib_sub.sublocal and dp_turnos.id = dp_atrib_sub.subperiodo and dp_atrib_sub.turmaid = :turma");
function limite($texto, $tamanho){
    $rest = substr($texto, 0, $tamanho);
    return iconv('utf-8','iso-8859-1', $rest);
}
$status = array('0' => 'Livre', '1' => 'Atribuição do 1º Suplente', '2' => 'Atribuição do 2º Suplente');
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
		$sql = "SELECT dp_atrib_classifica.id, dp_atrib_classifica.classifica, dp_atrib_classifica.matricula, dp_atrib_classifica.nome, dp_tipo_professor.tipo
FROM dp_atrib_classifica, dp_tipo_professor
WHERE dp_atrib_classifica.tipo = dp_tipo_professor.id
AND dp_atrib_classifica.turma = 0 and dp_atrib_classifica.tipo =";
		$tipo = $_REQUEST["tipo"];		
		switch ($tipo) {
			case 1:	
			$sql .= " 1 ORDER BY classifica"; 
			$titulo = "Professor 30 horas concursado";
			break; 
			case 2:	
			$sql .= " 2 ORDER BY classifica"; 
			$titulo = "Professor 24 horas estável";
			break; 
			case 3:	
			$sql .= " 3 ORDER BY classifica"; 
			$titulo = "Professor Adjunto";
			break; 
			case 4:	
			$sql .= " 4 ORDER BY classifica"; 
			$titulo = "Professor 30 horas disciplina";
			break; 
			case 5:	
			$sql .= " 5 ORDER BY classifica"; 
			$titulo = "Professor 30 horas Educação Física";
			break; 
			case 6:	
			$sql .= " 6 ORDER BY classifica"; 
			$titulo = "Professor 24 horas CLT";
			break; 
			case 7:	
			$sql .= " 7 ORDER BY classifica"; 
			$titulo = "Professor 24 horas Concursado";
			break; 
		}		
		$pdf->SetFont('Arial','B',14);
        $pdf->Cell( 192, 10, iconv('utf-8','iso-8859-1',$titulo),1, 1, 'C', false);               
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(190,190,190);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(30,5, iconv('utf-8','iso-8859-1','Classificação'),1, 0, 'L', true);
        $pdf->Cell(30,5, iconv('utf-8','iso-8859-1','Matricula'),1, 0, 'L', true);
        $pdf->Cell(90,5, iconv('utf-8','iso-8859-1','Nome'),1, 0, 'L', true);
        $pdf->Cell(42,5, iconv('utf-8','iso-8859-1','Tipo'),1, 1, 'L', true);        
        $pdf->SetFont('Arial','',8);
        $cor = false;
        $cont = 0;
        $rs = $con->query($sql);
        foreach ($rs as $linha) {
        	$pdf->SetFillColor(190,190,190);
	        $pdf->Cell(30,5, iconv('utf-8','iso-8859-1',str_pad($linha["classifica"], 4, "0", STR_PAD_LEFT)."º"),1, 0, 'C', $cor);
	        $pdf->Cell(30,5, iconv('utf-8','iso-8859-1',utf8_encode($linha["matricula"])),1, 0, 'C', $cor);
	        $pdf->Cell(90,5, iconv('utf-8','iso-8859-1',utf8_encode($linha["nome"])),1, 0, 'L', $cor);
	        $pdf->Cell(42,5, iconv('utf-8','iso-8859-1',utf8_encode($linha["tipo"])),1, 1, 'L', $cor);	        
	        $cor = !$cor;
	        ++$cont;	    
        }
        $pdf->Cell( 192, 10, iconv('utf-8','iso-8859-1',$cont." docentes listados para atribuição"),0, 0, 'C', false);
$pdf->Output();
?>
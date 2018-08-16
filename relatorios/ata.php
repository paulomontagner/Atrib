<?php
@session_start();
include_once("../../include/base.php");
include_once("../../include/funcoes.php");
include_once("../../include/extenso.php");
require('../../plugin/fpdf/fpdf.php'); // inclui a classe FPDF
date_default_timezone_set('America/Sao_Paulo');
function limite($texto, $tamanho){
    $rest = substr($texto, 0, $tamanho);
    return iconv('utf-8','iso-8859-1', $rest);
}
class PDF extends FPDF
{
function Header()
{
    global $title;
    $this->Image("../../imagens/logo1.png" , 15, 5, 16, 16,"PNG");
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(250,250,250);
    //$this->SetTextColor(220,50,50);
    // Thickness of frame (1 mm)
    //$this->SetLineWidth(1);
    // Title
    $this->Cell($w,9,$title,0,1,'C',true);
    // Line break
    $this->Ln(10);
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-20);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(0,5,iconv('utf-8','iso-8859-1','Rua Aurora, 303 - Vila São Francisco - Suzano/SP'),0,0,'C');
    $this->Ln();
    $this->Cell(0,5,iconv('utf-8','iso-8859-1','Tel: (11) 4744-8900 e-mail: educacao@suzano.sp.gov.br'),0,0,'C');
    $this->Ln();
    $this->Cell(0,5,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

}
$dia = (int)date('d',time());
$mes = date('m');
$ano = (int)date('Y',time());
$hora = (int)date('G',time());
if ($hora == 0) {$hora = 24;}
$min = (int)date('i',time());
if ($min == 0) {$min = 1;}
switch ($mes){
case 1: $mes = "Janeiro"; break;
case 2: $mes = "Fevereiro"; break;
case 3: $mes = "Março"; break;
case 4: $mes = "Abril"; break;
case 5: $mes = "Maio"; break;
case 6: $mes = "Junho"; break;
case 7: $mes = "Julho"; break;
case 8: $mes = "Agosto"; break;
case 9: $mes = "Setembro"; break;
case 10: $mes = "Outubro"; break;
case 11: $mes = "Novembro"; break;
case 12: $mes = "Dezembro"; break;
}
$dia_ext = GExtenso::numero($dia);
$ano_ext = GExtenso::numero($ano);
$hora_ext = GExtenso::numero($hora);
$min_ext = GExtenso::numero($min);
$data = "Aos ".$dia_ext." dias do mês de ".$mes." de ".$ano_ext. ", às ".$hora_ext;
$sql = "SELECT dp_atrib_escola.nome, dp_atrib_classifica.matricula, dp_atrib_classifica.funcid, dp_atrib_classifica.nome as professor, dp_atrib_classifica.classifica, dp_motivos.nome as motivo, dp_turnos.nome as periodo, dp_turnos.grupo as horas, dp_turnos.entrada, dp_turnos.saida, grupos.grupo FROM dp_atrib_escola, dp_atrib_classifica, dp_motivos, dp_turnos, grupos WHERE dp_atrib_escola.funcionario = dp_atrib_classifica.funcid and dp_atrib_escola.grupo = grupos.id and dp_atrib_escola.motivo = dp_motivos.id and dp_atrib_escola.periodo = dp_turnos.id and dp_atrib_escola.status = 1 and dp_atrib_escola.local = ".$_SESSION["localsme"];
if ($hora < 2){
    $data .= " hora e ";
} else {
    $data .= " horas e ";
}
if ($min < 2 ){
    $data .= $min_ext." minuto, em uma dependência da ".utf8_encode($_SESSION["escola"]).", realizou-se a ";
} else {
    $data .= $min_ext." minutos, em uma dependência da ".utf8_encode($_SESSION["escola"]).", realizou-se a ";
}
$pdf = new PDF();
$pdf->AliasNbPages();
$title = 'Secretaria Municipal de Educação';
$title = iconv('UTF-8', 'ISO-8859-1', $title);
$pdf->SetTitle($title);
    //1ª etapa
    $titulo1 = iconv('UTF-8', 'ISO-8859-1', "ATA DE ATRIBUIÇÃO DE TURMAS E PERÍODOS 2016");
    $sub1 = $data."Atribuição de Turmas e Períodos, nos termos da Instrução nº 10/SME/2015, conforme segue:";
    $pdf->AddPage();
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetFillColor(250,250,250);
    $pdf->Cell(0,10,$titulo1,0,1,'C',true);
    $pdf->SetFont('Arial','B',11);
    $cabec1 = iconv('UTF-8', 'ISO-8859-1//IGNORE', $sub1);
    $pdf->MultiCell(0,5,$cabec1);
    $pdf->Ln();
            $cor = false;
            $pdf->SetFont('Arial','',7);     
            $pdf->SetFillColor(190,190,190);
            $pdf->Cell( 55, 6, 'Professor', 1, 0, 'C', true);            
            $pdf->Cell( 10, 6, iconv('utf-8','iso-8859-1','Class.'),1, 0, 'C', true);
            $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1','Jornada'),1, 0, 'C', true);
            $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1','Turma'),1, 0, 'C', true);
            $pdf->Cell( 30, 6, iconv('utf-8','iso-8859-1','Periodo'),1, 0, 'C', true);
            $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1','Afastado'),1, 0, 'C', true);
            $pdf->Cell( 28, 6, iconv('utf-8','iso-8859-1','Afastamento'),1, 0, 'C', true);
            $pdf->Cell( 30, 6, iconv('utf-8','iso-8859-1','Assinatura'),1, 0, 'C', true);
            $pdf->Ln(); // quebra de linha
                $pdf->SetFont('Arial','',7);
                $atrib1 = $con->query($sql." and dp_atrib_escola.grupo != 15 and dp_atrib_escola.funcionario > 0 order by horas, classifica ASC");
                foreach ($atrib1 as $row) {                                                 
                $pdf->Cell( 55, 6, limite($row["professor"], 34), 1, 0, 'L', $cor);            
                $pdf->Cell( 10, 6, iconv('utf-8','iso-8859-1',$row["classifica"]."º"),1, 0, 'C', $cor);
                $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1',$row["horas"]),1, 0, 'C', $cor);
                $pdf->Cell( 12, 6, limite(utf8_encode($row["grupo"]." ".$row["nome"]),10),1, 0, 'C', $cor);
                $pdf->Cell( 30, 6, iconv('utf-8','iso-8859-1',utf8_encode($row["periodo"]."(".$row["entrada"]."-".$row["saida"].")")),1, 0, 'L', $cor);
                if ($row["motivo"] == "Ativo"){ $sn = "Não"; $motivo ="";} else { $sn = "Sim"; $motivo = utf8_encode($row["motivo"]);}
                $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1',$sn),1, 0, 'C', $cor);
                $pdf->Cell( 28, 6, limite($motivo, 24),1, 0, 'L', $cor);
                $pdf->Cell( 30, 6, '',1, 0, 'C', $cor);
                $pdf->Ln(); // quebra de linha                
                $cor = !$cor; // inverte cor de fundo
                }
            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetFont('Arial','B',11);
            $pdf->Cell( 0, 10, iconv('utf-8','iso-8859-1','Coordenador Educacional'),0, 0, 'C', false);

            //2ª etapa
            $cor = false;
            $titulo2 = iconv('UTF-8', 'ISO-8859-1', utf8_encode($_SESSION["escola"]));
            $sub2 = $data."Atribuição dos professores adjuntos, nos termos da Instrução nº 10/SME/2015, conforme segue:";
            $pdf->AddPage();
            $pdf->SetDrawColor(0,0,0);
            $pdf->SetFillColor(250,250,250);
            $pdf->Cell(0,10,$titulo2,0,1,'C',true);
            $pdf->SetFont('Arial','B',11);
            $cabec2 = iconv('UTF-8', 'ISO-8859-1//IGNORE', $sub2);
            $pdf->MultiCell(0,5,$cabec2);
            $pdf->Ln();
                    $pdf->SetFont('Arial','',7);     
                    $pdf->SetFillColor(190,190,190);
                    $pdf->Cell( 55, 6, 'Professor', 1, 0, 'C', true);            
                    $pdf->Cell( 10, 6, iconv('utf-8','iso-8859-1','Class.'),1, 0, 'C', true);
                    $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1','Jornada'),1, 0, 'C', true);
                    $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1','Turma'),1, 0, 'C', true);
                    $pdf->Cell( 30, 6, iconv('utf-8','iso-8859-1','Periodo'),1, 0, 'C', true);
                    $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1','Afastado'),1, 0, 'C', true);
                    $pdf->Cell( 28, 6, iconv('utf-8','iso-8859-1','Afastamento'),1, 0, 'C', true);
                    $pdf->Cell( 30, 6, iconv('utf-8','iso-8859-1','Assinatura'),1, 0, 'C', true);
                    $pdf->Ln(); // quebra de linha
                    $pdf->SetFont('Arial','',7);
                        $atrib1 = $con->query($sql." and dp_atrib_escola.grupo = 15 and dp_atrib_escola.funcionario > 0 order by horas, classifica ASC");
                        foreach ($atrib1 as $row) {                                                 
                        $pdf->Cell( 55, 6, limite($row["professor"], 34), 1, 0, 'L', $cor);            
                        $pdf->Cell( 10, 6, iconv('utf-8','iso-8859-1',$row["classifica"]."º"),1, 0, 'C', $cor);
                        $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1',$row["horas"]),1, 0, 'C', $cor);
                        $pdf->Cell( 12, 6, limite(utf8_encode($row["grupo"]." ".$row["nome"]),10),1, 0, 'C', $cor);
                        $pdf->Cell( 30, 6, iconv('utf-8','iso-8859-1',utf8_encode($row["periodo"]."(".$row["entrada"]."-".$row["saida"].")")),1, 0, 'L', $cor);
                        if ($row["motivo"] == "Ativo"){ $sn = "Não"; $motivo ="";} else { $sn = "Sim"; $motivo = utf8_encode($row["motivo"]);}
                        $pdf->Cell( 12, 6, iconv('utf-8','iso-8859-1',$sn),1, 0, 'C', $cor);
                        $pdf->Cell( 28, 6, limite($motivo, 24),1, 0, 'L', $cor);
                        $pdf->Cell( 30, 6, '',1, 0, 'C', $cor);
                        $pdf->Ln(); // quebra de linha                
                        $cor = !$cor; // inverte cor de fundo
                        }
                    $pdf->Ln();
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Cell( 0, 10, iconv('utf-8','iso-8859-1','Coordenador Educacional'),0, 0, 'C', false);

            //3ª etapa
            $cor = false;
            $titulo3 = iconv('UTF-8', 'ISO-8859-1', utf8_encode($_SESSION["escola"]));
            $sub3 = "Relatório da turmas / períodos livres para serem atribuidos em 2016, em nível de Secretaria Municipal de Educação, conforme segue:";
            $pdf->AddPage();
            $pdf->SetDrawColor(0,0,0);
            $pdf->SetFillColor(250,250,250);
            $pdf->Cell(0,10,$titulo3,0,1,'C',true);
            $pdf->SetFont('Arial','B',11);
            $cabec3 = iconv('UTF-8', 'ISO-8859-1//IGNORE', $sub3);
            $pdf->MultiCell(0,5,$cabec3);
            $pdf->Ln();
                    $pdf->SetFont('Arial','',7);     
                    $pdf->SetFillColor(190,190,190);
                    $pdf->Cell( 60, 6, 'Turma', 1, 0, 'C', true);            
                    $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1','Periodo.'),1, 0, 'C', true);
                    $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1','Jornada'),1, 0, 'C', true);                    
                    $pdf->Ln(); // quebra de linha
                    $pdf->SetFont('Arial','',7);
                        $atrib1 = $con->query($sql." and dp_atrib_escola.funcionario = 0");
                        foreach ($atrib1 as $row) {                                                 
                        $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1',utf8_encode($row["grupo"]." ".$row["nome"])), 1, 0, 'L', $cor);            
                        $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1',utf8_encode($row["periodo"]."(".$row["entrada"]."-".$row["saida"].")")),1, 0, 'C', $cor);
                        $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1',$row["horas"]),1, 0, 'C', $cor);                        
                        $pdf->Ln(); // quebra de linha                
                        $cor = !$cor; // inverte cor de fundo
                        }
                    $pdf->Ln();
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Cell( 0, 10, iconv('utf-8','iso-8859-1','Coordenador Educacional'),0, 0, 'C', false);
            //4ª etapa
            $cor = false;
            $titulo3 = iconv('UTF-8', 'ISO-8859-1', utf8_encode($_SESSION["escola"]));
            $sub3 = "Relatório da turmas / períodos em substituição para serem atribuidos em 2016, em nível de Secretaria Municipal de Educação, conforme segue:";
            $pdf->AddPage();
            $pdf->SetDrawColor(0,0,0);
            $pdf->SetFillColor(250,250,250);
            $pdf->Cell(0,10,$titulo3,0,1,'C',true);
            $pdf->SetFont('Arial','B',11);
            $cabec3 = iconv('UTF-8', 'ISO-8859-1//IGNORE', $sub3);
            $pdf->MultiCell(0,5,$cabec3);
            $pdf->Ln();
                    $pdf->SetFont('Arial','',7);     
                    $pdf->SetFillColor(190,190,190);
                    $pdf->Cell( 60, 6, 'Turma', 1, 0, 'C', true);            
                    $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1','Periodo.'),1, 0, 'C', true);
                    $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1','Jornada'),1, 0, 'C', true);                    
                    $pdf->Ln(); // quebra de linha
                    $pdf->SetFont('Arial','',7);
                        $atrib1 = $con->query($sql." and dp_atrib_escola.funcionario > 0 and dp_atrib_escola.motivo > 1");
                        foreach ($atrib1 as $row) {                                                 
                        $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1',utf8_encode($row["grupo"]." ".$row["nome"])), 1, 0, 'L', $cor);            
                        $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1',utf8_encode($row["periodo"]."(".$row["entrada"]."-".$row["saida"].")")),1, 0, 'C', $cor);
                        $pdf->Cell( 60, 6, iconv('utf-8','iso-8859-1',$row["horas"]),1, 0, 'C', $cor);                        
                        $pdf->Ln(); // quebra de linha                
                        $cor = !$cor; // inverte cor de fundo
                        }
                    $pdf->Ln();
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Cell( 0, 10, iconv('utf-8','iso-8859-1','Coordenador Educacional'),0, 0, 'C', false);
$pdf->Output();
?>
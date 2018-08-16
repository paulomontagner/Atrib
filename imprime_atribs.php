<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
include_once("estrutura/base.php");
$sql0 = "select nome from funcionarios where codmatricula = ".$_GET['docente'].";";
$professor = mysql_query($sql0, $conexao);
$linha0 = mysql_fetch_assoc($professor);
$sql = "SELECT t.id, l.nome, g.grupo, 
CONCAT(p.entrada, '-', p.saida) as periodo, 
concat(h.dia, ' ', h.inicio, '-', h.fim) as htpc, 
t.titular, f.nome as nome_suplente,(select nome from funcionarios where codmatricula = t.titular) as nome_titular, t.afastamento, m.nome as motivo, t.hora_atrib 
FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s, funcionarios f 
WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.suplente = f.codmatricula and t.id = ".$_GET['turma'].";";
$turma = mysql_query($sql, $conexao);
$linha = mysql_fetch_assoc($turma);
if ($linha['titular'] == $_GET['docente']){
	$titular = 'Livre';
	$motivo = '';
} else {
	$titular = $linha['nome_titular'];
	$motivo = $linha['motivo'];
}
$cab = '
<html>
<style>
TD
{
	padding:3px;
	font:11px verdana;
	color:#333;
	/*background-color:#f9f9f9;*/
}
</style>
<body>';
$parte = '
<div>
    <h2 align="center">
        SECRETARIA MUNICIPAL DE EDUCA&Ccedil;&Atilde;O DE SUZANO
  </h2>
    <h3 align="center">
        ENCAMINHAMENTO DE FUNCION&Aacute;RIO &Agrave; UNIDADE ESCOLAR
    </h3>
    <h4 align="center">
        DADOS DO FUNCION&Aacute;RIO
    </h4>
  <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td valign="top" width="130">
                    <p><strong>Nome Servidor:</strong></p>
                </td>
                <td valign="top" width="220">
                    <p>'.$linha0['nome'].'</p>
                </td>
                <td valign="top" width="190"><p>
                        <strong>Matr&iacute;cula:</strong>
                    </p></td>
                <td width="92">'.$_GET['docente'].'</td>
            </tr>
  </tbody>
  </table>
    <h4 align="center">
    DADOS DA ATRIBUI&Ccedil;&Atilde;O </h4>
  <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tbody>
		     <tr>
                <td valign="top" width="130">
                
                        <strong>Professor Titular:</strong>
               
              </td>
                <td valign="top" width="220">'.$linha['nome_titular'].'</td>
              <td valign="top">
                        <strong>Motivo:</strong>
              </td>
                <td>'.$linha['motivo'].'</td>
            </tr>
            <tr>
                <td valign="top" width="130">
                
                        <strong>Unidade Escolar:</strong>
               
              </td>
                <td valign="top" width="220">'.$linha['nome'].'</td>
              <td valign="top">
                        <strong>HTPC:</strong>
              </td>
                <td>'.$linha['htpc'].'</td>
            </tr>
            <tr>
                <td valign="top" width="130">
                    
                        <strong>Turma:</strong>
                   
              </td>
                <td valign="top" width="220">'.$linha['grupo'].'</td>
                <td valign="top" width="190">
                  
                        <strong>Hor&aacute;rio:</strong>
                  
              </td>
                <td valign="top" width="92">'.$linha['periodo'].'</td>
            </tr>
            <tr>
                <td valign="top" width="130">
                 
                        <strong>Titular:</strong>
              
              </td>
                <td valign="top" width="220">'.$titular.'</td>
                <td valign="top" width="190">
                 
                        <strong>Motivo Afastamento:</strong>
                
              </td>
                <td valign="top" width="92">'.$motivo.'
                </td>
            </tr>
    </tbody>
  </table></div>
    <p align="center">
      O Servidor acima, ao fazer a escolha, declara estar ciente do hor&aacute;rio de HTPC a ser cumprido na nova unidade escolar.
    </p>
    <p align="center">
        Este documento dever&aacute; ser apresentado na nova Unidade Escolar no primeiro dia &uacute;til ap&oacute;s a atribui&ccedil;&atilde;o.
    </p>
<table width="100%">
<tr>
<td width="50%"><hr align="center" width="200"></td>
<td width="50%"><hr align="center" width="200"></td>
</tr>
<tr>
<td width="50%" align="center">Assinatura do servidor</td>
<td width="50%" align="center">Funcion&aacute;rio RH</td>
</tr>
<tr><td colspan="2" style="border-top:solid;" align="right"><font size="-1">S&eacute;rie/Grupo atribuido em '.date('d/m/Y H:i', strtotime($linha['hora_atrib'])).'</font></td></tr></table>
';
$html = $cab.$parte.$parte;
define('MPDF_PATH', 'mpdf/');
include(MPDF_PATH.'mpdf.php');
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
exit();
?>
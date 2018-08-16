<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
include_once("estrutura/base.php");
$sql = "SELECT * from view_imprime where id = ".$_GET['id'].";";
$turma = mysql_query($sql, $conexao);
$linha = mysql_fetch_assoc($turma);
if ($linha['titular'] == $_GET['docente']){
	$nome = $linha['nome_titular'];
	$mat = $linha['titular'];
	$titular = 'Livre';
	$motivo = '';
	$suplente = 'Livre';
} else {
	if ($linha['suplente'] == $_GET['docente']){
	$nome = $linha['nome_suplente'];
	$mat = $linha['suplente'];	
	$titular = $linha['nome_titular'];
	$motivo = $linha['motivo'];
	$suplente = 'Livre';
	} else {
	$nome = $linha['nome_2suplente'];
	$mat = $linha['2suplente'];	
	$titular = $linha['nome_titular'];
	$motivo = $linha['motivo'];
	$suplente = $linha['nome_suplente'];	
	}
}
?>
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
<body>
<table width="100%">
<tr>
<td colspan="4">
    <h2 align="center">
        SECRETARIA MUNICIPAL DE EDUCA&Ccedil;&Atilde;O DE SUZANO
  </h2>
  </td></tr>
  <tr>
  <td colspan="4">
    <h3 align="center">
        ENCAMINHAMENTO DE FUNCION&Aacute;RIO &Agrave; UNIDADE ESCOLAR
    </h3>
    </td></tr>
    <tr>
    <td colspan="4">
    <h4 align="center">
        DADOS DO FUNCION&Aacute;RIO
    </h4>
    </td></tr>
            <tr>
                <td valign="top" width="130">
                    <p><strong>Nome Servidor:</strong></p>
                </td>
                <td valign="top" width="220">
                    <p><?php echo $nome;?></p>
                </td>
                <td valign="top" width="190"><p>
                        <strong>Matr&iacute;cula:</strong>
                    </p></td>
                <td width="92"><?php echo $mat;?></td>
            </tr>
<tr><td colspan="4">    <h4 align="center">
    DADOS DA ATRIBUI&Ccedil;&Atilde;O </h4></td>
            <tr>
                <td valign="top" width="130">
                
                        <strong>Unidade Escolar:</strong>
               
              </td>
                <td valign="top" width="220"><?php echo $linha['nome'];?></td>
              <td valign="top">
                        <strong>HTPC:</strong>
              </td>
                <td><?php echo $linha['htpc'];?></td>
            </tr>
            <tr>
                <td valign="top" width="130">
                    
                        <strong>Turma:</strong>
                   
              </td>
                <td valign="top" width="220"><?php echo $linha['grupo'];?></td>
                <td valign="top" width="190">
                  
                        <strong>Hor&aacute;rio:</strong>
                  
              </td>
                <td valign="top" width="92"><?php echo $linha['periodo'];?></td>
            </tr>
            <tr>
                <td valign="top" width="130">
                 
                        <strong>Titular:</strong>
              
              </td>
                <td valign="top" width="220"><?php echo $titular;?></td>
                <td valign="top" width="190">
                 
                        <strong>Motivo Afastamento:</strong>
                
              </td>
                <td valign="top" width="92"><?php echo $motivo;?>
                </td>
            </tr>
                        <tr>
                <td valign="top" width="130">
                 
                        <strong>Suplente:</strong>
              
              </td>
                <td valign="top" width="220"><?php echo $suplente;?></td>
                <td valign="top" width="190">
                 
                        <strong>Motivo Afastamento:</strong>
                
              </td>
                <td valign="top" width="92">
                </td>
            </tr>
<tr><td colspan="4">
    <p align="center">
      O Servidor acima, ao fazer a escolha, declara estar ciente do hor&aacute;rio de HTPC a ser cumprido na nova unidade escolar.
    </p>
    <p align="center">
        Este documento dever&aacute; ser apresentado na nova Unidade Escolar no primeiro dia &uacute;til ap&oacute;s a atribui&ccedil;&atilde;o.
    </p>
</td></tr>
<tr>
<td colspan="2" width="50%"><hr align="center" width="200"></td>
<td colspan="2" width="50%"><hr align="center" width="200"></td>
</tr>
<tr>
<td colspan="2" width="50%" align="center">Assinatura do servidor</td>
<td colspan="2" width="50%" align="center">Funcion&aacute;rio RH</td>
</tr>
<tr><td colspan="4" style="border-top:solid;" align="right"><font size="-1">S&eacute;rie/Grupo atribuido em 05/12/2014 15:38</font></td></tr></table>

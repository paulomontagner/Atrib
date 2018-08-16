<?php
include_once("estrutura/base.php");
$tipo = ($_REQUEST['tipo'] == "") ? '' : " and p.horasdia = ".$_REQUEST['tipo'];
$local = ($_REQUEST['local'] == "") ? '' : " and t.local = ".$_REQUEST['local'];
$status = ($_REQUEST['status'] == "") ? '' : " and t.status = ".$_REQUEST['status'];
$grupo = ($_REQUEST['grupo'] == "") ? '' : " and t.grupo = ".$_REQUEST['grupo'];
$sql = "SELECT t.id, l.nome, g.grupo, CONCAT(p.grupo,'-', p.nome, '(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, (select f.nome from funcionarios f where f.codmatricula = t.titular) as nome_titular, t.afastamento, m.nome as motivo_afast, t.suplente, (select f.nome from funcionarios f where f.codmatricula = t.suplente) as nome_suplente,(select f.nome from funcionarios f where f.codmatricula = t.2suplente) as nome_2suplente, s.nome as status, t.educ_fisica, (select sum(s.a)+sum(s.b)+sum(s.c)+sum(s.d)+sum(s.e) from subturmas s where s.turma = t.id) as aulas, (select sum(s.docencia)from subturmas s where s.turma = t.id) as docencia FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id".$local.$tipo.$status.$grupo." and t.mostra = 1 order by l.nome ;";
//echo $sql;
$turma = mysql_query($sql, $conexao);
$qturma = mysql_num_rows($turma);
?>	
<a href='relatorios/turmas_geral_pdf.php?local=<?php echo $local; ?>&tipo=<?php echo $tipo; ?>&status=<?php echo $status; ?>&grupo=<?php echo $grupo; ?>' target='_blank'>Exportar para PDF<img src="imagens/pdf.gif" /></a>
<a href='relatorios/turmas_geral_xls.php?local=<?php echo $local; ?>&tipo=<?php echo $tipo; ?>&status=<?php echo $status; ?>&grupo=<?php echo $grupo; ?>' target='_blank'>Exportar para Excel<img src="imagens/xls.png" /></a>
<table width="100%" id="tb1">
			<tr>
              <th>C&oacute;digo</th>
			  <th>Turma</th>
			  <th>Atribui&ccedil;&atilde;o</th>
			  <th>Status</th>
			</tr>
			<?php 
			
			for($i=0; $i<$qturma; $i++)
			{?>
			<tr>
                <td align="center">
                <?php echo utf8_encode(mysql_result($turma, $i, 'id'));?></td>
				<td align="left">
                  <b>Escola:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome'));?><br />
				  <b>Grupo:</b><?php echo utf8_encode(mysql_result($turma, $i, 'grupo'));?><br />
                  <b>Periodo:</b><?php echo utf8_encode(mysql_result($turma, $i, 'periodo'));?><br />
                  <b>HTPC:</b><?php echo utf8_encode(mysql_result($turma, $i, 'htpc'));?>
            </td>
				<td align="left">
					<b>Titular:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome_titular'));?><br />
                     <?php if (mysql_result($turma, $i, 'afastamento') > 0 ){?>
                     <b>Afastamento:</b><?php echo utf8_encode(mysql_result($turma, $i, 'motivo_afast'));?><br />
                     <b>1&deg;Suplente:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome_suplente'));?><br />
                     <b>2&deg;Suplente:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome_2suplente'));?><br />
					 <?php } ?>						
              </td>
				<td align="left">
					<b>Status:</b><?php echo utf8_encode(mysql_result($turma, $i, 'status'));?><br />
                    <b>Turmas:</b><?php echo utf8_encode(mysql_result($turma, $i, 'aulas'));?><br />
                    <b>horas docência:</b><?php echo utf8_encode(mysql_result($turma, $i, 'docencia'));?>
		      </td>
			</tr>
			<?php } mysql_close($conexao);	?>
	  </table>
<div id="subturma"></div>      	
<div id="pageNav"></div>
    <script>
        var pager = new Pager('tb1', 10); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNav'); 
        pager.showPage(1);
    </script>

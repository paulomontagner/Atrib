<?php
include_once("estrutura/base.php");
$qual = $_GET['id'];
if ($qual == '-1'){
	$t = '>= 0'; } else {
	$t = '= '.$qual;
	}
$turma = mysql_query("SELECT t.id, l.nome, g.grupo, CONCAT(p.grupo,'-', p.nome, '(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, (select f.nome from funcionarios f where f.codmatricula = t.titular) as nome_titular, t.afastamento, m.nome as motivo_afast, t.suplente, (select f.nome from funcionarios f where f.codmatricula = t.suplente) as nome_suplente, s.nome as status, t.educ_fisica, (select sum(s.a)+sum(s.b)+sum(s.c)+sum(s.d)+sum(s.e) from subturmas s where s.turma = t.id) as aulas, (select sum(s.docencia)from subturmas s where s.turma = t.id) as docencia, t.2suplente  FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local ".$t." and t.mostra = 1;", $conexao);
$qturma = mysql_num_rows($turma);
?>	
<p class="titulo">Lista de atribuições</p>
<table width="100%" id="tb1">
			<tr>
              <th>C&oacute;digo</th>
			  <th>Turma</th>
			  <th>Atribui&ccedil;&atilde;o</th>
			  <th>Status</th>
			  
			  <th colspan="3"><a href='cadastra_local.php?opera=0&id=0&local=<?php echo $_GET['id']; ?>' onclick='ajaxGo({url: this.href, elem_return: "resultado", loading: "Carre<b>gando</b>", timeout: 4}); return false;'>Nova atribui&ccedil;&atilde;o</a>
			  <a href='relatorios/rel_turmas_pdf.php?local=<?php echo $_GET['id']; ?>' target='_blank'><img src="imagens/pdf.gif" /></a>
              <a href='relatorios/rel_turmas_xls.php?local=<?php echo $_GET['id']; ?>' target='_blank'><img src="imagens/xls.png" /></a>
			  </th>
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
                     <b>Suplente:</b><?php echo utf8_encode(mysql_result($turma, $i, 'nome_suplente'));?><br />
					 <?php } ?>	
                    <?php if (mysql_result($turma, $i, '2suplente') < 99999 ){
					$ssuplencia = mysql_query("SELECT nome FROM funcionarios WHERE codmatricula = ".mysql_result($turma, $i, '2suplente').";", $conexao); ?>
					<b>2º Suplente:</b><?php echo utf8_encode(mysql_result($ssuplencia, 0, nome));?>
					<?php 
					}	
					?>					 
              </td>
				<td align="left">
					<b>Status:</b><?php echo utf8_encode(mysql_result($turma, $i, 'status'));?><br />
                    <b>Turmas:</b><?php echo utf8_encode(mysql_result($turma, $i, 'aulas'));?><br />
                    <b>horas docência:</b><?php echo utf8_encode(mysql_result($turma, $i, 'docencia'));?>
		      </td>
				<td align="center">
					<a href="cadastra_local.php?id=<?php echo mysql_result($turma, $i, id);?>&local=<?php echo $_GET['id']; ?>&opera=1" onclick='ajaxGo({url: this.href, elem_return: "resultado", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/edit.png" alt="Editar" /> </a></td><td>
                    <a href="insert_turma.php?opera=2&id=<?php echo mysql_result($turma, $i, id);?>" onclick='ajaxGo({url: this.href, elem_return: "resultado", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/delete.png" alt="Excluir" /></a>
					</td><td>
                    <?php if(mysql_result($turma, $i, educ_fisica) == 1) { ?>
                    <a href="sub_turma.php?id=<?php echo mysql_result($turma, $i, id);?>&local=<?php echo $_GET['id']; ?>" onclick='ajaxGo({url: this.href, elem_return: "subturma", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/People.png" alt="Cadastro de subgrupos" /></a>
						<?php }?>
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



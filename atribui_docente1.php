<?php
include_once("estrutura/base.php");
$tipo = $_GET['tipo'];
$titular = mysql_query("select * from form_atrib where titular = ". $_GET['matricula'].";", $conexao);
$qtitular = mysql_num_rows($titular);
$linha1 = mysql_fetch_assoc($titular);
$suplente = mysql_query("select * from form_atrib where suplente = ". $_GET['matricula'].";", $conexao);
$qsuplente = mysql_num_rows($suplente);
$linha2 = mysql_fetch_assoc($suplente);
$suplente1 = mysql_query("select * from form_atrib where 2suplente = ". $_GET['matricula'].";", $conexao);
$qsuplente1 = mysql_num_rows($suplente1);
$linha4 = mysql_fetch_assoc($suplente1);
$professor = mysql_query("SELECT c.*, f.nome from classifica_professor c, funcionarios f where c.matricula = f.codmatricula and c.id = ". $_GET['id']." order by f.nome", $conexao);
$qprofessor = mysql_num_rows($professor);
$linha = mysql_fetch_assoc($professor);
$id_docente = $_GET['id'];
?>
<p class="titulo">Atribui&ccedil;&atilde;o de docente</p>
<table width="100%">	
<tr>
  <th>Matricula</th>
  <th>Nome</th>
  <th>Classifica&ccedil;&atilde;o</th>
  <th>Pontos</th>
  <th colspan="2">A&ccedil;&atilde;o</th>
</tr>
<?php
if($qprofessor > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
$matricula = $linha['matricula'];	
echo "<tr><td align='center'>".$matricula."</td>";
echo "<td align='center'>".$linha['nome']."</td>";
echo "<td align='center'>".$linha['Classifica']."&ordm;</td>";
echo "<td align='center'>".$linha['pontos']."</td>";
?>
<td align="center"><a href="classifica_docente.php?tipo=<?php echo $linha['tipo']; ?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/Turn off.png" alt="Encerrar" /></a></td>
<td align="center"><?php if(($linha['tipo'] == 7) or ($linha["tipo"] == 11)){ ?><a href="imprime_ef.php?matricula=<?php echo $matricula ;?>&id=<?php echo $linha['id'];?>" target="_blank"><img src="imagens/img/Print.png" alt="Imprimir" /></a><a href="#" onclick="janela('painelef.php?tipo=<?php echo $tipo ;?>&matricula=<?php echo $matricula ;?>&id=<?php echo $linha['id'];?>','Turmas')"><img src="imagens/img/Find.png" /></a><?php } else { ?><a href="#" onclick="janela('painel3.php?tipo=<?php echo $tipo ;?>&matricula=<?php echo $matricula ;?>&id=<?php echo $linha['id'];?>','Turmas')"><img src="imagens/img/Find.png" /></a><?php } ?></td>
</tr>
<?php
// finaliza o loop que vai mostrar os dados
		}while($linha = mysql_fetch_assoc($professor));
	// fim do if 
	}
?>
</table>
<table width="100%">
<tr>
  <th>Turma</th>
  <th>Escola</th>
  <th>Grupo</th>
  <th>Periodo</th>
  <th colspan="2">HTPC</th>
  <th>Atribui&ccedil;&atilde;o</th>
  <th colspan="2">A&ccedil;&atilde;o</th>
</tr> 
<?php
if($qtitular > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
echo "<tr><td align='center'>".utf8_encode($linha1['id'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['nome'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['grupo'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['periodo'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['nome_htpc'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['htpc'])."</td>";
echo "<td align='center'>Tilular</td>";
?>
<td align="center"><a href="atribui_turma.php?tipo=2&turma=<?php echo $linha1['id'];?>&docente=<?php echo $matricula ;?>&id_docente=<?php echo $id_docente ;?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/cancel.png" alt="Cancelar" /></a></td><td align="center"><a href="imprime_atribui1.php?turma=<?php echo $linha1['id'];?>&docente=<?php echo $matricula ;?>" target="_blank"><img src="imagens/img/Print.png" alt="Imprimir" /></a></td></tr>
<?php
$detalhe = mysql_query("SELECT s.*, l.nome, CONCAT(p.entrada, ' - ', p.saida) as nome_periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as nome_htpc
FROM subturmas s, locais l, periodo p, htpc h
WHERE s.local = l.id and s.periodo = p.id and s.htpc = h.id and turma = ".$linha1['id'].";", $conexao);
$qdetalhe = mysql_num_rows($detalhe);
$linha3 = mysql_fetch_assoc($detalhe);
if($qdetalhe > 0) { ?>
<tr>
<td colspan="8">
<table width="100%">
<tr>
<th>Local</th>
<th>Periodo</th>
<th>1&ordm; ano</th>
<th>2&ordm; ano</th>
<th>3&ordm; ano</th>
<th>4&ordm; ano</th>
<th>5&ordm; ano</th>
<th>Doc&ecirc;ncia</th>
<th>HTPC</th>
</tr>
<?php		
do {
echo "<tr><td>".$linha3['nome'];?>
<a href="atribui_turma.php?tipo=4&turma=<?php echo $linha3['turma'];?>&local=<?php echo $linha3['local'];?>&id_docente=<?php echo $id_docente ;?>&docente=<?php echo $matricula ;?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/Good mark.png" alt="Fixar local" /></a><?php 
echo "</td><td align='center'>".$linha3['nome_periodo']."</td>";
echo "<td align='center'>".$linha3['a']."</td>";
echo "<td align='center'>".$linha3['b']."</td>";
echo "<td align='center'>".$linha3['c']."</td>";
echo "<td align='center'>".$linha3['d']."</td>";
echo "<td align='center'>".$linha3['e']."</td>";
echo "<td align='center'>".$linha3['docencia']."</td>";
echo "<td align='center'>".$linha3['nome_htpc'];?>
<a href="atribui_turma.php?tipo=5&local=<?php echo $linha3['local'];?>&turma=<?php echo $linha3['turma'];?>&htpc=<?php echo $linha3['htpc'];?>&id_docente=<?php echo $id_docente ;?>&docente=<?php echo $matricula ;?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/Good mark.png" alt="Fixar local" /></a>
<?php echo "</td><tr>";
	}while($linha3 = mysql_fetch_assoc($detalhe));
echo "</table></td></tr>";	
	// fim do if 
	}

// finaliza o loop que vai mostrar os dados
		}while($linha1 = mysql_fetch_assoc($titular));
	// fim do if 
	} else { ?>
		<tr><td colspan="8" align="center">Sem atribuições como titular</td></tr>
<?php } ?>
<?php
if($qsuplente > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
echo "<tr><td align='center'>".utf8_encode($linha2['id'])."</td>";
echo "<td align='center'>".utf8_encode($linha2['nome'])."</td>";
echo "<td align='center'>".utf8_encode($linha2['grupo'])."</td>";
echo "<td align='center'>".utf8_encode($linha2['periodo'])."</td>";
echo "<td align='center'>".utf8_encode($linha2['htpc'])."</td>";
echo "<td align='center'>Suplente</td>";
?>
<td align="center"><a href="atribui_turma.php?tipo=3&turma=<?php echo $linha2['id'];?>&docente=<?php echo $matricula ;?>&id_docente=<?php echo $id_docente ;?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/cancel.png" alt="Cancelar" />
</a>&nbsp;<a href="atribui_turma.php?tipo=8&turma=<?php echo $linha2['id'];?>&docente=<?php echo $matricula ;?>&id_docente=<?php echo $id_docente ;?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/User group.png" alt="Abrir terceira atribui&ccedil;&atilde;o" /></a></td><td align="center"><a href="imprime_atribui1.php?turma=<?php echo $linha2['id'];?>&docente=<?php echo $matricula ;?>" target="_blank"><img src="imagens/img/Print.png" alt="Imprimir" /></a>
</td></tr>
<?php
// finaliza o loop que vai mostrar os dados
		}while($linha1 = mysql_fetch_assoc($suplente));
	// fim do if 
	} else { ?>
		<tr><td colspan="8" align="center">Sem atribuições como suplente</td></tr>
<?php } ?>
<?php
if($qsuplente1 > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
echo "<tr><td align='center'>".utf8_encode($linha4['id'])."</td>";
echo "<td align='center'>".utf8_encode($linha4['nome'])."</td>";
echo "<td align='center'>".utf8_encode($linha4['grupo'])."</td>";
echo "<td align='center'>".utf8_encode($linha4['periodo'])."</td>";
echo "<td align='center'>".utf8_encode($linha4['htpc'])."</td>";
echo "<td align='center'>Suplente</td>";
?>
<td align="center"><a href="atribui_turma.php?tipo=7&turma=<?php echo $linha4['id'];?>&docente=<?php echo $matricula ;?>&id_docente=<?php echo $id_docente ;?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/cancel.png" alt="Cancelar" />
</a></td><td align="center"><a href="imprime_atribui1.php?turma=<?php echo $linha4['id'];?>&docente=<?php echo $matricula ;?>" target="_blank"><img src="imagens/img/Print.png" alt="Imprimir" /></a>
</td></tr>
<?php
// finaliza o loop que vai mostrar os dados
		}while($linha4 = mysql_fetch_assoc($suplente1));
	// fim do if 
	} else { ?>
		<tr><td colspan="8" align="center">Sem atribuições como 2 &deg;suplente</td></tr>
<?php } ?>
</table>
<?php mysql_close($conexao);	 ?>

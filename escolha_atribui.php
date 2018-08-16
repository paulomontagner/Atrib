<?php
include_once("estrutura/base.php");
$turmas = mysql_query("SELECT t.id, l.nome, g.grupo, CONCAT(p.grupo,'-', p.nome, '(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, t.afastamento, m.nome as motivo, t.suplente FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.status = 1 and mostra = 1;", $conexao);
$qturmas = mysql_num_rows($turmas);
$linha1 = mysql_fetch_assoc($turmas);
$professor = mysql_query("SELECT c.*, f.nome from classifica_professor c, funcionarios f where c.matricula = f.codmatricula and c.id = ". $_GET['id']." order by f.nome", $conexao);
$qprofessor = mysql_num_rows($professor);
$linha = mysql_fetch_assoc($professor);
?>	
<p class="titulo">Atribui&ccedil;&atilde;o de docente</p>
<table width="100%">	
<tr>
  <th>Matricula</th>
  <th>Nome</th>
  <th>CPF</th>
  <th>Pontos</th>
  <th>A&ccedil;&atilde;o</th>
</tr>
<?php
if($qprofessor > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
echo "<tr><td align='center'>".$linha['matricula']."</td>";
echo "<td align='center'>".$linha['nome']."</td>";
echo "<td align='center'>".$linha['cpf']."</td>";
echo "<td align='center'>".$linha['pontos']."</td>";
?>
<td><a href="classifica_docente.php?tipo=<?php echo $linha['tipo']; ?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/Turn off.png" alt="Encerrar" /></a></td></tr>
<?php
// finaliza o loop que vai mostrar os dados
		}while($linha = mysql_fetch_assoc($turmas));
	// fim do if 
	}
?>
</table>

<table width="100%" id="tb1">
<tr>
  <th>Escola</th>
  <th>Grupo</th>
  <th>Periodo</th>
  <th>HTPC</th>
  <th>Atribui&ccedil;&atilde;o</th>
  <th>A&ccedil;&atilde;o</th>
</tr> 
<?php
if($qturmas > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
echo "<tr><td align='center'>".$linha1['nome']."</td>";
echo "<td align='center'>".$linha1['grupo']."</td>";
echo "<td align='center'>".$linha1['periodo']."</td>";
echo "<td align='center'>".$linha1['htpc']."</td>";
if ($linha1['titular'] == $linha['matricula']){
	echo "<td align='center'>Tilular</td>";} else {
	echo "<td align='center'>Suplente</td>";}	
?>
<td><a href="classifica_docente.php?tipo=<?php echo $linha['id']; ?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/Turn off.png" alt="Encerrar" /></a></td></tr>
<?php
// finaliza o loop que vai mostrar os dados
		}while($linha1 = mysql_fetch_assoc($turmas));
	// fim do if 
	} else { ?>
		<tr><td colspan="6" align="center">Sem atribuições até o momento</td></tr>
<?php } ?>
</table>
<?php mysql_close($conexao);	 ?>
<div id="pageNav"></div>
    <script>
        var pager = new Pager('tb1', 10); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNav'); 
        pager.showPage(1);
    </script>



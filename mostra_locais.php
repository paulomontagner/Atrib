<?php
include_once("estrutura/base.php");
$sql = "SELECT t.id, t.local, l.nome, g.grupo, CONCAT(p.grupo,'-', p.nome, '(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, t.afastamento, m.nome as motivo, t.suplente FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.status = 0 and t.local = l.id and ".$_POST['campo']." = ".$_POST['valor']." order by ".$_POST['ordenar'].";";
$turmas = mysql_query($sql, $conexao);
$qturmas = mysql_num_rows($turmas);
$linha1 = mysql_fetch_assoc($turmas);
?>
<div id="message"></div>
<table width="100%" id="tb1">
<tr>
  <th>Turma</th>
  <th>Escola</th>
  <th>Grupo</th>
  <th>Periodo</th>
  <th>HTPC</th>
  <th>Atribui&ccedil;&atilde;o</th>
  <th colspan="2">A&ccedil;&atilde;o</th>
</tr> 
<?php
if($qturmas > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
echo "<tr><td align='center'>"; ?>
<a href="carrega_detalhe.php?tipo=1&detalhe=<?php echo $linha1['id'];?>" onclick='ajaxGo({url: this.href, elem_return: "message", loading: "Carre<b>gando</b>", timeout: 4}); return false;'>
<?php echo utf8_encode($linha1['id'])."</a></td>";?>
<td align='center'><a href="carrega_detalhe.php?tipo=0&detalhe=<?php echo $linha1['local'];?>" onclick='ajaxGo({url: this.href, elem_return: "message", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><?php echo utf8_encode($linha1['nome'])."</a></td>";
echo "<td align='center'>".utf8_encode($linha1['grupo'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['periodo'])."</td>";
echo "<td align='center'>".utf8_encode($linha1['htpc'])."</td>";
if ($linha1['titular'] == '99999'){?>
<td align='center'>Sala livre</td>
<td><a href="atribui_turma.php?tipo=0&turma=<?php echo $linha1['id'];?>&docente=<?php echo $_POST['docente'];?>&id_docente=<?php echo $_POST['id_docente'];?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/ok.png" alt="Encerrar" /></td></a></tr>
<?php } else { ?>
<td align='center'>Sala em suplementa&ccedil;&auml;o</td>
<td><a href="atribui_turma.php?tipo=1&turma=<?php echo $linha1['id'];?>&docente=<?php echo $_POST['docente'];?>&id_docente=<?php echo $_POST['id_docente'];?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/ok.png" alt="Atribuir" /></a></td><td></td></tr>
<?php 
}
// finaliza o loop que vai mostrar os dados
		}while($linha1 = mysql_fetch_assoc($turmas));
	// fim do if 
	} else { ?>
		<tr><td colspan="6" align="center">Sem turmas para mostrar</td></tr>
<?php } ?>
<?php mysql_close($conexao);	 ?>
<div id="pageNav"></div>
    <script>
        var pager = new Pager('tb1', 10); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNav'); 
        pager.showPage(1);
    </script>



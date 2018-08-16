<p class="titulo">Listando Professores 
</p>
<?php
include_once("estrutura/base.php");
$sql = "SELECT c.* , f.nome FROM classifica_professor c, funcionarios f WHERE c.matricula = f.codmatricula AND c.matricula = ".$_REQUEST['matricula']." ORDER BY classifica;";
$prof = mysql_query($sql, $conexao);
$qprof = mysql_num_rows($prof);
$linha = mysql_fetch_assoc($prof);
?>
<table width="100%" id="tb1">
<tr>
	<th>Classifica&ccedil;&atilde;o</th>
    <th>Professor</th>
	<th>CPF</th>
	<th>Pontua&ccedil;&atilde;o</th>
    <th>A&ccedil;&otilde;es</th>
</tr>
<?php
if($qprof > 0) {
		// inicia o loop que vai mostrar todos os dados
do {
echo "<tr><td>".$linha['Classifica']."</td>";
echo "<td>".utf8_encode($linha['nome'])."</td>";
echo "<td align='center'>".$linha['cpf']."</td>";
echo "<td align='center'>".$linha['pontos']."</td>";
?>
<td><a href="atribui_docente1.php?id=<?php echo $linha['id']; ?>&matricula=<?php echo $linha['matricula']; ?>&tipo=<?php echo $pagina; ?>" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/Blue tag.png" alt="Editar" /></a>
<?php if ($exclui) { ?>
<a href="acerta.php?id=<?php echo $linha['id']; ?>&tipo=<?php echo $tipo; ?>&oper=0" onclick='ajaxGo({url: this.href, elem_return: "conteudo", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/img/cancel.png" alt="Editar" /></a>
<?php } ?>
</td></tr>
<?php
// finaliza o loop que vai mostrar os dados
		}while($linha = mysql_fetch_assoc($prof));
	// fim do if 
	}
?>
<div id="pageNav"></div>
    <script>
        var pager = new Pager('tb1', 10); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNav'); 
        pager.showPage(1);
    </script>  
<div id="resultado"></div>
<?php mysql_close($conexao); ?>
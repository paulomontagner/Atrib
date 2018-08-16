<?php
include_once("estrutura/base.php");
$turma = mysql_query("SELECT s.*, l.nome, CONCAT(p.entrada, '-', p.saida) as nome_periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as nome_htpc from subturmas s, locais l, periodo p, htpc h where s.local = l.id and s.htpc = h.id and s.periodo = p.id and s.turma = ".$_GET['id']." and s.mostra = 1;", $conexao);
?>	
<p class="titulo">Lista de subturmas</p>
<table width="100%">
			<tr>
              <th>C&oacute;digo</th>
              <th>local</th>
			  <th>HTPC</th>
              <th>Periodo</th>
              <th>1&deg; Ano</th>
              <th>2&deg; Ano</th>
              <th>3&deg; Ano</th>
              <th>4&deg; Ano</th>
              <th>5&deg; Ano</th>
			  <th>Doc&ecirc;ncia</th>
			  <th colspan="3"><a href='cadastra_subturma.php?opera=0&id=0&turma=<?php echo $_GET['id']; ?>' onclick='ajaxGo({url: this.href, elem_return: "resultado", loading: "Carre<b>gando</b>", timeout: 4}); return false;'>Nova subturma</a></th>
			</tr>
			<?php 
	          	while ($dados = mysql_fetch_assoc($turma)) {
				echo "<tr><td align='center'>".$dados['id']."</td>";
				echo "<td align='center'>".utf8_encode($dados['nome'])."</td>";
				echo "<td align='center'>".utf8_encode($dados['nome_htpc'])."</td>";
				echo "<td align='center'>".$dados['nome_periodo']."</td>";
				echo "<td align='center'>".$dados['a']."</td>";
				echo "<td align='center'>".$dados['b']."</td>";
				echo "<td align='center'>".$dados['c']."</td>";  
				echo "<td align='center'>".$dados['d']."</td>";
				echo "<td align='center'>".$dados['e']."</td>";
				echo "<td align='center'>".$dados['docencia']."</td>"; ?>
<td><a href='cadastra_subturma.php?opera=1&id=<?php echo $dados['id']; ?>&turma=<?php echo $_GET['id']; ?>' onclick='ajaxGo({url: this.href, elem_return: "resultado", loading: "Carre<b>gando</b>", timeout: 4}); return false;'><img src="imagens/edit.png" alt="Editar" /></a></td></tr><?php              } 
 mysql_close($conexao);	?>
	  </table>	




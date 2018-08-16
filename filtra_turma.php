<?php
include_once("estrutura/base.php");
$local = mysql_query("SELECT id, nome FROM locais where tipo in (3,4,5,6) ORDER BY nome;", $conexao);
$qlocal = mysql_num_rows($local);
$grupo = mysql_query("SELECT id, grupo FROM grupos where ativo = 1 ORDER BY grupo;", $conexao);
$qgrupo = mysql_num_rows($grupo);
?>
<form action="lista_turma.php" method="post">
<table width="70%">
<tr>
<td>Tipo</td>
<td><select name="tipo">
<option value="">Todas</option>
<option value="4">24 horas</option>
<option value="5">30 horas</option>
</select>
</td>
</tr>
<tr>
<td>Status</td>
<td><select name="status">
<option value="">Todas</option>
<option value="0">Liberadas para atribui&ccedil;&atilde;o</option>
<option value="1">J&aacute; atribuidas</option>
</select>
</td>
</tr>
<tr>
<td>Local</td>
<td><select name="local">
      <option value = "">Todos</option>
      <?php for ($l = 0; $l < $qlocal; $l++)
		  	{?>
      <option value="<?php echo mysql_result($local, $l, id)?>"><?php echo utf8_encode(mysql_result($local, $l, nome))?></option>
      <?php }?>
    </select>
</td>
</tr>
<tr>
<td>Grupo</td>
<td><select name="grupo">
      <option value = "">Todos</option>
      <?php for ($l = 0; $l < $qgrupo; $l++)
		  	{?>
      <option value="<?php echo mysql_result($grupo, $l, id)?>"><?php echo utf8_encode(mysql_result($grupo, $l, grupo))?></option>
      <?php }?>
    </select>
</td>
</tr>
<tr><td colspan="2"><input type='button' value="Buscar" onclick='ajaxGo({form: this.form, elem_return: "resultado" });' /></td></tr>
<div id="resultado"></div>


<p class="titulo">Gerenciar Locais</p>
<?php
include_once("estrutura/base.php");
$local = mysql_query("SELECT id, nome FROM locais where tipo in (3,4,5,6) ORDER BY nome;", $conexao);
$qlocal = mysql_num_rows($local);
?>

<tr>
    <td width="34%">Local de trabalho</td>
    <td width="66%"><select name="local" id="local" tabindex="1" onChange="carrega('carrega_lista_atrib.php?id=', this.value, 'resultado')">
      <option value = "-1">Todos</option>
      <?php for ($l = 0; $l < $qlocal; $l++)
		  	{?>
      <option value="<?php echo mysql_result($local, $l, id)?>"><?php echo utf8_encode(mysql_result($local, $l, nome))?></option>
      <?php }?>
    </select></td>
  </tr>
<div id="resultado"></div>
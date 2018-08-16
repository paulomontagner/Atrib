<?php
include_once("estrutura/base.php");
        $id = $id;
        if($id <> 0)
		{
		$edresult = mysql_query("SELECT * FROM subturmas WHERE id = ".$id.";", $conexao);
			$local1 = mysql_result($edresult, 0, local);
		} else {
			$local1 = $_GET['local'];
		}
$periodo = mysql_query("select id, CONCAT(entrada, '-', saida) as resumo from periodo ", $conexao);
$qperiodo = mysql_num_rows($periodo);
$local = mysql_query("SELECT id, nome FROM locais ORDER BY nome;", $conexao);
$qlocal = mysql_num_rows($local);
$htpc = mysql_query("SELECT id, concat(dia, ' (', inicio, '-', fim, ')') as nome from htpc order by nome", $conexao);
$qhtpc = mysql_num_rows($htpc);
?>
<form action='insert_subturma.php' method='post'>
<table width="765" border="1" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#990000" class="titulobranco">Local: </td>
          <td><input type="hidden" name="turma" id="turma" value="<?php echo $_GET['turma']; ?>" /><input type="hidden" name="id" id="id" value="<?php echo $id; ?>" /><input type="hidden" name="opera" id="opera" value="<?php echo $_GET['opera']; ?>" />
		  <select name="local" id="local" tabindex="1">
	<?php for($l = 0; $l < $qlocal; $l++) {?>
			<option value="<?php echo mysql_result($local, $l, id); ?>" <?php if($id<>0){if(mysql_result($edresult, 0, local)== mysql_result($local, $l, id)) echo 'selected="selected"';} ?>><?php echo utf8_encode(mysql_result($local, $l, nome)); ?></option>
			<?php } ?>
		    </select></td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">Per&iacute;odo: </td>
          <td>
		  <select name="periodo" id="periodo" tabindex="1">
          	<?php for($l = 0; $l < $qperiodo; $l++) {?>
			<option value="<?php echo mysql_result($periodo, $l, id) ?>" <?php if($id<>0){if(mysql_result($edresult, 0, periodo)== mysql_result($periodo, $l, id)) echo 'selected="selected"';} ?>><?php echo utf8_encode(mysql_result($periodo, $l, resumo)) ?></option>
			<?php }?>
		    </select></td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">1&deg; Ano: </td>
          <td>
          <input type="text" name="a" id="a" value="<?php if($id <> 0){echo utf8_encode(mysql_result($edresult, 0, a));} else {echo 0;} ?>" />
          </td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">2&deg; Ano: </td>
          <td>
          <input type="text" name="b" id="b" value="<?php if($id <> 0){echo utf8_encode(mysql_result($edresult, 0, b));} else {echo 0;} ?>" />
          </td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">3&deg; Ano: </td>
          <td>
          <input type="text" name="c" id="c" value="<?php if($id <> 0){echo utf8_encode(mysql_result($edresult, 0, c));} else {echo 0;}?>" />
          </td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">4&deg; Ano: </td>
          <td>
          <input type="text" name="d" id="d" value="<?php if($id <> 0){echo utf8_encode(mysql_result($edresult, 0, d));} else {echo 0;}?>" />
          </td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">5&deg; Ano: </td>
          <td>
          <input type="text" name="e" id="e" value="<?php if($id <> 0){echo utf8_encode(mysql_result($edresult, 0, e));} else {echo 0;}?>" />
          </td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">Doc&ecirc;ncia: </td>
          <td>
          <input type="text" name="docencia" id="docencia" value="<?php if($id <> 0){echo utf8_encode(mysql_result($edresult, 0, docencia));} else {echo 0;} ?>" />
          </td>
        </tr>                                
        <tr>
          <td bgcolor="#990000" class="titulobranco">HTPC: </td>
          <td>
		  <select name="htpc" id="htpc" tabindex="1">
          	<?php for($l = 0; $l < $qhtpc; $l++) {?>
			<option value="<?php echo mysql_result($htpc, $l, id) ?>" <?php if($id<>0){if(mysql_result($edresult, 0, htpc)== mysql_result($htpc, $l, id)) echo 'selected="selected"';} ?>><?php echo utf8_encode(mysql_result($htpc, $l, nome)) ?></option>
			<?php }?>
		    </select></td>
        </tr>
  <tr><td colspan="2"><input type='button' value="Salvar" onclick='ajaxGo({form: this.form, timeout: 5, elem_return: "resultado" });' /></td></tr>
        </table>
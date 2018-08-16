<?php
include_once("estrutura/base.php");
        $id = $_GET['id'];
        if($id <> 0)
		{
			$edresult = mysql_query("SELECT t.*, (select f.nome from funcionarios f where f.codmatricula = t.titular) as nome_titular, (select f.nome from funcionarios f where f.codmatricula = t.suplente) as nome_suplente FROM turmas t WHERE id = ".$id.";", $conexao);
			$local1 = mysql_result($edresult, 0, local);
		} else {
			$local1 = $_GET['local'];
		}
$periodo = mysql_query("select id, CONCAT(grupo,'-', nome, '(', entrada, '-', saida, ')(',horasdia,' horas)') as resumo from periodo ", $conexao);
$qperiodo = mysql_num_rows($periodo);
$grupo = mysql_query("SELECT id, concat(grupo, ' - ', modalidade) as resumo FROM grupos", $conexao);
$qgrupo = mysql_num_rows($grupo);
$local = mysql_query("SELECT id, nome FROM locais ORDER BY nome;", $conexao);
$qlocal = mysql_num_rows($local);
$htpc = mysql_query("SELECT id, concat(dia, ' (', inicio, '-', fim, ')') as nome from htpc order by nome", $conexao);
$qhtpc = mysql_num_rows($htpc);
$motivos = mysql_query("SELECT id, nome from motivos order by id", $conexao);
$qmotivos = mysql_num_rows($motivos);
$status = mysql_query("SELECT id, nome from status", $conexao);
$qstatus = mysql_num_rows($status);
?>
<form action='insert_turma.php' method='post'>
<table width="765" border="1" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#990000" class="titulobranco">Local: </td>
          <td><input type="hidden" name="id" id="id" value="<?php echo $id; ?>" /><input type="hidden" name="opera" id="opera" value="<?php echo $_GET['opera']; ?>" />
		  <select name="local" id="local" tabindex="1">
	<?php for($l = 0; $l < $qlocal; $l++) {?>
			<option value="<?php echo mysql_result($local, $l, id) ?>" <?php if($local1 == mysql_result($local, $l, id)){echo 'selected="selected"';} ?>><?php echo utf8_encode(mysql_result($local, $l, nome)) ?></option>
			<?php } ?>
		    </select></td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">Grupo: </td>
          <td>
		  <select name="grupo" id="grupo" tabindex="1">
	<?php for($l = 0; $l < $qgrupo; $l++) {?>
			<option value="<?php echo mysql_result($grupo, $l, id) ?>" <?php if($id<>0){if(mysql_result($edresult, 0, grupo)== mysql_result($grupo, $l, id)) echo 'selected="selected"';} ?>><?php echo utf8_encode(mysql_result($grupo, $l, resumo)) ?></option>
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
          <td bgcolor="#990000" class="titulobranco">HTPC: </td>
          <td>
		  <select name="htpc" id="htpc" tabindex="1">
          	<?php for($l = 0; $l < $qhtpc; $l++) {?>
			<option value="<?php echo mysql_result($htpc, $l, id) ?>" <?php if($id<>0){if(mysql_result($edresult, 0, htpc)== mysql_result($htpc, $l, id)) echo 'selected="selected"';} ?>><?php echo utf8_encode(mysql_result($htpc, $l, nome)) ?></option>
			<?php }?>
		    </select></td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">Matricula titular:</td>
          <td width="561"><input name="titular" type="text" id="titular" tabindex="4" value="<?php if($id<>0) echo mysql_result($edresult, $i,titular) ?>" size="10" maxlength="5" onkeypress="Mascara(this,Integer);" onkeyup="Mascara(this,Integer);" onblur="carrega('mostra_nome_func.php?id=', this.value, 'nome_titular')"/><input width="300" type="text" id="nome_titular" readonly="readonly" value="<?php if($id<>0){echo utf8_encode(mysql_result($edresult, $i,nome_titular));}?>"></td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">Motivos: </td>
          <td>
		  <select name="motivos" id="motivos" tabindex="1">
          	<?php for($l = 0; $l < $qmotivos; $l++) {?>
			<option value="<?php echo mysql_result($motivos, $l, id) ?>" <?php if($id<>0){if(mysql_result($edresult, 0, afastamento)== mysql_result($motivos, $l, id)) echo 'selected="selected"';} ?>><?php echo utf8_encode(mysql_result($motivos, $l, nome)) ?></option>
			<?php }?>
		    </select></td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">Matricula suplente:</td>
          <td width="561"><input name="suplente" type="text" id="suplente" tabindex="4" value="<?php if($id<>0) echo mysql_result($edresult, $i,suplente) ?>" size="10" maxlength="5" onkeypress="Mascara(this,Integer);" onkeyup="Mascara(this,Integer);" onblur="carrega('mostra_nome_func.php?id=', this.value, 'nome_suplente')"/><input type="text" id="nome_suplente" readonly="readonly" value="<?php if($id<>0){echo mysql_result($edresult, $i,nome_suplente);}?>"></td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">Status: </td>
          <td>
		  <select name="status" id="status" tabindex="1">
          	<?php for($l = 0; $l < $qstatus; $l++) {?>
			<option value="<?php echo mysql_result($status, $l, id) ?>" <?php if($id<>0){if(mysql_result($edresult, 0, status)== mysql_result($status, $l, id)) echo 'selected="selected"';} ?>><?php echo utf8_encode(mysql_result($status, $l, nome)) ?></option>
			<?php }?>
		    </select></td>
        </tr>
        <tr>
          <td bgcolor="#990000" class="titulobranco">Subturmas: </td>
          <td>
		  <select name="sub" id="sub" tabindex="1">
          <option value="0" <?php if($id<>0){if(mysql_result($edresult, 0, educ_fisica)== 0) {echo 'selected="selected"';}} ?>>N&atilde;o</option>
          <option value="1" <?php if($id<>0){if(mysql_result($edresult, 0, educ_fisica)== 1) {echo 'selected="selected"';}} ?>>Sim</option>
		  </select></td>
        </tr>
  <tr><td colspan="2"><input type='button' value="Salvar" onclick='ajaxGo({form: this.form, timeout: 5, elem_return: "resultado" });' /></td></tr>
        </table>
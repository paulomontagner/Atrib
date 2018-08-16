<?php
include_once("estrutura/base.php");
	
	function carrega($campo, $tipo){
	$arrsn = array(
    "0" => "Não",
    "1" => "Sim"
	);
	$arrh = array(
    "24" => "24 horas",
    "30" => "30 horas"
	);
	$arrmf = array(
    "M" => "Masculino",
    "F" => "Feminino"
	);
	  switch ($tipo) {
		case 0: //sn
			foreach ($arrsn as $key => $value){
                $selected = ($campo == $key) ? "selected=\"selected\"" : null;
                echo "<option value=\"$key\"  $selected>$value</option>"; 
			}
			break;
		case 1:
			foreach ($arrh as $key => $value){
                $selected = ($campo == $key) ? "selected=\"selected\"" : null;
                echo "<option value=\"$key\"  $selected>$value</option>"; 
			}
			break;
		case 2:
			foreach ($arrmf as $key => $value){
                $selected = ($campo == $key) ? "selected=\"selected\"" : null;
                echo "<option value=\"$key\"  $selected>$value</option>"; 
			}
			break;
	}
}	
$sql = "SELECT * FROM pseletivo where id = ".$_REQUEST['id'].";";
$lista = mysql_query($sql, $conexao);
?>	
<form action="update_seletivo.php" method="post">
<table>
<tr>
<td>Opção:</td>
<td><input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ; ?>" />
<select name="opcao">
<?php carrega(mysql_result($lista, 0, 'opcao'),1); ?>
</select>
</td>
</tr>
<tr>
<td>Nome:</td>
<td><input type="text" name="nome" id="nome" value="<?php echo utf8_encode(mysql_result($lista, 0, 'nome')); ?>" style="text-transform: uppercase" size="80" /></td>
</tr>
<tr>
<td>RG:</td>
<td><input type="text" value="<?php echo mysql_result($lista, 0, 'rg'); ?>" name="rg" id="rg" /></td>
</tr>
<tr>
<td>CPF:</td>
<td><select name="cpf">
<?php carrega(mysql_result($lista, 0, 'cpf'),0); ?>
</select>
</td>
</tr>
<tr>
<td>Titulo de eleitor:</td>
<td><select name="titulo">
<?php carrega(mysql_result($lista, 0, 'titulo'),0); ?>
</select>
</td>
</tr>
<tr>
<td>Sexo</td>
<td><select name="sexo">
<?php carrega(mysql_result($lista, 0, 'sexo'),2); ?>
</select></td>
</tr>
<tr>
<td>Reservista:</td>
<td><select name="reservista">
<?php carrega(mysql_result($lista, 0, 'reservista'),0); ?></select>
</td>
</tr>
<tr>
<td>Certidão de casamento:</td>
<td><select name="casamento">
<?php carrega(mysql_result($lista, 0, 'nascimento'),0); ?></select>
</td>
</tr>
<tr>
<td>Certidão de nascimento:</td>
<td><input type="text" value="<?php echo mysql_result($lista, 0, 'nascimento'); ?>" name="nascimento" value="0">
</td>
</tr>
<tr>
<td>Comprovante de residencia:</td>
<td><select name="residencia">
<?php carrega(mysql_result($lista, 0, 'residencia'),0); ?>
</select>
</td>
<tr>
<td>Diploma:</td>
<td><select name="diploma">
<?php carrega(mysql_result($lista, 0, 'diploma'),0); ?>
</select>
</td>
<tr>
<tr>
<td>Historico:</td>
<td><select name="historico">
<?php carrega(mysql_result($lista, 0, 'historico'),0); ?>
</select>
</td>
<tr>
<td>Tempo de serviço</td>
<td><input type="text" name="tempo" value="<?php echo mysql_result($lista, 0, 'tempo'); ?>" id="tempo" value="0" /></td>
</tr>
<tr>
<td><input type="text" name="cursos" id="cursos" value="<?php echo mysql_result($lista, 0, 'cursos'); ?>" /></td>
<td>Certidão de cursos de atualização na área da educação infantil, educação de jovens e adultos e ensino fundamental (mínimo 30h)</td>
</tr>
<tr>
<td><input type="text" name="pos" id="pos" value="<?php echo mysql_result($lista, 0, 'pos'); ?>" /></td>
<td>Cursos de especialização ou aperfeiçoamento ---- (mínimo 360h)</td>
</tr>
<tr>
<td><input type="text" name="mestrado" id="mestrado" value="<?php echo mysql_result($lista, 0, 'mestrado'); ?>" /></td>
<td>Certificado ou declaração de conclusão de cursos de mestrado.</td>
</tr>
<tr>
<td><input type="text" name="doutorado" id="doutorado" value="<?php echo mysql_result($lista, 0, 'doutorado'); ?>" /></td>
<td>Certificado ou declaração de conclusão de cursos de doutorado.</td>
</tr>
<tr>
<td>Observações</td>
<td><textarea name="obs" cols="70"><?php echo mysql_result($lista, 0, 'obs'); ?></textarea></td>
</tr>
<tr>
<td>Deferido</td>
<td><select name="ativo">
<?php carrega(mysql_result($lista, 0, 'ativo'),0); ?>
</select></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="reset" value="Limpar" />
<input type='button' value="Salvar" onclick='ajaxGo({form: this.form, timeout: 5, elem_return: "conteudo" });' />
</td>
</tr>
</table>
</form>
<div id="resultado"></div>
<?php 
mysql_close;
?>
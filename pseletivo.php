<form action="insert_seletivo.php" method="post">
<table>
<tr>
<td>Opção:</td>
<td><select name="opcao">
<option value="24">24 horas</option>
<option value="30">30 horas</option>
</select>
</td>
</tr>
<tr>
<td>Nome:</td>
<td><input type="text" name="nome" id="nome" style="text-transform: uppercase" size="80" /></td>
</tr>
<tr>
<td>RG:</td>
<td><input type="text" name="rg" id="rg" /></td>
</tr>
<tr>
<td>CPF:</td>
<td><select name="cpf">
<option value="1" selected>Sim</option>
<option value="0">Não</option>
</select>
</td>
</tr>
<tr>
<td>Titulo de eleitor:</td>
<td><select name="titulo">
<option value="1" selected>Sim</option>
<option value="0">Não</option>
</select>
</td>
</tr>
<tr>
<td>Sexo</td>
<td><select name="sexo"><option value="M">Masculino</option><option value="F" selected="selected">Feminino</option></select></td>
</tr>
<tr>
<td>Reservista:</td>
<td><select name="reservista">
<option value="1">Sim</option>
<option value="0" selected>Não</option>
</select>
</td>
</tr>
<tr>
<td>Certidão de casamento:</td>
<td><select name="casamento">
<option value="1">Sim</option>
<option value="0" selected>Não</option>
</select>
</td>
</tr>
<tr>
<td>Certidão de nascimento:</td>
<td><input type="text" name="nascimento" value="0">
</td>
</tr>
<tr>
<td>Comprovante de residencia:</td>
<td><select name="residencia">
<option value="1" selected>Sim</option>
<option value="0">Não</option>
</select>
</td>
<tr>
<td>Diploma:</td>
<td><select name="diploma">
<option value="1" selected>Sim</option>
<option value="0">Não</option>
</select>
</td>
<tr>
<tr>
<td>Historico:</td>
<td><select name="historico">
<option value="1" selected>Sim</option>
<option value="0">Não</option>
</select>
</td>
<tr>
<td>Tempo de serviço</td>
<td><input type="text" name="tempo" id="tempo" value="0" /></td>
</tr>
<tr>
<td><input type="text" name="cursos" id="cursos" value="0" /></td>
<td>Certidão de cursos de atualização na área da educação infantil, educação de jovens e adultos e ensino fundamental (mínimo 30h)</td>
</tr>
<tr>
<td><input type="text" name="pos" id="pos" value="0" /></td>
<td>Cursos de especialização ou aperfeiçoamento ---- (mínimo 360h)</td>
</tr>
<tr>
<td><input type="text" name="mestrado" id="mestrado" value="0" /></td>
<td>Certificado ou declaração de conclusão de cursos de mestrado.</td>
</tr>
<tr>
<td><input type="text" name="doutorado" id="doutorado" value="0" /></td>
<td>Certificado ou declaração de conclusão de cursos de doutorado.</td>
</tr>
<tr>
<td>Observações</td>
<td><textarea name="obs" cols="70"></textarea></td>
</tr>
<tr>
<td>Deferido</td>
<td><select name="ativo">
<option value="1" selected>Sim</option>
<option value="0">Não</option>
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

<form action="lista_seletivo.php" method="post">
<table width="70%">
<tr>
<td>Opção:</td>
<td><select name="tipo">
<option value="">Todas</option>
<option value="24">24 horas</option>
<option value="30">30 horas</option>
</select>
</td>
</tr>
<tr>
<td>Situação:</td>
<td><select name="sit">
<option value="">Todas</option>
<option value="1">Deferido</option>
<option value="0">Indeferido</option>
</select>
</td>
</tr>
<tr>
<td>Nome:</td>
<td><input type="text" name="nome"></td>
</tr>

<tr><td colspan="2"><input type='button' value="Buscar" onclick='ajaxGo({form: this.form, elem_return: "resultado" });' /></td></tr>
<div id="resultado"></div>


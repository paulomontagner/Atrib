<form action='altera_classifica_docente.php' method='post'>
<table width="765" border="1" cellspacing="0" cellpadding="5">
        <tr>
          <td bgcolor="#990000" class="titulobranco">Matricula: </td>
          <td><input type="text" name="matricula" id="matricula"  /></td>
        </tr>
		<tr>
		<td colspan="2"><input type='button' value="Salvar" onclick='ajaxGo({form: this.form, timeout: 5, elem_return: "conteudo" });' /></td>
		</tr>
</table>
</form>

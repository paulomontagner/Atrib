<form action="menu/index.php" method="POST" onsubmit="ajaxGo({form: this.form, timeout: 5, elem_return: 'conteudo' });">
texto menu <input type="" name="texto_menu" value="">
link menu <input type="" name="link_menu" value="">
<input type="submit" name="insert_menu" >
</form>
 
<br><br>
 
<form action="menu/index.php" method="POST" onsubmit="ajaxGo({form: this.form, timeout: 5, elem_return: 'conteudo' });">
no menu <select name="id_menu">
<?php
$selec3 = "SELECT id_menu, texto, link FROM menus";
$exec3 = mysql_query($selec3, $conexao) or die(mysql_error());
while($campos3=mysql_fetch_array($exec3)) {
extract($campos3);
echo "<option value='$id_menu'>$texto</option>";
}
?>
</select>
texto submenu <input type="" name="texto_submenu" value="">
link submenu <input type="" name="link_submenu" value="">
Acesso <input type="" name="link_acesso" value="">
<input type="submit" name="insert_submenu">
</form>

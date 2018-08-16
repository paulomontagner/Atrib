<?php
// INSERTS
if($_POST['texto_menu']) {
extract($_POST);
$selec3 = "INSERT INTO menus (texto, link) VALUES('".htmlentities($texto_menu,ENT_QUOTES, 'UTF-8')."', '$link_menu')";
$exec3 = mysql_query($selec3, $conexao) or die(mysql_error());
echo "<script>
alert('Menu inserido com sucesso');
location.href='index.php'
</script>";
}

if($_POST['texto_submenu']) {
extract($_POST);
$selec3 = "INSERT INTO submenu (id_menu, texto, link, acesso) VALUES('$id_menu', '".htmlentities($texto_submenu,ENT_QUOTES, 'UTF-8')."', '$link_submenu', '$link_acesso')";
$exec3 = mysql_query($selec3, $conexao) or die(mysql_error());
echo "<script>
alert('Submenu inserido com sucesso');
location.href='index.php'
</script>";
}
?>
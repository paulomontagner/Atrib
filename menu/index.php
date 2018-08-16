    <?php
    require_once('../estrutura/base.php');
    ?>

    <?php
    $selec = "SELECT id_menu, texto, link FROM menus";
    $exec = mysql_query($selec, $conexao) or die(mysql_error());
    ?>

    <?php
    // menus principais
    while($campos=mysql_fetch_array($exec)) {
    extract($campos);
    echo "<a href=\"$link\">".utf8_encode($texto)."</a> - <a href='menu/index.php?deletamenu=$id_menu' onclick='ajaxGo({url: this.href, elem_return: \"conteudo\", loading: \"Carre<b>gando</b>\", timeout: 4}); return false;'><img src=\"imagens/img/Delete.png\"  /></a><br>";

    // submenu
    $selec2 = "SELECT id_submenu, texto, link FROM submenu WHERE id_menu='$id_menu'";
    $exec2 = mysql_query($selec2, $conexao) or die(mysql_error());
    while($campos2=mysql_fetch_array($exec2)) {
    extract($campos2);
    echo "- <a href=\"$link\">".utf8_encode($texto)."</a> - <a href='menu/index.php?deletasubmenu=$id_submenu' onclick='ajaxGo({url: this.href, elem_return: \"conteudo\", loading: \"Carre<b>gando</b>\", timeout: 4}); return false;'><img src=\"imagens/img/Delete.png\" /></a><br>";
    } // fim do submenu

    } // fim do menu principal
    ?>

    <?php
    include("deletes.php");
    include("inserts.php");
    include("forms.php");
    ?>

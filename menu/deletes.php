    <?php
    // DELETES
    if($_GET['deletamenu']) {
    extract($_GET);
    $selec = "DELETE FROM menus WHERE id_menu='$deletamenu'";
    $exec = mysql_query($selec, $conexao) or die(mysql_error());
    $selec2 = "DELETE FROM submenu WHERE id_menu='$deletamenu'";
    $exec2 = mysql_query($selec2, $conexao) or die(mysql_error());
    echo "<script>
    alert('Menu e submenus deletado(s) com sucesso');
    location.href='index.php'
    </script>";
    }

    if($_GET['deletasubmenu']) {
    extract($_GET);
    $selec = "DELETE FROM submenu WHERE id_submenu='$deletasubmenu'";
    $exec = mysql_query($selec, $conexao) or die(mysql_error());
    echo "<script>
    alert('Submenu deletado com sucesso');
    location.href='index.php'
    </script>";
    }
    ?>

<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
$salto = "../";
$arquivo = basename ($_SERVER['PHP_SELF'],".php");
include_once("../include/cabec.php");
include_once("../include/menu.php");
carregarCSS(array("bootstrap.min","font-awesome.min","ionicons.min","alertify.core","alertify.default","AdminLTE","_all-skins.min","dataTables.tableTools.min"),$salto);
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Atribuição</a></li>
            <li class="active"><?php echo $arquivo;  ?></li>
          </ol>
        </section>
        <br>
        <form action="atrib_importa_turma.php" method="post" id="envia" name="envia">
        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
              <label for="local">Local</label>
              <select name="local" id="local" class="form-control">
                <option value="">Escolha um</option>
                  <?php
                   $reg = $con->query("select l.id, l.nome, (select count(e.id) from  dp_atrib_escola e where e.local = l.id and e.status = 1 and e.import = 0) as qtde from locais l where l.tipo > 0 and l.tipo < 7 group by l.id order by l.nome");
                   foreach ($reg as $linha1){
                     if ($linha1["qtde"] != 0){
                    echo "<option value=\"".$linha1['id']."\">".utf8_encode($linha1["nome"])." (".$linha1["qtde"].")</option>";
                    }
                   }
                   ?>              
              </select>           
            </div>    
          </div>
          <div class="col-xs-6">
            <button type="button" class="btn btn-primary" id="gera">Buscar</button>        
            <button type="button" class="btn btn-info" id="importa" onclick="$('#envia').submit()">Importar</button>    
          </div>
        </div>        
              
        
        <div id="editor"></div>
        </form>
        
        
</div>        
<?php
include_once("../include/rodape.php");
carregarJS(array("jQuery-2.1.3.min","bootstrap.min","jquery.slimScroll.min","fastclick.min","app.min","alertify.min","jquery.validate.min","jquery.dataTables","dataTables.bootstrap","dataTables.tools.min","../script/atrib_importa_escola","jquery.forms"),$salto);
?>	

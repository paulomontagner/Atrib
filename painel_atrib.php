<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
$salto = "../";
$arquivo = basename ($_SERVER['PHP_SELF'],".php");
include_once("../include/cabec.php");
include_once("../include/menu.php");
carregarCSS(array("bootstrap.min","font-awesome.min","ionicons.min","AdminLTE","_all-skins.min","dataTables.bootstrap","alertify.core","alertify.default"),$salto);
?>
<style>  
  #ModalExterno .modal-dialog  {width:85%;}
</style>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Pagina Inicial</a></li>
            <li class="active"><?php echo $arquivo;  ?></li>
          </ol>
          <br>          
        </section>
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="box-head">
              Painel de Atribuição
            </div>
            <div class="box-body">
            <?php
            $tota = 0;
            $tipo = $con->query("select t.*, (select count(id) from dp_atrib_classifica where turma = 0 and tipo = t.id) as qtde from dp_tipo_professor t order by tipo");
            foreach ($tipo as $n) { 
               $tota += $n["qtde"];
               ?>
              <a href="javascript:;" onclick="listatipo(<?php echo $n["id"] ?>)" class="btn btn-app">
                <span class="badge <?php echo $n["cor"] ?>"><?php echo $n["qtde"] ?></span>
                <i class="fa <?php echo $n["icone"] ?>"></i> <?php echo utf8_encode($n["tipo"]) ?>
              </a>
            <?php } ?>
              <a href="javascript:;" onclick="listatipo(0)" class="btn btn-app">
                <span class="badge black"><?php echo $tota ?></span>
                <i class="fa fa-asterisk"></i> Todos
              </a>
            </div>
          </div>         
          <div id="editor"></div> 
        </section>   
</div> 
<div id="ModalExterno" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
              <h4 class="modal-title">Atribuição</h4>
            </div>
            <div class="modal-body">
              <div id="editor2"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>              
            </div>
          </div>  
      </div>                    
  </div>
<?php
include_once("../include/rodape.php");
carregarJS(array("jQuery-2.1.3.min","bootstrap.min","jquery.slimScroll.min","jquery-ui-1.10.3.min","fastclick.min","app.min", "jquery.dataTables","dataTables.bootstrap","jquery.validate.min","alertify.min","../script/painel_atrib","jquery.forms"),$salto);
?>	

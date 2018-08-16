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
  #modalturma .modal-dialog  {width:95%;}
</style>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Atribuição</a></li>
            <li class="active"><?php echo $arquivo;  ?></li>
          </ol>
          <br>          
        </section>
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="box-body">
              <a href="javascript:;" onclick="editaturma(0)" class="btn btn-app btn-info">
                <i class="fa fa-plus"></i>Nova
              </a>
              <a href="javascript:;" onclick="listaturma(0)" class="btn btn-app btn-primary">
                <i class="fa fa-asterisk"></i>Todas
              </a> 
              <a href="javascript:;" onclick="listaturma(1)" class="btn btn-app btn-success">
                <i class="fa fa-unlock"></i>Livres
              </a>          
              <a href="javascript:;" onclick="listaturma(2)" class="btn btn-app btn-warning">
                <i class="fa fa-check-square"></i>Atribuidas
              </a>          
              <a href="javascript:;" onclick="listaturma(3)" class="btn btn-app btn-danger">
                <i class="fa fa-check-square-o"></i>Em Substituição
              </a>
              <a href="relatorios/ata.php" target="_blank" class="btn btn-app btn-danger">
                <i class="fa fa-print"></i>Ata
              </a>          
            </div>
          </div> 
          <div id="editor"></div>         
        </section>

<div class="modal fade bs-example-modal-lg" id="modalturma" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title">Cadastro de Turmas</h4>
      </div>
      <div class="modal-body">
      <form role="form" action="atrib_upd_turma_escola.php" method="post" name="cadturma" id="cadturma">
        <div class="row">
          <div class="col-xs-2">
            <div class="form-group">
              <label for="id">Código</label>
              <input type="text" id="id" name="id" class="form-control" readonly="readonly">
            </div>
          </div>
          <div class="col-xs-3">
            <div class="form-group">
              <label for="grupo">Grupo</label>
              <select name="grupo" id="grupo" class="form-control">
                <?php
                $grupo = $con->query("select id, grupo from grupos order by id");
                foreach ($grupo as $gp) {
                  echo "<option value=\"".$gp["id"]."\">".utf8_encode($gp["grupo"])."</option>";
                }
                ?>
              </select> 
            </div>
          </div>            
          <div class="col-xs-3">
            <div class="form-group">
              <label for="nome">Turma</label>
              <input type="text" id="nome" name="nome" class="form-control">
            </div>            
          </div>
          <div class="col-xs-4">
            <div class="form-group">
              <label for="periodo">Periodo</label>
              <select name="periodo" id="periodo" class="form-control">
                <?php 
                $periodo = $con->query("select * from dp_turnos where id != 10 order by grupo, nome, entrada");
                foreach ($periodo as $pr) {
                 echo "<option value=\"".$pr["id"]."\">".$pr["grupo"]." - ".utf8_encode($pr["nome"])."(".$pr["entrada"]."-".$pr["saida"].")</option>"; 
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-2">
            <div class="form-group">
              <label for="matricula">Matrícula</label>
              <input type="text" id="matricula" name="matricula" maxlength="5" class="form-control">
              <input type="hidden" id="idfunc" name="idfunc">
            </div>
          </div>
          <div class="col-xs-4">
            <div class="form-group">
              <label for="professor">Professor</label>
              <input type="text" name="professor" id="professor" class="form-control" readonly="readonly">
            </div>
          </div>
          <div class="col-xs-2">
            <div class="form-group">
              <label for="funcao">Função</label>
              <input type="text" name="funcao" id="funcao" class="form-control" readonly="readonly">
            </div>
          </div>
          <div class="col-xs-1">
            <div class="form-group">
              <label for="classifica">Classificação</label>
              <input type="text" name="classifica" id="classifica" class="form-control" readonly="readonly">
            </div>
          </div>
          <div class="col-xs-3">
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <?php 
                $motivos = $con->query("select * from dp_motivos where id > 0 order by id");
                foreach ($motivos as $mt) {
                 echo "<option value=\"".$mt["id"]."\">".utf8_encode($mt["nome"])."</option>"; 
                }
                ?>
              </select>
            </div>
          </div>
        </div>        
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="$('#cadturma').submit()">Salvar Alterações</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
</div>
<?php
include_once("../include/rodape.php");
carregarJS(array("jQuery-2.1.3.min","bootstrap.min","jquery.slimScroll.min","fastclick.min","app.min", "jquery.dataTables","dataTables.bootstrap","jquery.validate.min","alertify.min","../script/atrib_escola","jquery.forms"),$salto);
?>	

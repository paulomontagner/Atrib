<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
$salto = "../";
$arquivo = basename ($_SERVER['PHP_SELF'],".php");
include_once("../include/cabec.php");
include_once("../include/menu.php");
carregarCSS(array("bootstrap.min","font-awesome.min","ionicons.min","alertify.core","alertify.default","AdminLTE","_all-skins.min","dataTables.tableTools.min"),$salto);
$loca = $con->query("select l.id, l.nome, (select count(e.turmaid) from  dp_atrib_turma e where e.turmalocal = l.id and e.turmaativo = 1) as qtde from locais l where l.tipo > 0 and l.tipo < 7 group by l.id order by l.nome");
$reg = $loca->fetchall(PDO::FETCH_ASSOC);
$per = $con->query("select * from dp_turnos where id != 10 order by grupo, nome");
$periodo = $per->fetchall(PDO::FETCH_ASSOC);
?>
<style>
  #modalturmas .modal-dialog  {width:80%;}    
  #modalsubturma .modal-dialog  {width:80%;}
  #modalatribprof .modal-dialog {width:80%;}
</style>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Atribuição</a></li>
            <li class="active"><?php echo $arquivo;  ?></li>
          </ol>
        </section>
        <br>
        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
              <label for="local">Local</label>
              <select name="local" id="local" class="form-control">
                <option value="">Escolha um</option>
                  <?php               
                   foreach ($reg as $linha1){
                    echo "<option value=\"".$linha1['id']."\">".utf8_encode($linha1["nome"])." (".$linha1["qtde"].")</option>";
                   }
                   ?>              
              </select>           
            </div> 
          </div>
          <div class="col-xs-6">
              <a href="javascript:;" id="gera" class="btn btn-app">                
                <i class="fa fa-asterisk"></i> Carregar turma
              </a>
              <a href="javascript:;" onclick="impturmas()" class="btn btn-app">                
                <i class="fa fa-print"></i> Imprime turmas
              </a>
          </div>
        </div>
        <div id="editor"></div>
        
        
</div>
<!-- modal para turmas -->
<div class="modal fade bs-example-modal-lg" id="modalturmas" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title">Cadastro de turmas para atribuição</h4>
      </div>
      <div class="modal-body">
      <form action="atrib_upd_turmas_ger.php" method="post" id="cad_turma" name="cad_turma">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" id="aba_principal" data-toggle="tab">Turma</a></li>
              <li><a href="#tab_2" id="subatrib" data-toggle="tab">Subturmas</a></li>
              <li><a href="#tab_3" id="atribuicoes" data-toggle="tab">Atribuições</a></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
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
                      foreach ($periodo as $pr) {
                       echo "<option value=\"".$pr["id"]."\">".$pr["grupo"]." - ".utf8_encode($pr["nome"])."(".$pr["entrada"]."-".$pr["saida"].")</option>"; 
                      }
                      ?>
                    </select>
                  </div>
                </div>                                
              </div>
              <div class="row">
                <div class="col-xs-9">
                  <div class="form-group">
                    <label for="tlocal">Local</label>
                    <select name="tlocal" id="tlocal" class="form-control">
                      <option value="">Escolha um</option>
                        <?php               
                         foreach ($reg as $linha1){
                          echo "<option value=\"".$linha1['id']."\">".utf8_encode($linha1["nome"])."</option>";
                         }
                         ?>              
                    </select>
                  </div>
                </div>
                <div class="col-xs-3">
                  <div class="form-group">
                    <label for="status">Ativo</label>
                    <select name="status" id="status" class="form-control">
                      <option value="0">Não</option>
                      <option value="1">Sim</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane active" id="tab_2">
              <div id="editor2"></div>              
            </div>
            <div class="tab-pane active" id="tab_3">
              <div id="editor3"></div>
            </div>
            </div>
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="$('#cad_turma').submit()">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>          

<div class="modal fade bs-example-modal-lg" id="modalsubturma" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title">Cadastro de subturmas</h4>
      </div>
      <form action="atrib_upd_subturmas_ger.php" method="post" id="cad_sub" name="cad_sub">
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-2">
            <div class="form-group">
              <label for="subid">Código</label>
              <input type="text" id="subid" name="subid" class="form-control" readonly="readonly">
              <input type="hidden" id="subturmaid" name="subturmaid">
            </div>            
          </div>
          <div class="col-xs-5">
            <div class="form-group">
              <label for="sublocal">Local</label>
              <select name="sublocal" id="sublocal" class="form-control">
                <option value="">Escolha um</option>
                  <?php               
                   foreach ($reg as $linha1){
                    echo "<option value=\"".$linha1['id']."\">".utf8_encode($linha1["nome"])."</option>";
                   }
                   ?>              
              </select>
            </div>
          </div>
          <div class="col-xs-5">
            <div class="form-group">
              <label for="subperiodo">Periodo</label>
              <select name="subperiodo" id="subperiodo" class="form-control">
                <?php                       
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
              <label for="a">1º Ano</label>
              <input type="text" id="a" name="a" class="form-control">
            </div>
          </div>
          <div class="col-xs-2">
            <div class="form-group">
              <label for="b">2º Ano</label>
              <input type="text" id="b" name="b" class="form-control">
            </div>
          </div>
          <div class="col-xs-2">
            <div class="form-group">
              <label for="c">3º Ano</label>
              <input type="text" id="c" name="c" class="form-control">
            </div>
          </div>
          <div class="col-xs-2">
            <div class="form-group">
              <label for="d">4º Ano</label>
              <input type="text" id="d" name="d" class="form-control">
            </div>
          </div>
          <div class="col-xs-2">
            <div class="form-group">
              <label for="e">5º Ano</label>
              <input type="text" id="e" name="e" class="form-control">
            </div>
          </div>
          <div class="col-xs-2">
            <div class="form-group">
              <label for="f">Horas de docência</label>
              <input type="text" id="f" name="f" class="form-control">
            </div>
          </div>
        </div>
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="$('#cad_sub').submit()">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalimprime" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title">Impressão de turmas</h4>
      </div>
      <div class="modal-content">
      <form action="relatorios/rel_turmas.php" target="_blank" method="get" id="imp" name="imp">
        <div class="form-group">
          <label for="tipo">Escolha um relatório</label>
          <select name="tipo" id="tipo" class="form-control">
            <option value="1">24 horas livres</option>
            <option value="2">24 horas para suplementação</option>
            <option value="3">30 horas livres</option>
            <option value="4">30 horas para suplementação</option>
            <option value="5">Adjunto livres</option>
            <option value="6">Adjunto para suplementação</option>
            <option value="10">Adjunto todas</option>
            <option value="7">Educação Fisica livres</option>
            <option value="8">Educação Fisica para suplementação</option>
            <option value="9">Todas</option>
          </select>
        </div>        
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="$('#imp').submit()">Imprimir</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalatribprof" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
        <h4 class="modal-title">Cadastro de professores atribuidos</h4>
      </div>
      <div class="modal-content">
        <form action="atrib_upd_atrib_prof.php" method="POST" id="atribprof" name="atribprof">
        <div class="row">
          <div class="col-xs-3">
            <div class="form-group">
              <label for="itemid">Código</label>           
              <input type="hidden" id="itemfunc" name="itemfunc"> 
              <input type="hidden" id="turmaid" name="turmaid">
              <input type="text" id="itemid" name="itemid" readonly="readonly" class="form-control">
            </div>
          </div>
          <div class="col-xs-3">
            <div class="form-group">
              <label for="profmatricula">Matricula</label>            
              <input type="text" id="profmatricula" name="profmatricula" class="form-control">
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="nomeprof">Docente</label>
              <input type="text" name="nomeprof" id="nomeprof" class="form-control">
            </div>
          </div>
        </div>  
        <div class="row">
          <div class="col-xs-4">
            <div class="form-group">
              <label for="itemstatus">Ativo</label>
              <select name="itemstatus" id="itemstatus" class="form-control">
                <option value="0">Cancelado</option>
                <option value="1">Ativo</option>
              </select>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="form-group">
              <label for="itemmotivo">Motivo</label>
              <select name="itemmotivo" id="itemmotivo" class="form-control">
                <?php
                $mot = $con->query("select * from dp_motivos order by id");
                foreach ($mot as $mt) {
                  echo "<option value=\"".$mt["id"]."\">".utf8_encode($mt["nome"])."</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="form-group">
              <label for="itemposicao">Ordem</label>
              <select name="itemposicao" id="itemposicao" class="form-control">
                <option value="1">Titular</option>
                <option value="2">Suplente</option>
                <option value="3">2º Suplente</option>
                <option value="4">3º Suplente</option>
                <option value="5">4º Suplente</option>
              </select>
            </div>
          </div>
        </div>
        </form>
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="$('#atribprof').submit()">Salvar</button>
      </div>
    </div>
  </div>
</div>

<?php
include_once("../include/rodape.php");
carregarJS(array("jQuery-2.1.3.min","bootstrap.min","jquery.slimScroll.min","fastclick.min","app.min","alertify.min","jquery.validate.min","jquery.dataTables","dataTables.bootstrap","dataTables.tools.min","../script/atrib_gerencia_escola","jquery.forms"),$salto);
?>	

<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
$idfunc = $_POST["idfunc"];
$turma = $_POST["turma"];
$posicao = $_POST["posicao"];
  /*$sql = "update dp_atrib_turma set turmastatus = 0 where turmaid = $turma;";      
  $sql .= "INSERT INTO dp_atrib_item (itemfunc, turmaid, itemstatus, itemposicao, itemativo, itemmotivo) VALUES ($idfunc, $turma, 1, 1, ++$posicao, 1);";
  $sql .= "UPDATE dp_atrib_classifica SET turma = $turma WHERE funcid = $funcid;";
$ex = $con->exec($sql);*/
$ordem = array('1' => '<small class="label label-success">Titular</small>', '2' => '<small class="label label-info">1º Suplente</small>', '3' => '<small class="label label-warning">2º Suplente</small>' ); 

 ?>      
            <div class="box-header">            
              <div class="row">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Matricula</th>
                      <th>Docente</th>
                      <th>Classificação</th>
                      <th>Motivo</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $clas = $con->query("select * from dp_atrib_classifica where funcid = $idfunc;");
                    foreach ($clas as $row) { ?>
                    <tr>
                      <td><?php echo $row["matricula"]; ?></td>
                      <td><?php echo $row["nome"]; ?></td>
                      <td><?php echo $row["classifica"]; ?>º</td>
                      <td>
                        <form action="atrib_inc_atrib.php" method="post" id="formatrib" target="_blank" name="formatrib">
                        <input type="hidden" id="turma" name="turma" value="<?php echo $turma; ?>">
                        <input type="hidden" id="idfunc" name="idfunc" value="<?php echo $idfunc; ?>">
                        <input type="hidden" id="posicao" name="posicao" value="<?php echo $posicao; ?>">
                        <select name="motivo" id="motivo" class="form-control">
                        <?php
                        $mot = $con->query("select * from dp_motivos order by id");
                        foreach ($mot as $mt) {
                          echo "<option value=\"".$mt["id"]."\">".utf8_encode($mt["nome"])."</option>";
                        }
                        ?>
                      </select>
                      </form>  
                      </td>
                      <td><a href="javascript:;" class="btn btn-success" onclick="$('#formatrib').submit();"><i class="fa fa-check-square-o"></i>Confirma</a>                          
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Matricula</th>
                      <th>Docente</th>
                      <th>Atribuição</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $item = $con->query("SELECT dp_atrib_item.itemid, dp_atrib_item.itemstatus, dp_atrib_item.itemmotivo, dp_atrib_item.itemposicao, dp_funcionarios.nome, dp_funcionarios.codmatricula, dp_motivos.nome as motivo  FROM dp_atrib_item , dp_funcionarios , dp_motivos  WHERE dp_atrib_item.itemfunc = dp_funcionarios.id and dp_atrib_item.itemativo = 1 and dp_motivos.id = dp_atrib_item.itemmotivo and dp_atrib_item.turmaid = ".$turma." order by itemposicao");
                    foreach ($item as $ln) { ?>
                     <tr>
                       <td><?php echo $ln["codmatricula"]; ?></td>
                       <td><?php echo utf8_encode($ln["nome"]); ?></td>
                       <td><?php echo $ordem[$ln["itemposicao"]]; ?></td>
                       <td><?php echo utf8_encode($ln["motivo"])?></td>
                     </tr> 
                    <?php } ?>
                  </tbody>
                </table>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td>Código</td>
                      <td>Escola</td>
                      <td>Grupo</td>
                      <td>Turma</td>
                      <td>Periodo</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $turme = $con->query("SELECT dp_atrib_turma.turmaid, dp_atrib_turma.turmagrupo, dp_atrib_turma.turmanome, locais.nome as escola, dp_turnos.grupo as periodo, dp_turnos.nome as hora, dp_turnos.entrada, dp_turnos.saida, grupos.grupo FROM dp_atrib_turma , locais , dp_turnos , grupos WHERE dp_atrib_turma.turmalocal = locais.id and dp_atrib_turma.turmaperiodo = dp_turnos.id and dp_atrib_turma.turmagrupo = grupos.id and dp_atrib_turma.turmaid = $turma ;");
                    foreach ($turme as $row) { 
                      $tipoturma = $row["turmagrupo"]; ?>
                      <td><?php echo $row["turmaid"]; ?></td> 
                      <td><?php echo utf8_encode($row["escola"]); ?></td>
                      <td><?php echo utf8_encode($row["grupo"]); ?></td>
                      <td><?php echo utf8_encode($row["grupo"]." ".$row["turmanome"]); ?></td>
                      <td><?php echo utf8_encode($row["hora"]." (".$row["entrada"]."-".$row["saida"].")"); ?></td>
                    <?php } ?>
                  </tbody>
                </table>
                <?php
                if ($tipoturma == 21){
                ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td>Local</td>
                      <td>Periodo</td>
                      <td>1º Ano</td>
                      <td>2º Ano</td>
                      <td>3º Ano</td>
                      <td>4º Ano</td>
                      <td>5º Ano</td>
                      <td>Horas de docência</td>
                    </tr>
                  </thead>
                  <tbody>                    
                      <?php 
                      $sub = $con->query("SELECT dp_atrib_sub.*, locais.nome, dp_turnos.grupo, dp_turnos.nome as periodo, dp_turnos.entrada, dp_turnos.saida FROM dp_atrib_sub, locais, dp_turnos WHERE locais.id = dp_atrib_sub.sublocal and dp_turnos.id = dp_atrib_sub.subperiodo and dp_atrib_sub.turmaid = $turma");
                      foreach ($sub as $row) {
                      ?>
                      <tr>
                      <td><?php echo utf8_encode($row["nome"]); ?></td>
                      <td><?php echo utf8_encode($row["periodo"]." (".$row["entrada"]."-".$row["saida"].")"); ?></td>
                      <td><?php echo $row["a"]; ?></td>
                      <td><?php echo $row["b"]; ?></td>
                      <td><?php echo $row["c"]; ?></td>
                      <td><?php echo $row["d"]; ?></td>
                      <td><?php echo $row["e"]; ?></td>
                      <td><?php echo $row["f"]; ?></td>
                      </tr>
                      <?php } ?>                    
                  </tbody>
                </table>
                <?php } ?>
              </div>            
            </div><!-- /.box-body -->
      
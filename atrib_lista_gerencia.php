<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
$st = array('0' => '<small class="label label-danger">Encerrada</small>', '1' => '<small class="label label-success">Liberada</small>');
$nu = array('1' => '<small class="label label-success">Titular</small>', '2' => '<small class="label label-info">1º Suplente</small>', '3' => '<small class="label label-warning">2º Suplente</small>' );                
$sql = "SELECT dp_atrib_turma.turmaid, dp_atrib_turma.turmastatus, dp_atrib_turma.turmanome, dp_atrib_turma.turmaqtde, grupos.grupo, dp_turnos.grupo as horas, dp_turnos.nome as periodo, dp_turnos.entrada, dp_turnos.saida FROM dp_atrib_turma, grupos , dp_turnos  WHERE dp_atrib_turma.turmagrupo = grupos.id and dp_atrib_turma.turmaperiodo = dp_turnos.id and dp_atrib_turma.turmaativo = 1 and dp_atrib_turma.turmalocal = ".$_POST["local"];
$rs = $con->prepare("SELECT dp_atrib_item.itemid, dp_atrib_item.itemstatus, dp_atrib_item.itemmotivo, dp_atrib_item.itemposicao, dp_funcionarios.nome, dp_motivos.nome as motivo  FROM dp_atrib_item , dp_funcionarios , dp_motivos  WHERE dp_atrib_item.itemfunc = dp_funcionarios.id and dp_atrib_item.itemativo = 1 and dp_motivos.id = dp_atrib_item.itemmotivo and dp_atrib_item.turmaid = :turma order by itemposicao");
 ?>      
            <div class="box-header">            
              <div class="row">
                <table id="tabela" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Turma</th>
                      <th>Periodo</th>                      
                      <th>Status</th>
                      <th>Atribuições</th>                      
                      <th><a href="javascript:;" class="btn btn-xs btn-primary" onclick="editaturma(0)"><i class="fa fa-plus"></i>Novo</a></th>                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Turma</th>
                      <th>Periodo</th>                      
                      <th>Status</th>
                      <th>Atribuições</th>                      
                      <th>Ação</th>                      
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                    $cont = 0;
                    $cal = $con->query($sql);
                    while($linha = $cal->fetch(PDO::FETCH_ASSOC)){
                    ++$cont;
                    ?>                    
                    <tr <?php if ($cont % 2){ echo "class=\"info\"";} ?>>                                           
                      <td><?php echo utf8_encode($linha["grupo"]." ".$linha["turmanome"]); ?></td>
                      <td><?php echo utf8_encode($linha["periodo"]."(".$linha["entrada"]."-".$linha["saida"].")"); ?></td>                      
                      <td><?php echo $st[$linha["turmastatus"]]; ?></td>
                      <td><?php
                          if ($linha["turmaqtde"] > 0){
                          $rs->execute([':turma' => $linha["turmaid"]]);
                          $cont = 0;
                          foreach ($rs as $row) {
                            echo $nu[++$cont].$row["nome"];
                            if ($row["itemmotivo"] == 1){
                              echo '<small class="label label-success">'.utf8_encode($row["motivo"])."</small><br>";
                            } else {
                              echo '<small class="label label-warning">'.utf8_encode($row["motivo"])."</small><br>";
                            }                            
                          }
                         }
                        ?></td>                      
                      <td><a href="javascript:;" class="btn btn-xs btn-primary" onclick="editaturma(<?php echo $linha["turmaid"]; ?>)"><i class="fa fa-edit"></i>Editar</a></td>
                    </tr>
                    <?php
                    }            
                    ?>                  
                  </tbody>
                </table>
                
              </div>            
            </div><!-- /.box-body -->
      
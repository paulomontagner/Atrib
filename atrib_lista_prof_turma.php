<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
$nu = array('1' => '<small class="label label-success">Titular</small>', '2' => '<small class="label label-info">1º Suplente</small>', '3' => '<small class="label label-warning">2º Suplente</small>' );                
$turma = $_POST["turma"];
 ?>      
            <div class="box-header">            
              <div class="row">
                <table id="tabela" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Matricula</th>
                      <th>Nome</th>                      
                      <th>Status</th>
                      <th>Atribuições</th>
                      <th><a href="javascript:;" class="btn btn-xs btn-primary" onclick="editaatribprof(<?php echo "0,".$turma; ?>)"><i class="fa fa-plus"></i>Novo</a></th>                                            
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Matricula</th>
                      <th>Nome</th>                      
                      <th>Status</th>
                      <th>Atribuições</th>                      
                      <th>Ações</th>                                            
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                    $cont = 0;
                    $rs = $con->query("SELECT dp_atrib_item.itemid, dp_atrib_item.turmaid, dp_atrib_item.itemstatus, dp_atrib_item.itemfunc, dp_atrib_item.itemmotivo, dp_atrib_item.itemposicao, dp_funcionarios.nome, dp_funcionarios.codmatricula, dp_motivos.nome as motivo  FROM dp_atrib_item , dp_funcionarios , dp_motivos  WHERE dp_atrib_item.itemfunc = dp_funcionarios.id and dp_atrib_item.itemativo = 1 and dp_motivos.id = dp_atrib_item.itemmotivo and dp_atrib_item.turmaid = ".$turma." order by itemposicao");
                    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
                    ++$cont;
                    ?>                    
                    <tr <?php if ($cont % 2){ echo "class=\"info\"";} ?>>                                           
                      <td><?php echo $linha["codmatricula"]; ?></td>
                      <td><?php echo utf8_encode($linha["nome"]); ?></td>                      
                      <td><?php echo $nu[$linha["itemposicao"]]; ?></td>
                      <td><?php
                            if ($linha["itemmotivo"] == 1){
                              echo '<small class="label label-success">'.utf8_encode($linha["motivo"])."</small><br>";
                            } else {
                              echo '<small class="label label-danger">'.utf8_encode($linha["motivo"])."</small><br>";
                            }                                                      
                        ?></td>
                      <td><a href="javascript:;" class="btn btn-xs btn-success" onclick="imprime(<?php echo $linha["itemfunc"].",".$linha["turmaid"]; ?>)"><i class="fa fa-print"></i>Imprimir</a>
                          <a href="javascript:;" class="btn btn-xs btn-primary" onclick="editaatribprof(<?php echo $linha["itemid"].",".$linha["turmaid"]; ?>)"><i class="fa fa-edit"></i>Editar</a>
                          <a href="javascript:;" class="btn btn-xs btn-danger" onclick="cancelaatrib(<?php echo $linha["itemfunc"].",".$linha["turmaid"]; ?>)"><i class="fa fa-trash"></i>Excluir</a></td>                                            
                    </tr>
                    <?php
                    }            
                    ?>                  
                  </tbody>
                </table>
                
              </div>            
            </div><!-- /.box-body -->
      
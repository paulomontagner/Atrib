<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
$st = array('0' => '<small class="label label-danger">Inativa</small>', '1' => '<small class="label label-success">Ativa</small>');
$sql = "SELECT dp_atrib_sub.*, locais.nome, dp_turnos.grupo, dp_turnos.nome as periodo, dp_turnos.entrada, dp_turnos.saida FROM dp_atrib_sub, locais, dp_turnos WHERE locais.id = dp_atrib_sub.sublocal and dp_turnos.id = dp_atrib_sub.subperiodo and dp_atrib_sub.turmaid = ".$_POST["turma"];
 ?>      
            <div class="box-header">            
              <div class="row">
                <table id="tabela" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Local</th>
                      <th>Periodo</th>                      
                      <th>1º Ano</th>
                      <th>2º Ano</th>
                      <th>3º Ano</th>
                      <th>4º Ano</th>
                      <th>5º Ano</th>
                      <th>Horas de docência</th>                                           
                      <th><a href="javascript:;" class="btn btn-xs btn-primary" onclick="editasub(0)"><i class="fa fa-plus"></i>Novo</a></th>                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Local</th>
                      <th>Periodo</th>                      
                      <th>1º Ano</th>
                      <th>2º Ano</th>
                      <th>3º Ano</th>
                      <th>4º Ano</th>
                      <th>5º Ano</th>
                      <th>Horas de docência</th>                      
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
                      <td><?php echo utf8_encode($linha["nome"]); ?></td>
                      <td><?php echo utf8_encode($linha["periodo"]."(".$linha["entrada"]."-".$linha["saida"].")"); ?></td>                      
                      <td><?php echo $linha["a"]; ?></td>
                      <td><?php echo $linha["b"]; ?></td>
                      <td><?php echo $linha["c"]; ?></td>
                      <td><?php echo $linha["d"]; ?></td>
                      <td><?php echo $linha["e"]; ?></td>
                      <td><?php echo $linha["f"]; ?></td>                      
                      <td><a href="javascript:;" class="btn btn-xs btn-primary" onclick="editasub(<?php echo $linha["subid"]; ?>)"><i class="fa fa-edit"></i></a></td>
                    </tr>
                    <?php
                    }            
                    ?>                  
                  </tbody>
                </table>
                
              </div>            
            </div><!-- /.box-body -->
      
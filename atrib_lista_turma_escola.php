<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");                
$status = $_REQUEST["st"];
$sql = "SELECT dp_atrib_classifica.matricula, dp_atrib_classifica.nome as professor, dp_atrib_classifica.classifica, dp_atrib_escola.nome, grupos.grupo, dp_turnos.grupo as mn, dp_turnos.entrada, dp_turnos.saida, dp_atrib_escola.id, dp_motivos.nome as motivo FROM dp_atrib_escola, grupos, dp_atrib_classifica, dp_turnos, dp_motivos WHERE dp_atrib_escola.grupo = grupos.id and dp_atrib_classifica.funcid = dp_atrib_escola.funcionario and dp_turnos.id = dp_atrib_escola.periodo and dp_motivos.id = dp_atrib_escola.motivo and dp_atrib_escola.status = 1 and dp_atrib_escola.local = ".$_SESSION["localsme"];
switch ($status) {
  case 0:
    $sql .= " order by dp_atrib_classifica.classifica;";
    break;
  case 1:
    $sql .= " and dp_atrib_escola.funcionario = 0 order by dp_atrib_classifica.classifica;";
    break;
  case 2:
    $sql .= " and dp_atrib_escola.funcionario > 0 and dp_atrib_escola.motivo = 1 order by dp_atrib_classifica.classifica;";
    break;
  case 3:
    $sql .= " and dp_atrib_escola.funcionario > 0 and dp_atrib_escola.motivo > 1 order by dp_atrib_classifica.classifica;";
    break;
}
 ?>      
            <div class="box-header">            
              <div class="row">
                <table id="tabela" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Matricula</th>
                      <th>Professor</th>                      
                      <th>Classificação</th>
                      <th>Turma</th>                      
                      <th>Periodo</th>
                      <th>Status</th>
                      <th>Ações</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $cont = 0;
                    $cal = $con->query($sql);
                    while($linha = $cal->fetch(PDO::FETCH_ASSOC)){
                    ++$cont;
                    ?>                    
                    <tr <?php if ($cont % 2){ echo "class=\"info\"";} ?> >                                           
                      <td><?php echo $linha["matricula"]; ?></td>
                      <td><?php echo utf8_encode($linha["professor"]); ?></td>                      
                      <td><?php echo $linha["classifica"]."º"; ?></td>                      
                      <td><?php echo utf8_encode($linha["grupo"]." ".$linha["nome"]); ?></td>
                      <td><?php echo utf8_encode($linha["mn"])." (".$linha["entrada"]."-".$linha["saida"].")"; ?></td>
                      <td><?php echo utf8_encode($linha["motivo"]); ?></td>                      
                      <td><a href="javascript:;" onclick="editaturma(<?php echo $linha["id"]; ?>)"><i class="fa fa-edit"></i></a>
                      <a href="javascript:;" onclick="deletaturma(<?php echo $linha["id"]; ?>)"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <?php
                    }            
                    ?>                  
                  </tbody>
                </table>
                
              </div>            
            </div><!-- /.box-body -->
      
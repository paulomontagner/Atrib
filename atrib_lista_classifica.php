<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");                
$tipo = ($_POST["tipo"] == 0)? "> ".$_POST["tipo"] : "= ".$_POST["tipo"];
$rs = $con->query("select c.*, t.tipo as tpn from dp_atrib_classifica c, dp_tipo_professor t where c.turma = 0 and c.tipo = t.id and c.tipo ".$tipo." order by classifica");
 ?>                  
    <div class="row">
      <table id="tabela" class="table table-bordered">
        <thead>
          <tr>
            <th>Classificação</th>
            <th>Matricula</th>
            <th>Nome</th>                      
            <th>Tipo</th>
            <th>Atribuições</th>                                            
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Classificação</th>
            <th>Matricula</th>
            <th>Nome</th>                      
            <th>Tipo</th>
            <th>Atribuições</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
          $cont = 0;
          while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
          ++$cont;
          ?>                    
          <tr <?php if ($cont % 2){ echo "class=\"info\"";} ?>>                                           
            <td><?php echo $linha["classifica"]; ?></td>
            <td><?php echo $linha["matricula"]; ?></td>
            <td><?php echo utf8_encode($linha["nome"]); ?></td>
            <td><?php echo utf8_encode($linha["tpn"]); ?></td>                                            
            <td><a href="javascript:;" class="btn btn-primary" onclick="painel(<?php echo $linha["funcid"].",".$linha["tipo"]; ?>)"><i class="fa fa-search"></i></a>                          
            </td>
          </tr>
          <?php
          }            
          ?>                  
        </tbody>
      </table>                
    </div>            
      
      
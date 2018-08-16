<?php
@session_start();
include_once("../include/base.php");
include_once("../include/funcoes.php");
include_once("inc_atrib.php");
$salto = "../";
$arquivo = basename ($_SERVER['PHP_SELF'],".php");
include_once("../include/cabec.php");
carregarCSS(array("bootstrap.min","font-awesome.min","ionicons.min","AdminLTE","_all-skins.min","dataTables.bootstrap","alertify.core","alertify.default"),$salto);
$sql = "SELECT dp_atrib_turma.turmaid, dp_atrib_turma.turmagrupo, dp_atrib_turma.turmanome, locais.nome, locais.dificil, grupos.grupo, dp_turnos.grupo grupo1, dp_turnos.nome as periodo, dp_turnos.entrada, dp_turnos.saida, (select count(itemid) from dp_atrib_item where itemativo = 1 and turmaid = dp_atrib_turma.turmaid) as qtde FROM dp_atrib_turma , locais , grupos , dp_turnos  WHERE dp_atrib_turma.turmaativo = 1 and dp_atrib_turma.turmalocal = locais.id and grupos.id = dp_atrib_turma.turmagrupo and dp_turnos.id = dp_atrib_turma.turmaperiodo and dp_atrib_turma.turmastatus = 1 and dp_atrib_turma.turmaano = '$ano'";
$ativas = " and dp_atrib_turma.turmaqtde = 0 order by nome;";
$tipo = $_REQUEST["tipo"];
$idfunc = $_REQUEST["idfunc"];
switch ($tipo) {
	case 1:	$sql .= " and dp_turnos.horasdia = 5 and dp_atrib_turma.turmagrupo != 21".$ativas; break; //30 horas concursado
	case 2:	$sql .= " and dp_turnos.horasdia = 4".$ativas; break; //24 horas estavel
	case 3:	$sql .= " and dp_turnos.horasdia = 6".$ativas; break; //Adjunto
	case 4:	$sql .= " and dp_turnos.horasdia = 5 and dp_atrib_turma.turmagrupo != 21".$ativas; break; //30 horas disciplinas
	case 5:	$sql .= " and dp_atrib_turma.turmagrupo = 21"; break; //Educação Fisica 
	case 6:	$sql .= " and dp_turnos.horasdia = 4".$ativas; break; //24 horas clt
	case 7:	$sql .= " and dp_turnos.horasdia = 4".$ativas; break; //24 horas conc	
}
$atrib = array('0' => '<small class="label label-success">Livre</small>' , '1' => '<small class="label label-primary">Atribuição do suplente</small>', '2' => '<small class="label label-danger">Atribuição do 2º Suplente</small>');
$sn = array('0' => '<small class="label label-danger">Não</small>' , '1' => '<small class="label label-success">Sim</small>');
$cor = 0;
?>
<style>  
  .sim {
    background: #F2F5F9;
    color: #000000;
    font-weight: bold;
   }
   .nao {
   	background: #104E8B;
   	color: #ffffff;
   	font-weight: bold;
   }
</style>
</head>
<body class="skin-blue layout-top-nav">
    <div class="wrapper">    	
    	<div class="content-wrapper">			
	        <section class="content">
	          <!-- Small boxes (Stat box) -->
	          <div class="row">
	            <div class="box-header">
					<table id="tabela" class="table table-bordered">
						<thead>
							<tr>
								<th>Escola</th>
								<th>grupo</th>
								<th>Periodo</th>
								<th>Horário</th>
								<th>Atribuições</th>
								<th>Difícil lotação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>								
								<th>Escola</th>
								<th>grupo</th>
								<th>Periodo</th>
								<th>Horário</th>
								<th>Atribuições</th>
								<th>Difícil lotação</th>
							</tr>
						</tfoot>
						<tbody>
						<?php
						$rs = $con->query($sql);
						foreach ($rs as $row) { ?>
							<tr <?php if (++$cor % 2 == 0) { echo "class=\"sim\"";} else { echo "class=\"nao\"";}  ?> >								
								<td><?php echo utf8_encode($row["nome"]); ?></td>
								<td><?php echo utf8_encode($row["grupo"]." ".$row["turmanome"]); ?></td>
								<td><?php echo utf8_encode($row["periodo"]); ?></td>
								<td><?php echo $row["entrada"]." - ".$row["saida"]; ?></td>
								<td><a href="javascript:;" onclick="mostraprof(<?php echo $row["turmaid"] ?>)"><?php echo $atrib[$row["qtde"]]; ?></a></td>
								<td><?php echo $sn[$row["dificil"]]; ?></td>			
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			  </div>	
	        </section>
	    </div>
	</div>
   
<?php
//include_once("../include/rodape.php");	
carregarJS(array("jQuery-2.1.3.min","bootstrap.min","jquery.slimScroll.min","fastclick.min","app.min", "jquery.dataTables","dataTables.bootstrap","jquery.validate.min","alertify.min","../script/painel_auto","jquery.forms"),$salto);
?>
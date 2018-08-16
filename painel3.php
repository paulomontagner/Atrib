<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    <link rel="stylesheet" type="text/css" href="css/data_tables.css">
    <script type="text/javascript">
	function janela(URL, title)
     {
	    window.open(URL,title,'scrollbars=yes,width=800,height=600,left=0,top=0');
     }
    </script>
	<script type="text/javascript" language="javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
    <script type="text/javascript">
    function get(turma, tipo) {
	url = 'atribui_turma.php?turma=' + turma + '&docente=<?php echo $_GET['matricula'];?>&id_docente=<?php echo $_GET['id'];?>&tipo=' + tipo;
	onde = 'conteudo';
	valor = '';
    window.opener.carrega(url, valor , onde);
	window.close();
    }
    </script>
	<script type="text/javascript" language="javascript" class="init">	
	$(document).ready(function() {
		$('#example').dataTable({
        "oLanguage": {
    "sProcessing": "Aguarde enquanto os dados são carregados ...",
    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
    "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
    "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
    "sInfoFiltered": "",
    "sSearch": "Procurar",
    "oPaginate": {
       "sFirst":    "Primeiro",
       "sPrevious": "Anterior",
       "sNext":     "Próximo",
       "sLast":     "Último"
    }
 } })}); 
	</script>
</head>

<body>
<?php
$tipo = $_GET['tipo'];
switch($tipo){
case 1: //professor 24horas somente vagas livres
$condicao = " and p.horasdia = 4 and t.titular = '99999' and g.id != 15 order by t.id"; 
break;
case 2: //professor 24horas todas as atribuição
$condicao = " and p.horasdia = 4 and g.id != 15 order by t.id"; 
break;
case 3: //professor 30horas somente vagas livres
$condicao = " and p.horasdia = 5 and t.titular = '99999' and g.id != 15 order by t.id"; 
break;
case 4: //professor 30horas todas as atribuição
$condicao = " and p.horasdia = 5 and g.id != 15 order by t.id"; 
break;
case 5: //Todas
$condicao = " order by t.id"; 
break;
case 6: //Educação fisica
$condicao = " and t.grupo = 15 order by t.id"; 
break;
case 7: //Adjunto
$condicao = " and t.grupo = 20 order by t.id"; 
break;

}
include_once("estrutura/base.php");
$query = "SELECT t.id, l.nome, l.dificil, g.grupo, CONCAT(p.nome, '(', p.entrada, '-', p.saida, ')(',p.grupo,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, f.nome as nome_titular, t.afastamento, m.nome as motivo, t.suplente FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s, funcionarios f WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.titular = f.codmatricula and t.status = s.id and t.local = l.id and t.mostra = 1 and t.status = 0".$condicao.";";
$result = mysql_query($query) or die("Erro ao Executar a Query : ". mysql_error());
?>
<body class="dt-example">
	<div class="container">
		<section>
			<h1>Turmas disponiveis</h1>
			<table id="example" class="display" cellspacing="0" width="100%" style="font-size: 1em;">
				<thead>
					<tr>
						<th>C&oacute;digo</th>
						<th>Local</th>
						<th>Grupo</th>
						<th>Periodo</th>
						<th>HTPC</th>
						<th>Titular</th>
						<th>Motivo</th>
                        <th>Status</th>
					</tr>
				</thead>
<?php
      
echo "<tbody>\n";
        while ($row = mysql_fetch_assoc($result)) { 
            if ($row['dificil'] == 1 ) {
			$dificil = "<img src='imagens/img/Alert.png' alt='Dificil Lota&ccedil;&atilde;o'>";
			} else { $dificil = ""; }
			echo "<tr>\n";
			if ($row['titular'] == '99999') {
			echo "<td><a href='#' onclick='get(".$row['id'].",0);'>".$row['id']."</td> \n";
			$titular = 'vago'; $status = 1;
			} else { if ($row['suplente'] == '99999') {
			echo "<td><a href='#' onclick='get(".$row['id'].",1);'>".$row['id']."</td> \n";
			$titular = $row['nome_titular']; $status = 2;} else {
			echo "<td><a href='#' onclick='get(".$row['id'].",6);'>".$row['id']."</td> \n";
			$titular = $row['nome_titular'];$status = 3;	
			}}
            echo "<td>" . utf8_encode($row['nome']) . $dificil . "</td> \n";
            echo "<td>" . utf8_encode($row['grupo']) . "</td> \n";
			echo "<td>" . utf8_encode($row['periodo']) . "</td> \n";
			echo "<td>" . $row['htpc'] . "</td> \n";
            echo "<td>" . $titular . "</td> \n";
			echo "<td>" . $row['motivo'];
			if ($status > 1) {
			echo "<a href=\"#\" onclick=\"janela('afastamento.php?id=".$row['titular']."','Delathes de afastamento')\"><img src=\"imagens/img/Briefcase.png\" /></a>";
			}
			echo "</td> \n";
			echo "<td>" . $status . " Atribuição</td> \n";
			echo "</tr>\n";
        }
        echo "</tbody>\n";
        ?>
				<tfoot>
					<tr>
						<th>C&oacute;digo</th>
						<th width='250px'>Local</th>
						<th>Grupo</th>
						<th>Periodo</th>
						<th>HTPC</th>
						<th>Titular</th>
						<th>Motivo</th>
                        <th>Status</th>
                    </tr>
				</tfoot>				
		</table>
<?php
	mysql_close();
?>
</div>
</body>
</html>
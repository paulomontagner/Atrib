<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    <link rel="stylesheet" type="text/css" href="css/data_tables.css">
	<script type="text/javascript" language="javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="scripts/jquery.dataTables.js"></script>
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
include_once("estrutura/base.php");
$query = "SELECT t.id, l.nome, g.grupo, CONCAT('(', p.entrada, '-', p.saida, ')(',p.horasdia,')') as periodo, concat(h.dia, ' (', h.inicio, '-', h.fim, ')') as htpc, t.titular, t.afastamento, m.nome as motivo, t.suplente FROM turmas t, locais l, grupos g, periodo p, htpc h, motivos m, status s WHERE t.local = l.id and t.grupo = g.id and t.periodo = p.id and t.htpc = h.id and t.afastamento = m.id and t.status = s.id and t.local = l.id and t.mostra = 1";
$result = mysql_query($query) or die("Erro ao Executar a Query : ". mysql_error());
?>
<body class="dt-example">
	<div class="container">
		<section>
			<h1>Turmas disponiveis</h1>
			<table id="example" class="display" cellspacing="0" width="80%" style="font-size: 1em;">
				<thead>
					<tr>
						<th>C&oacute;digo</th>
						<th width='250px'>Local</th>
						<th>Grupo</th>
						<th>Periodo</th>
						<th>HTPC</th>
						<th>Titular</th>
						<th>Motivo</th>
					</tr>
				</thead>
<?php
      
echo "<tbody>\n";
        while ($row = mysql_fetch_assoc($result)) {                      
            echo "<tr>\n";
            echo "<td>" . $row['id'] . "</td> \n";
            echo "<td width='250px'>" . utf8_encode($row['nome']) . "</td> \n";
            echo "<td width='250px'>" . $row['grupo'] . "</td> \n";
			echo "<td>" . $row['periodo'] . "</td> \n";
			echo "<td>" . $row['htpc'] . "</td> \n";
            echo "<td>" . $row['titular'] . "</td> \n";
			echo "<td>" . $row['motivo'] . "</td> \n";
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
					</tr>
				</tfoot>				
		</table>
<?php
	mysql_close();
?>
</div>
</body>
</html>
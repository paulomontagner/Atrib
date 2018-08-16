<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Demanda de atendimentos por regi&atilde;o</title>
	    <script type="text/javascript" src="../scripts/grp/jquery.min.js" ></script>
		<script type="text/javascript">
        $(function () {
    	
    	// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		
		// Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Atendimentos cadastrados no sistema'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>:'+ this.y +'->:'+ this.percentage.toFixed(2) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
				<?php
                require_once('../estrutura/base.php');
                //$SQL = "SELECT l.nome, count(t.id) FROM turmas t, locais l WHERE t.local = l.id group by l.nome" 
                $SQL = "select r.regiao as regiao, count(d.id) as qtde from sme.regioes r, sme.de_inscritosdemanda d, sme.bairros b where d.bairro = b.id and r.id = b.regiao and d.situacao = 1 group by r.regiao order by qtde";
				
                $Result = mysql_query($SQL, $conexao);
                while ($row = mysql_fetch_object($Result)){
                $cidade[] = $row->regiao;
                $count[] = $row->qtde;
                }
                $contador = count($cidade);
                for($i=0;$i<$contador;$i++){
			    if ($i < $contador-1) {
			    echo "['".$cidade[$i]."',".$count[$i]."],";
			    } else {
			    echo "['".$cidade[$i]."',".$count[$i]."]";
                } }
				?>
                ]
            }]
        });
    });
    

		</script>
	</head>
	<body>


<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>

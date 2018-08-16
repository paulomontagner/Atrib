<?php
include_once("estrutura/base.php");
$result = mysql_query("SELECT a.id, a.funcionario, DATE_FORMAT(a.inicio, '%d/%m/%Y') AS iniciof, DATE_FORMAT(a.retorno, '%d/%m/%Y') AS retornof, a.motivo, f.nome, f.codmatricula, f.id FROM sme.afastamentos a INNER JOIN sme.funcionarios f ON f.id = a.funcionario WHERE f.codmatricula = ".$_REQUEST['id']." order by iniciof desc;", $conexao);
$total = mysql_num_rows($result);
?>
<html>
<body>
<table width="740" border="0" align="left">
			<tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
			  <td width="7%" align="left" bgcolor="#FFFFC0">Matr&iacute;cula</td>
			  <td width="31%" align="left" bgcolor="#FFFFC0">Nome </td>
			  <td width="29%" align="left" bgcolor="#FFFFC0">Motivo</td>
			  <td width="10%" align="left" bgcolor="#FFFFC0">In&iacute;cio</td>
			  <td width="11%" align="left" bgcolor="#FFFFC0">Fim</td>
			  <td width="5%" align="left" bgcolor="#FFFFC0">Dias</td>
			</tr>
			<?php for($i=0; $i<$total; $i++){ ?>
			<tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
				<td align="left"><?php
					echo mysql_result($result, $i, 'codmatricula');?></td>
				<td align="left"><?php
					echo mysql_result($result, $i, 'nome');?></td>
				<td align="left">
					<?php
                    echo mysql_result($result, $i, 'motivo');?>
                </td>
				<td align="left">
					<?php
                    echo mysql_result($result, $i, 'iniciof');
					?></td>
				<td align="left"><?php
                    echo mysql_result($result, $i, 'retornof');
					?></td>
				<td align="left"><?php
                    echo mysql_result($result, $i, 'periodo');
			}?></td>
                    </tr>
                    </table>
                    </body>
                    </html>
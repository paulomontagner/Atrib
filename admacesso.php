 
  	<div id="tela">
	<?php
	include_once("estrutura/base.php");
		$edit = $_REQUEST['edit'];
	
		if($edit == "true")	$edresult = mysql_query("SELECT * FROM itens WHERE id = ".$id.";", $conexao);
	
		$acesso = mysql_query("SELECT menu, id, item FROM menus ORDER BY menu, item;", $conexao);
		$qacesso = mysql_num_rows($acesso);
	?>
      <p class="titulo">Gerenciar Locais </p>
	  <form action="inseriracesso.php" method="post" name="acesso" target="_self">
      <table width="765" border="0" cellspacing="0" cellpadding="5">
		<tr>
          <td width="184" bgcolor="#990000" class="titulobranco">Local: </td>
          <td width="561">
		  <?php $regresult = mysql_query("SELECT nome, id FROM locais ORDER BY nome;");
		  $regnum = mysql_num_rows($regresult);?>
		  <select name="local2" id="local2" tabindex="2">
		    <option value="0">Selecione o local para edi&ccedil;&atilde;o</option>
			<?php for($l = 0; $l < $regnum; $l++) {?>
			<option value="<?php echo mysql_result($regresult, $l, id) ?>" <?php if($edit=="true"){if(mysql_result($edresult, 0, local)== mysql_result($regresult, $l, id)) echo 'selected="selected"';} ?>><?php echo mysql_result($regresult, $l, nome) ?></option>
			<?php }?>
		    </select></td>
        </tr>
		<tr>
          <td bgcolor="#990000" class="titulobranco">Menus que pode acessar:  </td>
          <td>
		  <?php for($m = 0; $m < $qacesso; $m++)
		  { ?>
		  	<label>
            <input type="checkbox" name="menu[<?php echo mysql_result($acesso, $m, id);?>]" value="<?php echo mysql_result($acesso, $m, id);?>"  <?php if($edit=="true"){if(mysql_result($edresult, 0, menu)== mysql_result($regresult, $m, id)) echo 'checked="checked""';} ?>/>
            <?php echo mysql_result($acesso, $m, menu)?>-<?php echo mysql_result($acesso, $m, item)?></label>
		  <?php }?>		   </td>
        </tr>
        <tr>
          <td><input name="id" type="hidden" id="id" value="<?php if($edit=="true") echo mysql_result($edresult, 0, id) ?>" />
            <input name="qacesso" type="hidden" id="qacessos" value="<?php $qacesso; ?>" /></td>
          <td align="right"><input type="submit" name="Submit" value="Publicar" /></td>
        </tr>
      </table>      
      </form>
      
      <?php
	  	$num_por_pagina = 10; 	
		if (!$pagina)
		{
			$pagina = 1;
		}
		$primeiro_registro = ($pagina*$num_por_pagina) - $num_por_pagina;
	
	  	$result = mysql_query("SELECT i.*, m.*, l.nome FROM itens i INNER JOIN menus m ON i.menu = m.id INNER JOIN locais l ON l.id = i.local ORDER BY l.nome LIMIT $primeiro_registro, $num_por_pagina", $conexao);
	  	$total = mysql_num_rows($result);
	  ?>
      <table width="770" border="0" align="left">
			<tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
			  <td width="33%" align="left" bgcolor="#FFFFC0">ID</td>
			  <td width="33%" align="left" bgcolor="#FFFFC0">Local</td>
			  <td width="22%" align="left" bgcolor="#FFFFC0">Menu</td>
			  
			  <td width="12%" align="left" bgcolor="#FFFFC0">&nbsp;</td>
			</tr>
			<?php for($i=0; $i<$total; $i++)
			{?>
			<tr style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
				<td align="left">
				  <?php
					echo mysql_result($result, $i, 'i.id');?></td>
				<td align="left">
					<?php echo mysql_result($result, $i, 'l.nome');?>				</td>
				<td align="left">
					<?php
                    echo (mysql_result($result, $i, 'm.item'));
					?>				</td>
				<td align="right">
					<a href="admacesso.php?edit=true&amp;id=<?php echo mysql_result($result, $i, id);?>" target="_self">Editar</a>
				</td>
			</tr>
			<?php }	?>
			<tr><td colspan="4">
			<?php	 
			$sql = "SELECT COUNT(id) AS total FROM itens";
			$query = mysql_query($sql);
			$row = mysql_fetch_array($query);
			$total = $row['total'];
			$total_paginas = $total/$num_por_pagina;
			$prev = $pagina - 1;
			$next = $pagina + 1;
			$total_paginas = ceil($total_paginas);
			$painel = "";
			for ($x=1; $x<=$total_paginas; $x++) {
				if ($x==$pagina) { 
					$painel .= " [$x] ";
			} else {
				$painel .= " <a href=\"admacesso.php?pagina=$x\">[$x]</a>";
			}
		  }
	
		echo "P&aacute;ginas $painel";
	?>
			</td></tr>
	  </table>
  	</div>
<?php include_once($pontos."rodape.php");?>

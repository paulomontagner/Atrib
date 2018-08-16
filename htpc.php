<?php
include_once("estrutura/base.php");
try
{
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result1 = mysql_query("SELECT COUNT(*) AS RecordCount FROM htpc where ativo = 1;");
		$row = mysql_fetch_array($result1);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM htpc where ativo = 1 ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$result = mysql_query("INSERT INTO htpc(dia, inicio, fim, ativo) VALUES('" . htmlentities($_POST["dia"],ENT_QUOTES, "UTF-8") . "', '" . $_POST["inicio"] . "', '". $_POST["fim"] . "', 1)");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM htpc WHERE id = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE htpc SET dia = '" . htmlentities($_POST["dia"],ENT_QUOTES, "UTF-8") . "', inicio = '" . $_POST["inicio"] . "', fim = '". $_POST["fim"] . "' WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("update htpc set ativo = 0 WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($conexao);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>
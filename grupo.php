<?php
include_once("estrutura/base.php");
try
{
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result1 = mysql_query("SELECT COUNT(*) AS RecordCount FROM grupos where ativo = 1;");
		$row = mysql_fetch_array($result1);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM grupos where ativo = 1 ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
		$result = mysql_query("INSERT INTO grupos(grupo, modalidade) VALUES('" . htmlentities($_POST["grupo"],ENT_QUOTES, "UTF-8") . "', '" . htmlentities($_POST["modalidade"],ENT_QUOTES, "UTF-8") . "')");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM grupos WHERE id = LAST_INSERT_ID();");
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
		$result = mysql_query("UPDATE grupos SET grupo = '" . htmlentities($_POST["grupo"],ENT_QUOTES, "UTF-8") . "', modalidade = '" . htmlentities($_POST["modalidade"],ENT_QUOTES, "UTF-8") . "' WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("update grupos set ativo = 0 WHERE id = " . $_POST["id"] . ";");

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
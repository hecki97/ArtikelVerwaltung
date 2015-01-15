<?php
	include(dirname(__FILE__)."/TDatabaseHandler.php");
	$databaseHandler = new TDatabaseHandler();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_REQUEST['addArt']))
			AddArtikel();
		if(isset($_REQUEST['addKat']))
			AddKategorie();
		if(isset($_REQUEST['clearArt']))
			ClearArtTable();
		if(isset($_REQUEST['clearKat']))
			ClearKatTable();
	}

	function ClearArtTable()
	{
		global $databaseHandler;
		$databaseHandler->ClearTable($databaseHandler->db['t.artikel']);
	}

	function ClearKatTable()
	{
		global $databaseHandler;
		$databaseHandler->ClearTable($databaseHandler->db['t.kategorien']);
	}

	function AddArtikel()
	{
		global $databaseHandler;
		if (!empty($_POST['pID']))
			$pID = $_POST['pID'];
		else
			$pID = uniqid();
		$databaseHandler->InsertIntoTable($databaseHandler->db['t.artikel'], $_POST['bez'], $pID, $_POST['kat']);
	}

	function AddKategorie()
	{
		global $databaseHandler;
		$kat = $_POST['kat'];
		$databaseHandler->InsertIntoTable($databaseHandler->db['t.kategorien'], $kat);
	}

	function DropDown()
	{
		global $databaseHandler;
		$array = $databaseHandler->SelectArrayFromTable($databaseHandler->db['t.kategorien']);
		$int = $databaseHandler->SelectFromTable($databaseHandler->db['t.kategorien'], false);

		$select  = "<select name='kat'>";
		for ($i = 0; $i < $int; $i++) { 
			$select .= "<option value=".$array[$i]['kategorie'].">".$array[$i]['kategorie']."</option>";
		}
		$select .= "</select>";

		return $select;
	}
?>
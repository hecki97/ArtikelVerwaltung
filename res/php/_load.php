<?php
	include(dirname(__FILE__)."/TDatabaseHandler.php");
	$databaseHandler = new TDatabaseHandler();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_REQUEST['update']))
			UpdateDB();
	}

	function UpdateDB()
	{
		global $databaseHandler;
		$databaseHandler->UpdateTable($databaseHandler->db['t.artikel'], "bezeichnung", $_POST['bez']);
		$databaseHandler->UpdateTable($databaseHandler->db['t.artikel'], "produktID", $_POST['pID']);
		$databaseHandler->UpdateTable($databaseHandler->db['t.artikel'], "kategorie", $_POST['kat']);		
		
		#Debug
		var_dump($_POST['bez']);
		var_dump($_POST['pID']);
		var_dump($_POST['kat']);
	}

	function LoadDB()
	{
		global $databaseHandler;
		$int = $databaseHandler->SelectFromTable($databaseHandler->db['t.artikel'], false);
		$arrayArt = $databaseHandler->SelectArrayFromTable($databaseHandler->db['t.artikel']);
		$arrayKat = $databaseHandler->SelectArrayFromTable($databaseHandler->db['t.kategorien']);
		$katInt = $databaseHandler->SelectFromTable($databaseHandler->db['t.kategorien'], false);

		$text  = "<table border='1' align='center'>";
		$text .= "<tr><td>ID</td><td>Bezeichnung</td><td>ProduktID</td><td>Kategorie</td>";
		for ($i = 0; $i < $int; $i++) {
			$select  = "<select name='kat[]'>";
			$select .= "<option value=".$arrayArt[$i]['kategorie'].">".$arrayArt[$i]['kategorie']."</option>";
			for ($j = 0; $j < $katInt; $j++) { 
				if ($arrayArt[$i]['kategorie'] != $arrayKat[$j]['kategorie'])
					$select .= "<option value=".$arrayArt[$i]['kategorie'].">".$arrayKat[$j]['kategorie']."</option>";
			}
			$select .= "</select>";

			$text .= "<tr>";
			$text .= "<td>".$arrayArt[$i]['id']."</td>";
			$text .= "<td><input type='text' name='bez[]' value=".$arrayArt[$i]['bezeichnung']."></td>";
			$text .= "<td><input type='text' name='pID[]' value=".$arrayArt[$i]['produktID']."></td>";
			$text .= "<td>".$select."</td>";
			$text .= "<tr>";
		}
		$text .= "</table>";

		return $text;
	}
?>
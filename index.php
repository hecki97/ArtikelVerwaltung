<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php include(dirname(__FILE__)."/res/php/_index.php"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Artikel Verwaltung</title>
		<link href="res/css/style.css" rel="stylesheet">
	</head>
	<body>
		<h1>Artikel Verwaltung</h1>

		<table border="1" align="center">
			<tr><th>Datenbank:</th></tr>
			<tr><td>Status: <?=$databaseHandler->CheckConnection(); ?></td></tr>
			<tr><td><?=$databaseHandler->SelectFromTable($databaseHandler->db['t.artikel'], false); ?> Artikel aktuell vorhanden</td></tr>
			<tr><td><?=$databaseHandler->SelectFromTable($databaseHandler->db['t.kategorien'], false); ?> Kategorie(n) aktuell vorhanden</td></tr>
		</table>

		<h2>Artikel hinzufügen:</h2>
		<form action="./index.php" method="post">
			<table border="1" align="center">
				<tr><th>Bezeichnung</th><th>ProduktID (wenn leer md5)</th><th>Kategorie</th></tr>
				<tr><td><input type="text" name="bez"></td><td><input type="text" name="pID"></td><td><?=DropDown(); ?></td></td></tr>
			</table>
			<input type="submit" name="addArt" value="Add to DB!">
			<script>
				function show_confirm_clear()
				{
				   	return confirm("Wollen Sie die Tabelle wirklich leeren?");
				}
			</script>
			<input type="submit" onclick="return show_confirm_clear();" name="clearArt" value="Clear Table!">
		</form>

		<h2>Kategorien hinzufügen:</h2>
		<form action="./index.php" method="post">
			<input type="text" name="kat">
			<input type="submit" name="addKat" value="Add Kategorie!">
			<script>
				function show_confirm_clear()
				{
				   	return confirm("Wollen Sie die Tabelle wirklich leeren?");
				}
			</script>
			<input type="submit" onclick="return show_confirm_clear();" name="clearKat" value="Clear Table!">
		</form>

		<h2>Artikel anzeigen:</h2>
		<form action="./load.php" method="post">
			<input type="submit" name="eintragen" value="Button!">
		</form>


	</body>
</html>
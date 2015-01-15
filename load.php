<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php include(dirname(__FILE__)."/res/php/_load.php"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Artikel</title>
		<link href="res/css/style.css" rel="stylesheet">
	</head>
	<body>
		<h1>Artikel Übersicht:</h1>
		<form action="./load.php" method="post">
			<?=loadDB(); ?>
			<input type="submit" name="update" value="Update!">
		</form><br/>

		<form action="./index.php" method="post">
			<input type="submit" name="back" value="Zurück!">
		</form>
	</body>
</html>
<?php
	/**
	* TDatabaseHandler 
	*/
	class TDatabaseHandler
	{
		public $db = array();
		protected $verbindung;

		function TDatabaseHandler()
		{
			$this->db = json_decode(file_get_contents(dirname(__FILE__)."/../config/database.config"), true);
			$verbindung = @mysql_connect($this->db['db.config']['connection'], $this->db['db.config']['login'] , $this->db['db.config']['pw']) or die("connection"); 
			@mysql_select_db($this->db['db.config']['database'], $verbindung) or die ("DB");
		}

		public function CheckConnection()
		{
			if (@mysql_connect($this->db['db.config']['connection'], $this->db['db.config']['login'] , $this->db['db.config']['pw']))
				return "<span style='color: green;'>verbunden</span>";
			else
				return "<span style='color: red;'>getrennt</span>";
		}

		public function ClearTable($_table)
		{
			mysql_query("TRUNCATE TABLE `".$_table."`");
		}

		public function UpdateTable($_table, $_name ,$_ar)
		{
			$_id = 1;
			foreach ($_ar as $__ar) {
				mysql_query("UPDATE `".$_table."` SET `".$_name."`='".$__ar."' WHERE id='".$_id."'");
				$_id++;
			}
		}

		public function InsertIntoTable($_table)
		{
            switch (func_num_args()) {
            	case 2:
            		$eintrag = mysql_query("INSERT INTO `".$_table."` (kategorie) VALUES ('".func_get_arg(1)."')");
            		break;
            	
	            case 4:
	            	$eintrag = mysql_query("INSERT INTO `".$_table."` (bezeichnung, produktID, kategorie) VALUES ('".func_get_arg(1)."', '".func_get_arg(2)."', '".func_get_arg(3)."')");
	            	break;
            }

            if (@$eintrag)
            	print("Erfolgreich in Datenbank eingetragen!");
            else
            	print("Konnte nicht in Datenbank eingetragen werden!");
		}

		public function SelectArrayFromTable($_table)
		{
			$result = mysql_query("SELECT * FROM `".$_table."`");
			$array = array();
			$index = 0;
			while($row = mysql_fetch_assoc($result))
			{
		    	$array[$index] = $row;
		    	$index++;
			}
			return $array;
		}

		public function SelectFromTable($_table, $_fetch)
		{
			$result = mysql_query("SELECT * FROM `".$_table."`");

			if ($_fetch)
				return mysql_fetch_object($result);
			else
				return mysql_num_rows($result);
		}
	}
?>
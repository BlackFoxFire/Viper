<?php

/*
*
* PDOFactory.php
* @Auteur : Christophe Dufour
*
* Gére la connexion avec la base de données.
*
*/

namespace Viper;

class PDOFactory {
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Etablit la connexion avec la base de données.
	public static function mysqlConnexion() {echo "OOOOOOOOO";
		$db = new \PDO("mysql:host=localhost;dbname=news", "root", "");
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		
		return $db;
	}
	
}

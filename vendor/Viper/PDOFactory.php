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
	public static function mysqlConnexion($data) {
		if(empty($data['db']) || empty($data['login']))
			return null;
		
		$db = new \PDO("mysql:host=localhost;dbname=" . $data['db'], $data['login'], $data['password']);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		
		return $db;
	}
	
}

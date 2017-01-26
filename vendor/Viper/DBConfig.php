<?php

/*
*
* DBConfig.php
* @Auteur : Christophe Dufour
*
* Gère les paramètres de connexion de la base de données.
*
*/

namespace Viper;

class DBConfig {
	
	/*
		Les attributs.
		--------------
	*/
	
	// Tableau des paramètres de l'application.
	protected static $db = array();
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Retourne la configuration de la base de données.
	public static function get() {
		if(!self::$db) {
			$xml = new \DOMDocument;
			$xml->load(APP . DS . "db.xml");
			
			$elements = $xml->getElementsByTagName("define");
			
			foreach($elements as $element) {
				self::$db[$element->getAttribute("var")] = $element->getAttribute("value");
			}
		}
		
		if(!empty(self::$db)) {
			return self::$db;
		}
		
		return null;
	}
	
}

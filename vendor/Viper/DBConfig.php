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

class DBConfig extends ApplicationComponent {
	
	/*
		Les attributs.
		--------------
	*/
	
	// Tableau des paramètres de l'application.
	protected $db = array();
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Retourne la configuration de la base de données.
	public function get() {
		if(!$this->db) {
			$xml = new \DOMDocument;
			$xml->load(APP . DS . "db.xml");
			
			$elements = $xml->getElementsByTagName("define");
			
			foreach($elements as $element) {
				$this->db[$element->getAttribute("var")] = $element->getAttribute("value");
			}
		}
		
		if(!empty($this->db)) {
			return $this->db;
		}
		
		return null;
	}
	
}

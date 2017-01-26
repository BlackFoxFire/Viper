<?php

/*
*
* Config.php
* @Auteur : Christophe Dufour
*
* 
*
*/

namespace Viper;

class Config extends ApplicationComponent {
	
	/*
		Les attributs.
		--------------
	*/
	
	// Tableau des paramètres de l'application.
	protected $vars = array();
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Retourne la valeur d'un parametre de l'application.
	public function get($var) {
		if(!$this->vars) {
			$xml = new \DOMDocument;
			$xml->load(SRC . DS . $this->name . DS . "resources" . DS . "config" . DS . "app.xml");
			
			$elements = $xml->getElementsByTagName("define");
			
			foreach($elements as $element) {
				$this->vars[$element->getAttribute("var")] = $element->getAttribute("value");
			}
		}
		
		if(isset($this->vars[$var])) {
			return $this->vars[$var];
		}
		
		return null;
	}
	
}

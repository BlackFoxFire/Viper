<?php

/*
*
* Hydratator.php
* @Auteur : Christophe Dufour
*
* Permet d'initialiser les différents attributs d'un objet.
*
*/

namespace Viper;

trait Hydrator {
	
	// Initialise un objet
	public function hydratation(array $data) {
		foreach($data as $key => $value) {
			$method = "set" . ucfirst($key);
			
			if(is_callable(array($this, $method))) {
				$this->$method($value);
			}
		}
	}
	
}

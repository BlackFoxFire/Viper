<?php

/*
*
* Managers.php
* @Auteur : Christophe Dufour
*
* Crée le manageur demandé.
*
*/

namespace Viper;

class Managers {
	
	/*
		Les attributs.
		--------------
	*/
	
	// L'api utilisé pour accéder à la base de données.
	protected $api;
	
	// Le lien avec la base de données.
	protected $dao;
	
	// Tableau des modeles.
	protected $managers = array();
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function construct($api, $dao) {
		$this->api = $api;
		$this->dao = $dao;
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Retourne le modele demandé.
	public function getManagerOf($controller) {
		if(!is_string($controller) || empty($controller)) {
			throw new \InvalidArgumentException('Le module spécifié est invalide');
		}
		
		if(!isset($this->managers[$controller])) {
			$manager = $controller . "Model" . $this->api;
			$this->manager[$controller] = new $manager($this->dao);
		}
		
		return $this->managers[$controller];
	}
	
}

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
	
	// Espace de nom de l'application.
	protected $namespace = "\\";
	
	// Tableau des modeles.
	protected $managers = array();
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct($api, $dao, $ns = null) {
		$this->api = $api;
		$this->dao = $dao;
		
		if(!empty($ns) && is_string($ns)) {
			$this->namespace = "\\" . $ns . "\\Models\\";
		}
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
			$manager = $this->namespace . $controller . "Model" . $this->api;
			
			$this->managers[$controller] = new $manager($this->dao);
		}
		
		return $this->managers[$controller];
	}
	
}

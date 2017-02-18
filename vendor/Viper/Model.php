<?php

/*
*
* Model.php
* @Auteur : Christophe Dufour
*
* Classe de base pour tous les modeles de l'application.
*
*/

namespace Viper;

abstract class Model {
	
	/*
		Les attributs.
		--------------
	*/
	
	// Lien avec la base de données.
	protected $dao;
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct($dao) {
		$this->dao = $dao;
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Exécute une requête SQL.
	public function execute($sql, array $data = array()) {
		if(empty($data)) {
			$result = $this->dao->query($sql);
		}
		else {
			$result = $this->dao->prepare($sql);
			$result->execute($data);
		}
		
		return $result;
	}
	
}

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
			return $request = $this->dao->query($sql);
		}
		
		$request = $this->dao->prepare($sql);
		$request->execute($data);
		return $request;
	}
	
}

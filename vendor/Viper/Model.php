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
	public function construct($dao) {
		$this->dao = $dao;
	}
	
}

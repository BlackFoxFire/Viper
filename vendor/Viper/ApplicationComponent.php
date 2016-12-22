<?php

/*
*
* ApplicationComponent.php
* @Auteur : Christophe Dufour
*
* Classe de base pour les composantes de l'application.
*
*/

namespace Viper;

abstract class ApplicationComponent {
	
	/*
		Les attributs.
		--------------
	*/
	
	// Objet de l'application.
	protected $app;
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct(Application $application) {
		$this->app = $application;
	}
	
	/*
		Les getters.
		------------
	*/
	
	// Retourne l'objet $app.
	public function app() {
		return $this->app;
	}
	
}

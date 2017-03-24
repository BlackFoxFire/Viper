<?php

/*
*
* ExampleApplication.php
* @Auteur : Christophe Dufour
*
* Application d'exemple.
*
*/

namespace Example;

use \Viper\Application;

class ExampleApplication extends Application {
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct() {
		parent::__construct();
		
		$this->namespace = __NAMESPACE__;
		$this->name = str_replace("\\", DS, __NAMESPACE__);
	}
	
}

<?php

/*
*
* Route.php
* @Auteur : Christophe Dufour
*
* Classe modélisant une route.
*
*/

namespace Viper;

class Route {
	
	/*
		Les attributs.
		--------------
	*/
	
	protected $url;
	protected $controller;
	protected $action;
	protected $varsNames;
	protected $vars = array();
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct($url, $controller, $action, array $varsNames) {
		$this->url = $url;
		$this->controller = $controller;
		$this->action = $action;
		$this->varsNames = $varsNames;
	}
	
	/*
		Les getters.
		------------
	*/
	
	// Retourne la valeur de l'attribut $url.
	public function url() {
		return $this->url;
	}
	
	// Retourne la valeur de l'attribut $controller.
	public function controller() {
		return $this->controller;
	}
	
	// Retourne la valeur de l'attribut $action.
	public function action() {
		return $this->action;
	}
	
	// Retourne la valeur de l'attribut $varsNames.
	public function varsNames() {
		return $this->varsNames;
	}
	
	// Retourne la valeur de l'attribut $vars.
	public function vars() {
		return $this->vars;
	}
	
	/*
		Les setters.
		------------
	*/
	
	// Modifie la valeur de l'attribut $url.
	public function setUrl($url) {
		if(is_string($url)) {
			$this->url = $url;
		}
	}
	
	// Modifie la valeur de l'attribut $controller.
	public function setController($controller) {
		if(is_string($controller)) {
			$this->controller = $controller;
		}
	}
	
	// Modifie la valeur de l'attribut $action.
	public function setAction($action) {
		if(is_string($action)) {
			$this->action = $action;
		}
	}
	
	// Modifie la valeur de l'attribut $varsNames.
	public function setVarsNames(array $varsNames) {
		$this->varsNames = $varsNames;
	}
	
	// Modifie la valeur de l'attribut $vars.
	public function setVars(array $vars) {
		$this->vars = $vars;
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Retourne true si le tableau $varsNames n'est pas vide. Sinon false.
	public function hasVars() {
		return !empty($this->varsNames);
	}
	
	// Retourne la route si le masque corespond à celle-ci. Sinon false.
	public function match($url) {
		if(preg_match("#^" . $this->url . "$#", $url, $matches)) {
			return $matches;
		}
		else {
			return false;
		}
	}
	
}

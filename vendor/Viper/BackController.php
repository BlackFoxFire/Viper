<?php

/*
*
* BackController.php
* @Auteur : Christophe Dufour
*
* Controleur de base pour tous les controleurs d'une application.
*
*/

namespace Viper;

abstract class BackController extends ApplicationComponent {
	
	/*
		Les attributs.
		--------------
	*/
	
	// Objet des managers.
	protected $managers;
	
	// Le nom du contrôleur actuel.
	protected $controller = "";
	
	// L'action à éxécuter.
	protected $action = "";
	
	// Le nom du fichier vue à afficher.
	protected $viewFile = "";
	
	// La vue a afficher.
	protected $view;
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct(Application $application, $controller, $action) {
		parent::__construct($application);
		
		$this->managers = new Managers("PDO", PDOFactory::mysqlConnexion($this->app->dbConfig()->get()), $this->app->_namespace());
		$this->view = new View($application);
		$this->setController($controller);
		$this->setAction($action);
		$this->setViewFile($action);
	}
	
	/*
		Les getters.
		------------
	*/
	
	// Retourne l'objet $view;
	public function view() {
		return $this->view;
	}
	
	/*
		Les setters.
		------------
	*/
	
	// Modifie la valeur de l'attribut $controller.
	public function setController($controller) {
		if(!is_string($controller) || empty($controller)) {
			throw new \InvalidArgumentException("Le controller doit être une chaine de caractères valide");
		}
		
		$this->controller = $controller;
	}
	
	// Modifie la valeur de l'attribut $action.
	public function setAction($action) {
		if(!is_string($action) || empty($action)) {
			throw new \InvalidArgumentException("L'action doit être une chaine de caractères valide");
		}
		
		$this->action = $action;
	}
	
	// Modifie la valeur de l'attribut $viewFile.
	public function setViewFile($viewFile) {
		if(!is_string($viewFile) || empty($viewFile)) {
			throw new \InvalidArgumentException("La vue doit être une chaine de caractères valide");
		}
		
		$path = array (
			SRC . DS . $this->app->name() . DS . "resources" . DS . "views" . DS,
			SRC . DS . $this->app->name() . DS . "resources" . DS . "views" . DS . $this->controller . DS
		);
		
		$this->viewFile = $viewFile;
		$this->view->setPath($path);
		$this->view->setViewFile($this->viewFile);
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Exécute l'action demandée si celle-ci existe.
	public function execute() {
		$method = ucfirst($this->action) . "Action";
		
		if(!is_callable(array($this, $method))) {
			throw new \RuntimeException("L'action $this->action n'est pas définie sur ce controller.");
		}
		
		$this->$method($this->app->httpRequest());
	}
	
}

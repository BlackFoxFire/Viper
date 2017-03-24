<?php

/*
*
* Application.php
* @Auteur : Christophe Dufour
*
* Classe modélisant une application html avec
* ses requêtes et ses réponces.
*
*/

namespace Viper;

define("BASE_URI", dirname($_SERVER['SCRIPT_NAME']));

abstract class Application {
	
	/*
		Les attributs.
		--------------
	*/
	
	// Objet représentant une requête html.
	protected $httpRequest;
	
	// Objet représentant une réponce html.
	protected $httpResponse;
	
	// Nom de l'application.
	protected $name;
	
	// Espace de nom de l'application.
	protected $namespace;
	
	// Objet représentant l'utilisateur.
	protected $user;
	
	// Objet contenant les paramètres d'accés à la base de données.
	protected $dbConfig;
	
	// Objet contenant la configuration de l'application.
	protected $config;
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct() {
		$this->httpRequest = new HTTPRequest($this);
		$this->httpResponse = new HTTPResponse($this);
		$this->user = new User($this);
		$this->dbConfig = new DBConfig($this);
		$this->config = new Config($this);
		
		$this->name = "";
	}
	
	/*
		Les getters.
		------------
	*/
	
	// Retourne l'objet $httpRequest.
	public function httpRequest() {
		return $this->httpRequest;
	}
	
	// Retourne l'objet $httpResponse.
	public function httpResponse() {
		return $this->httpResponse;
	}
	
	// Retourne la valeur de l'attribut $name.
	public function name() {
		return $this->name;
	}
	
	// Retourne la valeur de l'attribut $namespace.
	public function _namespace() {
		return $this->namespace;
	}
	
	// Retourne la valeur de l'attribut $user.
	public function user() {
		return $this->user;
	}
	
	// Retourne la valeur de l'attribut $dbConfig.
	public function dbConfig() {
		return $this->dbConfig;
	}
	
	// Retourne la valeur de l'attribut $config.
	public function config() {
		return $this->config;
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Retourne le controleur à éxécuter.
	public function getController() {
		$router = new Router;
		
		$xml = new \DOMDocument;
		$xml->load(SRC . DS .$this->name . DS . "resources" . DS . "config" . DS . "routes.xml");
		
		$routes = $xml->getElementsByTagName("route");
		
		foreach($routes as $route) {
			$vars = array();
			
			if ($route->hasAttribute('vars')) {
				$vars = explode(',', $route->getAttribute('vars'));
			}
			
			$router->setRoutes(new Route($route->getAttribute('url'), $route->getAttribute('controller'),
																		$route->getAttribute('action'), $vars));
		}
		
		try {
			$matchedRoute = $router->getRoute($this->httpRequest->requestURI());
		}
		catch (\RuntimeException $e) {
			if ($e->getCode() == Router::NO_ROUTE) {
				$this->httpResponse->redirect404();
			}
		}
		
		$_GET = array_merge($_GET, $matchedRoute->vars());
		
		$controllerClass = $this->namespace . "\\Controllers\\" . $matchedRoute->controller() . "Controller";
		
		return new $controllerClass($this, $matchedRoute->controller(), $matchedRoute->action());
	}
	
	// Lance l'application.
	public function run() {
		$controller = $this->getController();
		$controller->execute();
		
		$this->httpResponse->setView($controller->view());
		$this->httpResponse->render();
	}
	
}

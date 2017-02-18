<?php

/*
*
* HTTPResponse.php
* @Auteur : Christophe Dufour
*
* Classe modélidant une réponce html.
*
*/

namespace Viper;

class HTTPResponse extends ApplicationComponent {
	
	/*
		Les attributs.
		--------------
	*/
	
	// La vue à afficher.
	protected $view;
	
	/*
		Les setters.
		------------
	*/
	
	// Modifie la valeur de l'attribut $view.
	public function setView($view) {
		$this->view = $view;
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Permet d'ajouter un entête html.
	public function addHeader($header) {
		header($header);
	}
	
	// Redirige vers une autre page html.
	public function redirect($location) {
		$baseURI = dirname($_SERVER['SCRIPT_NAME']);
		header("Location: " . $baseURI . $location);
		exit;
	}
	
	// Redigie vers la page d'erreur 404.
	public function redirect404() {
		$this->view = new View($this->app);
		
		$path = array (
			SRC . DS . $this->app->name() . DS . "resources" . DS . "views" . DS
		);
		$this->view->setPath($path);
		$this->view->setViewFile("error404");
		
		// $data['host'] = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		// $this->view->setData($data);
		
		$this->addHeader('HTTP/1.0 404 Not Found');
		
		$this->render();
	}
	
	// Affiche la réponce au client.
	public function render() {
		exit($this->view->render());
	}
	
	// Ajoute un cookie.
	public function setCookie($name, $value = "", $expire = 0, $path = null, $domain = null,
									$secure = false, $httpOnly = true) {
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
	
}

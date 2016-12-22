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
		header("Location: " . $location);
		exit;
	}
	
	// Redigie vers la page d'erreur 404.
	public function redirect404() {
		$this->view = new View($this->app);
		$this->view->setContentFile(__DIR__ . '/../../Errors/404.html');
		
		$this->addHeader('HTTP/1.0 404 Not Found');
		
		$this->send();
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

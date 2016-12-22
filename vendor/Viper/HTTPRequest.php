<?php

/*
*
* HTTPRequest.php
* @Auteur : Christophe Dufour
*
* Classe modélidant une requête html.
*
*/

namespace Viper;

class HTTPRequest extends ApplicationComponent {
	
	/*
		Les méthodes.
		-------------
	*/
	
	/* Fonction sur la superglobal $_GET. */
	
	// Vérifie si un élément existe dans le tableau $_GET.
	public function issetGet($key) {
		return isset($_GET[$key]);
	}
	
	// Vérifie si un élément est vide dans $_GET.
	public function emptyGet($key) {
		return empty($_GET[$key]);
	}
	
	// Retourne la valeur d'un des éléments de $_GET.
	public function get($key, $returnValue = false) {
		if(isset($_GET[$key])) {
			return $_GET[$key];
		}
		
		return $returnValue;
	}
	
	/* Fonction sur la superglobal $_POST. */
	
	// Vérifie si un élément existe dans le tableau $_POST.
	public function issetPost($key) {
		return isset($_POST[$key]);
	}
	
	// Vérifie si un élément est vide dans $_POST.
	public function emptyPost($key) {
		return empty($_POST[$key]);
	}
	
	// Retourne la valeur d'un des éléments de $_POST.
	public function post($key, $returnValue = false) {
		if(isset($_POST[$key])) {
			return $_POST[$key];
		}
		
		return $returnValue;
	}
	
	/* Fonction sur la superglobal $_COOKIE. */
	
	// Vérifie si un élément existe dans le tableau $_COOKIE.
	public function issetCookie($key) {
		return isset($_COOKIE[$key]);
	}
	
	// Retourne la valeur d'un des éléments de $_COOKIE.
	public function getCookie($key, $returnValue = false) {
		if(isset($_COOKIE[$key])) {
			return $_COOKIE[$key];
		}
		
		return $returnValue;
	}
	
	/* Autres */
	
	// Retourne la valeur de l'élément REQUEST_METHOD de la super global _SERVER.
	public function requestMethod() {
		return $_SERVER['REQUEST_METHOD'];
	}
	
	// Retourne la valeur de l'élément REQUEST_URI de la super global _SERVER.
	public function requestURI() {
		return $_SERVER['REQUEST_URI'];
	}
	
}

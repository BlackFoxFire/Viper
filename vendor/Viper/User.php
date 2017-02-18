<?php

/*
*
* User.php
* @Auteur : Christophe Dufour
*
* Classe modélidant un utilisateur de l'application.
*
*/

namespace Viper;

class User extends ApplicationComponent {
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct() {
		session_set_cookie_params(0, dirname($_SERVER['SCRIPT_NAME']), "", false, true);
		session_start();
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Ajoute ou modifie une variable de session utilisateur.
	public function set($key, $value = "") {
		$_SESSION[$key] = $value;
	}
	
	// Renvoie la valeur d'une variable de session utilisateur.
	// Si celui ci n'existe pas, c'est returnValue qui est renvoyé.
	public function get($key, $returnValue = false) {
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
		
		return $returnValue;
	}
	
	// Vérifie si un utilisateur est authentifié.
	// Retourne true si oui. Sinon false.
	public function isAuthenticated() {
		if(isset($_SESSION['isAuthenticated']) && $_SESSION['isAuthenticated'] === true)
			return true;
		
		return false;
	}
	
	// Modifie le statut d'authentifié.
	public function setAuthenticated($value = true) {
		if(!is_bool($value)) {
			throw new \InvalidArgumentException(
				"La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean");
		}
		
		$_SESSION['isAuthenticated'] = $value;
	}
	
	// Définit un message pour l'utilisateur.
	public function setMessage($value) {
		if(!empty($value) && is_string($value)) {
			$_SESSION['hasMessage'] = $value;
		}
	}
	
	// Retourne un message utilisateur si celui-ci existe.
	public function getMessage() {
		if(isset($_SESSION['hasMessage'])) {
			$message = $_SESSION['hasMessage'];
			unset($_SESSION['hasMessage']);
				
			return $message;
		}
	}
	
	// Vérifie si un message est présent.
	// Renvoie true si oui. Sinon false.
	public function hasMessage() {
		if(isset($_SESSION['hasMessage']))
			return true;
		
		return false;
	}
	
}
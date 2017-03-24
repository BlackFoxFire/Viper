<?php

/*
*
* Entity.php
* @Auteur : Christophe Dufour
*
* Classe de base pour toutes les entités.
*
*/

namespace Viper;

abstract class Entity {
	
	// Utilisation du trait Hydrator.
	use Hydrator;
	
	/*
		Les attributs.
		--------------
	*/
	
	// Identifiant unique de l'entité.
	protected $id;
	
	// Tableau des éventuelles erreurs.
	protected $errors = array();
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct(array $data = array()) {
		if(!empty($data)) {
			$this->hydratation($data);
		}
	}
	
	/*
		Les getters.
		------------
	*/
	
	// Retourne la valeur de l'attribut $id.
	public function id() {
		return $this->id;
	}
	
	// Retourne la valeur de l'attribut $errors.
	public function errors() {
		return $this->errors;
	}
	
	/*
		Les setters.
		------------
	*/
	
	// Modifie la valeur de l'attribut $id.
	public function setId($value) {
		if(is_numeric($value) && (int) $value > 0) {
			$this->id = (int) $value;
		}
	}
	
	// Modifie la valeur de l'attribut $errors.
	public function setErrors() {
		$this->errors = array();
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Retourne true si il y a des erreurs. Sinon false.
	public function hasErrors() {
		return !empty($this->errors);
	}
	
	// Supprime un élément du tableau $errors.
	public function deleteErrors($error) {
		if($key = array_search($error, $this->errors)) {
			unset($this->errors[$key]);
		}
	}
	
	// Retourne true si c'est un nouvel objet. Sinon false.
	public function isNew() {
		return empty($this->id);
	}
	
	// Retourne true si l'objet est valide.
	abstract public function isValid();
	
}

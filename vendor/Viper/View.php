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

class View extends ApplicationComponent {
	
	/*
		Les attributs.
		--------------
	*/
	
	// Tableau des chemins ou sont stoqués les templates.
	protected $path = array();
	
	// Le nom du fichier vue.
	protected $viewFile;
	
	// L'extention des fichiers vue.
	protected $ext = ".html";
	
	// Les données à remplacer dans les templates.
	protected $data = array();
	
	/*
		Constructeur.
		-------------
	*/
	
	// Constructeur de classe.
	public function __construct(Application $application, $controller = null) {
		parent::__construct($application);
		
		$data[] = SRC . DS . $this->app->name() . DS . "resources" . DS . "views" . DS;
		
		if(!empty($controller)) {
			if(is_string($controller)) {
				$data[] = SRC . DS . $this->app->name() . DS . "resources" . DS . "views" . DS . $controller . DS;
			}
			else {
				throw new \InvalidArgumentException("Le controller doit être une chaine de caractères valide");
			}
		}
		
		$this->path = $data;
	}
	
	/*
		Les setters.
		------------
	*/
	
	// Modifie la valeur de l'attribut $path.
	public function setPath(array $path) {
		if(empty($path)) {
			throw new \InvalidArgumentException("Le chemin spécifié est invalide.");
		}
		
		$this->path = $path;
	}
	
	// Modifie la valeur de l'attribut $viewFile.
	public function setViewFile($viewFile) {
		if(!is_string($viewFile) || empty($viewFile)) {
			throw new \InvalidArgumentException("La vue spécifiée est invalide.");
		}
		
		$this->viewFile = $viewFile;
	}
	
	// Ajoute un variable de page.
	public function setData($data, $value = null) {
		if(is_array($data)) {
			if(empty($data)) {
				throw new \InvalidArgumentException("Le tableau des variables doit être non nul.");
			}
			
			$this->data = array_merge($this->data, $data);
		}
		else {
			if(!is_string($data) || empty($data)) {
				throw new \InvalidArgumentException(
									'Le nom de la variable doit être une chaine de caractères non nulle');
			}
			
			$this->data[$data] = $value;
		}
	}
	
	/*
		Les méthodes.
		-------------
	*/
	
	// Retourne la vue à afficher.
	public function render() {
		$fileExists = false;
		
		foreach($this->path as $path) {
			if(file_exists($path . $this->viewFile . $this->ext)) {
				$fileExists = true;
				break;
			}
		}
		
		if (!$fileExists) {
			throw new \RuntimeException("La vue spécifiée n'existe pas.");
		}
		
		$this->data['user'] = $this->app->user();
		
		$loader = new \Twig_Loader_Filesystem($this->path);
		$twig = new \Twig_Environment($loader, array('cache' => false));
		
		return $twig->render($this->viewFile . $this->ext, $this->data);
	}
	
}

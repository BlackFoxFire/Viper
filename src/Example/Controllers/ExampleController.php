<?php

namespace Example\Controllers;

use \Viper\BackController;
use \Viper\HTTPRequest;

class ExampleController extends BackController {
	
	public function indexAction(HTTPRequest $request) {
		$data['title'] = "Hello World !";
		$data['hello'] = "Bonjour tout le monde !";
		
		$this->view->setData($data);
	}
	
}

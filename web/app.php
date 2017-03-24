<?php

/*
* app.php
* @Auteur : Christophe Dufour
* 
* Controleur frontal de l'application.
*
*/

// Application à éxécuter.
// A modifier suivant l'application.
define("APPLICATION", "Example");

// Diverses définitions.
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__DIR__));
define("APP", ROOT . DS . "app");
define("VENDOR", ROOT . DS . "vendor");
define("SRC", ROOT . DS . "src");

// Moteur de template Twig
require VENDOR . DS . "Twig-1.29.0" . DS . "lib" . DS . "Twig" . DS . "Autoloader.php";
Twig_Autoloader::register();

// Chargeur automatique du framework.
require VENDOR . DS . "Viper" . DS . "SplClassLoader.php";

$viperAutoload = new SplClassLoader("Viper", VENDOR);
$viperAutoload->register();

$appAutoload = new SplClassLoader(null, SRC);
$appAutoload->register();

$modelsAutoload = new SplClassLoader(APPLICATION . "\\Models\\", SRC . APPLICATION);
$modelsAutoload->register();

$entitiesAutoload = new SplClassLoader(APPLICATION . "\\Entities\\", SRC . APPLICATION);
$entitiesAutoload->register();

$className = "\\" . APPLICATION . "\\" . str_replace("\\", "", APPLICATION) . "Application";
$application = new $className;
$application->run();

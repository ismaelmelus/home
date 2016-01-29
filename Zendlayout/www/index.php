<?php

define('ROOT_DIR', dirname(dirname(__FILE__)));

// Setup path to the Zend Framework files
set_include_path('.'
. PATH_SEPARATOR . ROOT_DIR.'/lib/'
. PATH_SEPARATOR . get_include_path()
);

// Register the autoloader
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();

// Initialise Zend_Layout's MVC helpers
Zend_Layout::startMvc(array('layoutPath' => ROOT_DIR.'/app/views/layouts'));

// Run!
$frontController = Zend_Controller_Front::getInstance();
$frontController->addControllerDirectory(ROOT_DIR.'/app/controllers');
$frontController->throwExceptions(true);
try {
$frontController->dispatch();
} catch(Exception $e) {
    echo nl2br($e->__toString());
}

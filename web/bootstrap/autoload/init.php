<?php

$docRoot = $_SERVER['DOCUMENT_ROOT'];

require_once $docRoot . '/../bootstrap/autoload/autoloaders/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Task1', $docRoot . '/../app/Task1');

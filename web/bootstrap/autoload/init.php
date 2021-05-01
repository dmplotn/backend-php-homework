<?php

$documentRoot = $_SERVER['DOCUMENT_ROOT'];

require_once $documentRoot . '/../bootstrap/autoload/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('FigureCalculator', $documentRoot . '/../app');

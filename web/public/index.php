<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';

use Task2\EditorCommandFactory;
use Task2\EditorController;

// $rawCommands = "insert \"helloo\" 4\ncopy 0 1\ninsert \"ll\" 2\ndelete 0 7\npaste 0"; //helloo -> helllloo -> hellll
// $rawCommands = "insert \"HelloMyDearFriend\" 5\ncopy 0 4\npaste 17";
// $rawCommands = "insert \"helloo\" 4";
// $rawCommands = "insert \"t\" 0\ninsert \"ext\" 1";
// $rawCommands = "undo";
// “string”

$rawCommands = <<<HERE
insert "sdfsdfsdfsd" 0
delete 0 3
undo
HERE;


$commands = EditorCommandFactory::create($rawCommands);

$controller = new EditorController();
$controller->process($commands);
var_dump($controller->getEditorContent());
var_dump($controller->getHistory());

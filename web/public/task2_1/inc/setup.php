<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload.php';

$pageName = Pages::getCurrentPageName();
$pathToParentLevel = Navigation::getPathToParentLevel();

try {
    $navigation = Navigation::getNavigation();
} catch (\RuntimeException $e) {
    http_response_code(500);
    require_once $_SERVER['DOCUMENT_ROOT'] . '/task2_1/inc/error-pages/500.html';
    exit;
}

$history = History::getReversedHistory();

History::updateHistory();

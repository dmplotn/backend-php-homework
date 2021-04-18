<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task1/Navigation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task1/History.php';

use function Task1\Utils\getCurrentPageName;
use function Task1\Navigation\getNavigation;
use function Task1\History\{getReversedHistory, updateHistory};

$pageName = getCurrentPageName();

try {
    $navigation = getNavigation();
} catch (\RuntimeException $e) {
    http_response_code(500);
    require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/inc/error-pages/500.html';
    exit;
}

$history = getReversedHistory();
updateHistory();

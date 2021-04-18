<?php

namespace Task1\History;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task1/Utils.php';

use function Task1\Utils\{getCurrentPageName, getPathForCurrentPage};

function getHistory(): array
{
    return json_decode($_COOKIE['history'] ?? '{}', true);
}

function saveHistory($history): void
{
    setCookie('history', json_encode($history), 0, "/task1/");
}

function updateHistory(): void
{
    $history = getHistory();

    $lastPathInHistory = $history[count($history) - 1][0] ?? null;

    $currentPageName = getCurrentPageName();
    $currentPath = getPathForCurrentPage();

    if ($currentPath === $lastPathInHistory) {
        return;
    }

    array_push($history, [$currentPath, $currentPageName]);

    if (count($history) > 3) {
        array_shift($history);
    }

    $firstPathInHistory = $history[0][0];

    if (count($history) === 3 && $currentPath === $firstPathInHistory) {
        array_shift($history);
    }

    saveHistory($history);
}

function getReversedHistory(): array
{
    $history = getHistory();
    return array_reverse($history);
}

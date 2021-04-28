<?php

class History
{
    private const HISTORY_SIZE = 3;

    public static function getHistory(): array
    {
        return json_decode($_COOKIE['history'] ?? '{}', true);
    }

    public static function updateHistory(): void
    {
        $history = self::getHistory();

        $lastPathInHistory = $history[count($history) - 1][0] ?? null;

        $currentPageName = Pages::getCurrentPageName();
        $currentPath = Pages::getPathForCurrentPage();

        if ($currentPath === $lastPathInHistory) {
            return;
        }

        // array_push($history, [$currentPath, $currentPageName]);
        $history[] = [$currentPath, $currentPageName];

        if (count($history) > self::HISTORY_SIZE) {
            array_shift($history);
        }

        $firstPathInHistory = $history[0][0];

        $containsRepeats = count($history) === self::HISTORY_SIZE && $currentPath === $firstPathInHistory;

        if ($containsRepeats) {
            array_shift($history);
        }

        self::saveHistory($history);
    }

    public static function getReversedHistory(): array
    {
        $history = self::getHistory();
        return array_reverse($history);
    }

    private static function saveHistory(array $history): void
    {
        setCookie('history', json_encode($history), 0, "/task2_1/");
    }
}

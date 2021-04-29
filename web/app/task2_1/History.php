<?php

class History
{
    private const HISTORY_MAX_SIZE = 3;

    public static function getHistory(): array
    {
        return json_decode($_COOKIE['history'] ?? '{}', true);
    }

    public static function updateHistory(): void
    {
        $history = self::getHistory();

        $currentPageName = Pages::getCurrentPageName();
        $currentPath = Pages::getPathForCurrentPage();

        $addedItem = [$currentPath, $currentPageName];

        $lastPath = $history[count($history) - 1][0] ?? null;

        if ($lastPath === $currentPath) {
            return;
        }

        $checkedItemIndex = self::getHistorySize($history) === self::HISTORY_MAX_SIZE ? 1 : 0;

        $checkedPath = array_slice($history, -2)[0][0];

        $history[] = $addedItem;

        if ($checkedPath === $currentPath) {
            unset($history[$checkedItemIndex]);
            self::saveHistory(array_values($history));
            return;
        }

        if (self::getHistorySize($history) > self::HISTORY_MAX_SIZE) {
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

    public static function getHistorySize(array $history): int
    {
        return count($history);
    }
}

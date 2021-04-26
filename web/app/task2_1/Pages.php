<?php

class Pages
{
    private const PAGES_ROOT = '/task2_1/pages';

    public static function getPathForCurrentPage(): string
    {
        return $_SERVER['PHP_SELF'];
    }

    public static function getCurrentPageName(): string
    {
        return array_slice(explode("/", $_SERVER['PHP_SELF']), -1)[0];
    }

    public static function getCurrentDirPath(): string
    {
        $currentPageName = self::getCurrentPageName();
        return mb_substr($_SERVER['PHP_SELF'], 0, -(mb_strlen($currentPageName) + 1));
    }

    public static function getPathForParentDir()
    {
        $parentDirPath = mb_substr(realpath('..'), mb_strlen($_SERVER['DOCUMENT_ROOT']));

        if (self::getCurrentDirPath() !== self::PAGES_ROOT) {
            return $parentDirPath;
        }
    }
}

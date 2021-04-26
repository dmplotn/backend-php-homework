<?php

class Navigation
{
    public static function getNavigation(): array
    {
        $cwd = getcwd();
        $filePaths = self::getFileNamesFromDir($cwd);
        return array_map(fn($name) => substr($name, mb_strlen($cwd) + 1), $filePaths);
    }

    private static function getFileNamesFromDir(string $dirPath): array
    {
        $currentPageName = Pages::getCurrentPageName();
        $excludedNames = ['.', '..', $currentPageName];

        $contentsNames = scandir($dirPath);

        $filteredNames = array_filter($contentsNames, fn($name) => !in_array($name, $excludedNames));
        $fullNames = array_map(fn($name) => "{$dirPath}/{$name}", $filteredNames);

        return array_reduce($fullNames, function ($acc, $name) {
            if (is_dir($name)) {
                return [...$acc, ...self::getFilenamesFromDir($name)];
            }
            return is_file($name) ? [...$acc, $name] : $acc;
        }, []);
    }

    public static function getPathToParentLevel()
    {
        $parentDirPath = Pages::getPathForParentDir();
        if ($parentDirPath === null) {
            return null;
        }

        $contentsNames = scandir('..');
        $filteredNames = array_filter($contentsNames, fn($name) => !in_array($name, ['.', '..']));

        [$name] = array_reduce($filteredNames, function ($acc, $name) {
            $preparedName = "../{$name}";
            if (is_dir($preparedName)) {
                return $acc;
            }
            return is_file($preparedName) ? [...$acc, $name] : $acc;
        }, []);

        return "{$parentDirPath}/{$name}";
    }
}

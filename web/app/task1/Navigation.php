<?php

namespace Task1\Navigation;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task1/Utils.php';

use function Task1\Utils\getCurrentPageName;

function getNavigation(): array
{
    $cwd = getcwd();
    $filePaths = getFileNamesFromDir($cwd);
    return array_map(fn($name) => substr($name, mb_strlen($cwd) + 1), $filePaths);
}

function getFileNamesFromDir($dirPath): array
{
    $currentPageName = getCurrentPageName();
    $excludedNames = ['.', '..', $currentPageName];

    set_error_handler(function ($errno, $errstr) {
        throw new \RuntimeException($errstr);
    });
    $contentsNames = scandir($dirPath);
    restore_error_handler();

    $filteredNames = array_filter($contentsNames, fn($name) => !in_array($name, $excludedNames));
    $fullNames = array_map(fn($name) => "{$dirPath}/{$name}", $filteredNames);

    return array_reduce($fullNames, function ($acc, $name) {
        if (is_dir($name)) {
            return [...$acc, ...getFilenamesFromDir($name)];
        }
        return is_file($name) ? [...$acc, $name] : $acc;
    }, []);
}

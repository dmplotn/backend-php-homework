<?php

set_include_path(
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task1' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task1/Exceptions' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task1/Validators' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_1' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_2' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_2/Exceptions' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_2/Models' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_2/Repositories' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_2/Validators' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task3' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task3/Workers' . PATH_SEPARATOR .
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task3/Validators'
);

spl_autoload_register(function ($class) {
    include $class . '.php';
});

<?php

set_include_path(
    $_SERVER['DOCUMENT_ROOT'] . '/../app/task1'
    . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_1'
    . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_2'
);
// set_include_path(
//     $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_2'
    // . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_1'
    // . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . '/../app/task2_2'
// );
spl_autoload_register(function ($class) {
    include $class . '.php';
});

<?php

set_include_path($_SERVER['DOCUMENT_ROOT'] . '/../app/task1');
spl_autoload_register(function ($class) {
    include $class . '.php';
});

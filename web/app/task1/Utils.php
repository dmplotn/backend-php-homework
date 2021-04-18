<?php

namespace Task1\Utils;

function getPathForCurrentPage(): string
{
    return $_SERVER['PHP_SELF'];
}


function getCurrentPageName(): string
{
    return array_slice(explode("/", $_SERVER['PHP_SELF']), -1)[0];
}

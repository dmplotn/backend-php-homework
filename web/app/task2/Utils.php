<?php

namespace Task2\Utils;

function getCurrentPath(): string
{
    return $_SERVER['PHP_SELF'];
}

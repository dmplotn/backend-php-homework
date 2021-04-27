<?php

class Utils
{
    public static function getCurrentPagePath(): string
    {
        return $_SERVER['PHP_SELF'];
    }
}

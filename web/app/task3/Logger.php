<?php

define('LOG_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../storage/log');

class Logger
{
    public static function log($data)
    {
        $loggedAt = date("Y-M-d H:i:s");
        $dataAsStr = var_export($data, true);

        set_error_handler(function ($errno, $errstr) {
            throw new \RuntimeException($errstr);
        });
        file_put_contents(LOG_PATH, "[{$loggedAt}]\n{$dataAsStr}\n\n", FILE_APPEND);
        restore_error_handler();
    }
}

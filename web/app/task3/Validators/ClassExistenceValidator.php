<?php

class ClassExistenceValidator
{
    public static function validate(string $className): bool
    {
        try {
            set_error_handler(function ($errno, $errstr) {
                throw new \RuntimeException($errstr);
            });
            class_exists($className);
            restore_error_handler();
        } catch (\RuntimeException $e) {
            return false;
        }

        return true;
    }
}

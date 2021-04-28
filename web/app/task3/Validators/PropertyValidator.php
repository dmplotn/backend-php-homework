<?php

class PropertyValidator
{
    public static function validate(array $properties): bool
    {
        foreach ($properties as $propertyValue) {
            if (empty($propertyValue)) {
                return false;
            }
        }

        return true;
    }
}

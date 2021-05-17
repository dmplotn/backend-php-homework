<?php

namespace Task1\Validators;

class FigurePropertyValidator
{
    /**
     * @param float $property
     *
     * @return void
     */
    public static function validate(float $property): void
    {
        if ($property <= 0) {
            throw new \DomainException("Property value is not positive. Value: {$property}.");
        }
    }

    /**
     * @param float ...$properties
     *
     * @return void
     */
    public static function validateMultipleProperties(float ...$properties): void
    {
        foreach ($properties as $property) {
            self::validate($property);
        }
    }
}

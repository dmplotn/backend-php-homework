<?php

declare(strict_types=1);

namespace FigureCalculator;

use FigureCalculator\Figures\FigureInterface;
use FigureCalculator\Exceptions\{ClassExistenceException, PropertyExistenceException, MethodExistenceException};

/**
 * FigureFactory
 */
class FigureFactory
{
    private const PREFIX = '\FigureCalculator\Figures\\';

    /**
     * @param string $figureName
     * @param array $properties
     *
     * @return FigureInterface
     */
    public static function create(string $figureName, array $properties): FigureInterface
    {
        $fullClassName = self::PREFIX . $figureName;

        if (!class_exists($fullClassName)) {
            throw new ClassExistenceException("Class '{$fullClassName}' is not exists.");
        }

        $classPropNames = $fullClassName::getClassPropNames();
        $givenPropNames = array_keys($properties);

        if ($classPropNames !== $givenPropNames) {
            throw new PropertyExistenceException(
                "Class '{$fullClassName}' has different property set."
            );
        }

        return self::getInitializedFigure($fullClassName, $properties);
    }

    /**
     * @param string $fullClassName
     * @param array $properties
     *
     * @return FigureInterface
     */
    private static function getInitializedFigure(string $fullClassName, array $properties): FigureInterface
    {
        $figure  = new $fullClassName();

        foreach ($properties as $propName => $value) {
            $setterName = "set{$propName}";

            if (!method_exists($figure, $setterName)) {
                throw new MethodExistenceException(
                    "Method '{$setterName}' is not exists on object of '{$fullClassName} class'."
                );
            }

            $filteredValue = filter_var($value, FILTER_VALIDATE_FLOAT);

            $figure->$setterName($filteredValue);
        }

        return $figure;
    }
}

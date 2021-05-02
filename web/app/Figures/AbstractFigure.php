<?php

namespace FigureCalculator\Figures;

/**
 * AbstractFigure
 */
abstract class AbstractFigure
{
    /**
     * @return float
     */
    abstract public function getArea(): float;

    public static function getClassPropNames(): array
    {
        return array_keys(get_class_vars(static::class));
    }
}

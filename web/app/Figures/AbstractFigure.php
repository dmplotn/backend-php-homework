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

    /**
     * @return float
     */
    abstract public function getRatio(): float;

    /**
     * @return array
     */
    public static function getClassPropNames(): array
    {
        return array_keys(get_class_vars(static::class));
    }

    /**
     * @return string
     */
    public function getFullClassName(): string
    {
        return static::class;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return get_object_vars($this);
    }
}

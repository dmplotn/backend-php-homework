<?php

namespace FigureCalculator\Figures;

use FigureCalculator\Validators\FigurePropertyValidator;

class Circle implements Figure2DInterface
{
    /**
     * @var float
     */
    private float $radius;

    /**
     * @param float $radius
     */
    public function __construct(float $radius = 1)
    {
        FigurePropertyValidator::validate($radius);

        $this->radius = $radius;
    }

    /**
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
    }

    /**
     * @param float $raius
     *
     * @return void
     */
    public function setRadius(float $radius): void
    {
        FigurePropertyValidator::validate($radius);

        $this->radius = $radius;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return pi() * ($this->getRadius() ** 2);
    }

    /**
     * @return float
     */
    public function getPerimeter(): float
    {
        return 2 * pi() * $this->getRadius();
    }

    /**
     * @return array
     */
    public static function getClassPropNames(): array
    {
        return array_keys(get_class_vars(self::class));
    }
}

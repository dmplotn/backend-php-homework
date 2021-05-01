<?php

namespace FigureCalculator\Figures;

use FigureCalculator\Validators\FigurePropertyValidator;

/**
 * Sphere
 */
class Sphere implements Figure3DInterface
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
     * @param float $radius
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
        return 4 * pi() * ($this->getRadius() ** 2);
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return (4 * pi() * ($this->getRadius() ** 3)) / 3;
    }

    /**
     * @return array
     */
    public static function getClassPropNames(): array
    {
        return array_keys(get_class_vars(self::class));
    }
}

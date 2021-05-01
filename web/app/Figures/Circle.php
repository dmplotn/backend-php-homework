<?php

namespace FigureCalculator\Figures;

class Circle implements Figure2DInterface
{
    /**
     * @var float
     */
    private float $radius;

    /**
     * @param float $radius
     */
    public function __construct(float $radius)
    {
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
}

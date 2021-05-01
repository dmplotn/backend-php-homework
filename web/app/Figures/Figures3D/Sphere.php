<?php

namespace FigureCalculator\Figures\Figures3D;

class Sphere implements Figure3DInterface
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
        return 4 * pi() * ($this->getRadius() ** 2);
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return (4 * pi() * ($this->getRadius() ** 3)) / 3;
    }
}

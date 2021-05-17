<?php

namespace Task1\Figures;

use Task1\Validators\FigurePropertyValidator;

class Sphere extends AbstractFigure3D
{
    /**
     * @var float
     */
    protected float $radius;

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
}

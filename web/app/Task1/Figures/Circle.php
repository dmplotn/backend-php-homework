<?php

namespace Task1\Figures;

use Task1\Validators\FigurePropertyValidator;

class Circle extends AbstractFigure2D
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

        $this->id = uniqid();

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
}

<?php

namespace Task1\Figures;

abstract class AbstractFigure2D extends AbstractFigure
{
    /**
     * @return float
     */
    abstract public function getPerimeter(): float;

    /**
     * @return float
     */
    public function getRatio(): float
    {
        return $this->getArea() / $this->getPerimeter();
    }
}

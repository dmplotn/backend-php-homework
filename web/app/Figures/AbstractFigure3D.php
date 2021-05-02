<?php

namespace FigureCalculator\Figures;

/**
 * AbstractFigure3D
 */
abstract class AbstractFigure3D extends AbstractFigure
{
    /**
     * @return float
     */
    abstract public function getVolume(): float;

    /**
     * @return float
     */
    public function getRatio(): float
    {
        return $this->getVolume() / $this->getArea();
    }
}

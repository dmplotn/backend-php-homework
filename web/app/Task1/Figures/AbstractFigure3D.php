<?php

namespace Task1\Figures;

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

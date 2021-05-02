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
}

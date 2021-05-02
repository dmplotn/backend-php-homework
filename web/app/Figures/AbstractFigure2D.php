<?php

namespace FigureCalculator\Figures;

/**
 * AbstractFigure2D
 */
abstract class AbstractFigure2D extends AbstractFigure
{
    /**
     * @return float
     */
    abstract public function getPerimeter(): float;
}

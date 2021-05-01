<?php

namespace FigureCalculator\Figures\Figures2D;

use FigureCalculator\Figures\FigureInterface;

interface Figure2DInterface extends FigureInterface
{
    /**
     * @return float
     */
    public function getPerimeter(): float;
}

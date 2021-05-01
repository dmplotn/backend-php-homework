<?php

namespace FigureCalculator\Figures;

interface Figure2DInterface extends FigureInterface
{
    /**
     * @return float
     */
    public function getPerimeter(): float;
}

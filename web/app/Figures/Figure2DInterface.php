<?php

namespace FigureCalculator\Figures;

/**
 * Figure2DInterface
 */
interface Figure2DInterface extends FigureInterface
{
    /**
     * @return float
     */
    public function getPerimeter(): float;
}

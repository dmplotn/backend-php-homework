<?php

namespace FigureCalculator\Figures;

/**
 * Figure3DInterface
 */
interface Figure3DInterface extends FigureInterface
{
    /**
     * @return float
     */
    public function getVolume(): float;
}

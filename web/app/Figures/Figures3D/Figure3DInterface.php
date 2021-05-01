<?php

namespace FigureCalculator\Figures\Figures3D;

use FigureCalculator\Figures\FigureInterface;

interface Figure3DInterface extends FigureInterface
{
    /**
     * @return float
     */
    public function getVolume(): float;
}

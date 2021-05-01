<?php

namespace FigureCalculator\Figures;

interface Figure3DInterface extends FigureInterface
{
    /**
     * @return float
     */
    public function getVolume(): float;
}

<?php

namespace FigureCalculator\Figures\Figures2D;

class Rectangle implements Figure2DInterface
{
    /**
     * @var float
     */
    private float $width;

    /**
     * @var float
     */
    private float $length;

    /**
     * @param float $width
     * @param float $length
     */
    public function __construct(float $width, float $length)
    {
        $this->width = $width;
        $this->length = $length;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return $this->getWidth() * $this->getWidth();
    }

    /**
     * @return float
     */
    public function getPerimeter(): float
    {
        return ($this->getWidth() + $this->getLength()) * 2;
    }
}

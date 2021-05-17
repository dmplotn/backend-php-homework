<?php

namespace Task1\Figures;

use Task1\Validators\FigurePropertyValidator;

class Cuboid extends AbstractFigure3D
{
    /**
     * @var float
     */
    protected float $width;

    /**
     * @var float
     */
    protected float $length;

    /**
     * @var float
     */
    protected float $height;

    /**
     * @param float $width
     * @param float $length
     * @param float $height
     */
    public function __construct(float $width = 1, float $length = 1, float $height = 1)
    {
        FigurePropertyValidator::validateMultipleProperties($width, $length, $height);

        $this->width = $width;
        $this->length = $length;
        $this->height = $height;
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
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $width
     *
     * @return void
     */
    public function setWidth(float $width): void
    {
        FigurePropertyValidator::validate($width);

        $this->width = $width;
    }

    /**
     * @param float $length
     *
     * @return void
     */
    public function setLength(float $length): void
    {
        FigurePropertyValidator::validate($length);

        $this->length = $length;
    }

    /**
     * @param float $height
     *
     * @return void
     */
    public function setHeight(float $height): void
    {
        FigurePropertyValidator::validate($height);

        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        $area1 = $this->getWidth() * $this->getLength();
        $area2 = $this->getWidth() * $this->getHeight();
        $area3 = $this->getLength() * $this->getHeight();

        return 2 * ($area1 + $area2 + $area3);
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->getWidth() * $this->getLength() * $this->getHeight();
    }
}

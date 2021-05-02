<?php

namespace FigureCalculator\Figures;

use FigureCalculator\Validators\FigurePropertyValidator;

/**
 * Rectangle
 */
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
    public function __construct(float $width = 1, float $length = 1)
    {
        FigurePropertyValidator::validateMultipleProperties($width, $length);

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
     * @param mixed $width
     *
     * @return void
     */
    public function setWidth(float $width): void
    {
        FigurePropertyValidator::validate($width);

        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
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

    /**
     * @return array
     */
    public static function getClassPropNames(): array
    {
        return array_keys(get_class_vars(self::class));
    }
}

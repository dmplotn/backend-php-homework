<?php

namespace Task1\Figures;

abstract class AbstractFigure
{
    /**
     * @var string
     */
    protected string $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return float
     */
    abstract public function getArea(): float;

    /**
     * @return float
     */
    abstract public function getRatio(): float;
}

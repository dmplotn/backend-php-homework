<?php

namespace FigureCalculator;

use FigureCalculator\Figures\FigureInterface;
use FigureCalculator\Exceptions\MethodExistenceException;

/**
 * FigureCalculator
 */
class FigureCalculator
{
    /**
     * @var FigureInterface
     */
    private FigureInterface $figure;

    /**
     * @param string $figureName
     */
    public function __construct(FigureInterface $figure)
    {
        $this->figure = $figure;
    }

    /**
     * @return FigureInterface
     */
    public function getFigure(): FigureInterface
    {
        return $this->figure;
    }

    /**
     * @param string $operation
     *
     * @return float
     */
    public function calculate(string $operationName): float
    {
        $figure = $this->getFigure();

        if (!method_exists($figure, $operationName)) {
            throw new MethodExistenceException(
                "Method '{$operationName}' is not exists on current figure object."
            );
        }

        return $figure->$operationName();
    }
}

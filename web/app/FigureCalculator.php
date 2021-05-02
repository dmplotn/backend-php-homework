<?php

namespace FigureCalculator;

use FigureCalculator\Figures\AbstractFigure;
use FigureCalculator\Exceptions\MethodExistenceException;

/**
 * FigureCalculator
 */
class FigureCalculator
{
    use FigureLoggerTrait;

    /**
     * @var AbstractFigure
     */
    private AbstractFigure $figure;

    /**
     * @param string $figureName
     */
    public function __construct(AbstractFigure $figure)
    {
        $this->figure = $figure;
    }

    /**
     * @return AbstractFigure
     */
    public function getFigure(): AbstractFigure
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
            self::log('FAIL', $figure, $operationName);

            throw new MethodExistenceException(
                "Method '{$operationName}' is not exists on current figure object."
            );
        }

        $result = $figure->$operationName();

        self::log('SUCCESS', $figure, $operationName, $result);

        return  $result;
    }
}

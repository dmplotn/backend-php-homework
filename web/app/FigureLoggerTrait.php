<?php

namespace FigureCalculator;

use FigureCalculator\Figures\AbstractFigure;
use FigureCalculator\Utils;

/**
 * FigureLoggerTrait
 */
trait FigureLoggerTrait
{
    /**
     * @param string $operationStatus
     * @param AbstractFigure $figure
     * @param string $operationName
     * @param float|null $result
     *
     * @return void
     */
    private static function log(
        string $operationStatus,
        AbstractFigure $figure,
        string $operationName,
        float $result = null
    ): void {
        $loggedAt = date("Y-M-d H:i:s");
        $className = $figure->getFullClassName();
        $properties = $figure->getProperties();

        $info = var_export(
            compact(
                'className',
                'operationName',
                'properties',
                'result'
            ),
            true
        );

        file_put_contents(Utils::LOG_PATH, "[{$operationStatus}][{$loggedAt}]\n{$info}\n\n", FILE_APPEND);
    }
}

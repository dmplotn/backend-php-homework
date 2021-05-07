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

        $logMessage = "[{$operationStatus}][{$loggedAt}]\n{$info}\n\n";

        file_put_contents(Utils::LOG_PATH, $logMessage, FILE_APPEND);
    }
}

<?php

namespace FigureCalculator;

use FigureCalculator\Exceptions\MissingRequestParamException;

class RequestParamParser
{
    public static function parse(array $params): array
    {
        if (!isset($params['figure'])) {
            throw new MissingRequestParamException(
                "Param 'figure' is not in request param set"
            );
        }

        if (!isset($params['operation'])) {
            throw new MissingRequestParamException(
                "Param 'operation' is not in request param set"
            );
        }

        $requiredPart = ['figure' => $params['figure'], 'operation' => $params['operation']];

        $optionalPart = array_diff_assoc($params, $requiredPart);

        return array_merge($requiredPart, ['properties' => $optionalPart]);
    }
}

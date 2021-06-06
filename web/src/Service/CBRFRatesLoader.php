<?php

namespace App\Service;

use Carbon\Carbon;

class CBRFPeriodRatesLoader
{
    private const API_URL = 'http://www.cbr.ru/scripts/XML_dynamic.asp';

    /**
     * @param Carbon $beginDate
     * @param Carbon $endDate
     * @param string $cbrfId
     *
     * @return array
     */
    public function load(Carbon $beginDate, Carbon $endDate, string $cbrfId): array
    {
        if ($beginDate > $endDate) {
            throw new \LogicException('Invalid dates.');
        }

        $formattedBeginDate = $beginDate->format('d/m/Y');
        $formattedEndDate = $endDate->format('d/m/Y');

        $queryParts = ["date_req1={$formattedBeginDate}", "date_req2={$formattedEndDate}", "VAL_NM_RQ={$cbrfId}"];
        $query = '?' . implode('&', $queryParts);
        $url = self::API_URL . $query;

        $items = simplexml_load_file($url);

        if (!$items) {
            throw new \RuntimeException('CBRF api error.');
        }

        $result = [];

        foreach ($items as $item) {
            $value = (float) (string) str_replace(',', '.', $item->Value);
            $nominal = (int) (string) $item->Nominal;
            $result[] = [
                'cbrf_id' => $cbrfId,
                'rate' => $value / $nominal,
                'date' => (string) $item->attributes()
            ];
        }

        return $result;
    }
}

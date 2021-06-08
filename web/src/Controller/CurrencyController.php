<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Currency;

class CurrencyController extends AbstractController
{
    public function index()
    {
        $currentRatesData = Currency::currentRatesData();
        $mapData = $currentRatesData->map(function ($item) {
            return [
                'currencyIso' => $item->currency_iso,
                'currencyRate' => $item->currency_rate,
                'countryIso' => $item->country_iso
            ];
        })
        ->toArray();

        $tableData = $currentRatesData
            ->map(function ($item) {
                return [
                    'currencyName' => $item->currency_name,
                    'currencyIso' => $item->currency_iso,
                    'currencyRate' => $item->currency_rate
                ];
            })
            ->unique('currencyName')
            ->toArray();

        return $this->render('app/currencies/index.html.twig', compact('mapData', 'tableData'));
    }
}

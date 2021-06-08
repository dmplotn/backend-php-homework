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
                'currencyId' => $item->currency_id,
                'currencyIso' => $item->currency_iso,
                'currencyRate' => $item->currency_rate,
                'countryIso' => $item->country_iso
            ];
        })
        ->toArray();

        $tableData = $currentRatesData
            ->map(function ($item) {
                return [
                    'currencyId' => $item->currency_id,
                    'currencyName' => $item->currency_name,
                    'currencyIso' => $item->currency_iso,
                    'currencyRate' => $item->currency_rate
                ];
            })
            ->unique('currencyName')
            ->toArray();

        return $this->render('app/currencies/index.html.twig', compact('mapData', 'tableData'));
    }

    public function show(int $id)
    {
        var_dump($id);
        die();
    }
}

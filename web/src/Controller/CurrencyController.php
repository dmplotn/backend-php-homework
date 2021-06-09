<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Currency;

class CurrencyController extends AbstractController
{
    public function index()
    {
        $currentRatesData = Currency::currentRatesData();
        $mapData = $currentRatesData
            ->get()
            ->map(function ($item) {
                return [
                    'currencyId' => $item->currency_id,
                    'currencyIso' => $item->currency_iso,
                    'currencyRate' => $item->currency_rate,
                    'countryIso' => $item->country_iso
                ];
            })
        ->toArray();

        $tableData = $currentRatesData
            ->get()
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
        $currencyModel = Currency::find($id);

        if (!$currencyModel) {
            throw $this->createNotFoundException();
        }

        $currencyRates = $currencyModel->rates();

        $chartData = $currencyRates
            ->get()
            ->map(function ($item) {
                return [
                    'currencyRate' => $item->currency_rate,
                    'date' => $item->date
                ];
            })
            ->toArray();

        $lastCurrencyRateModel = $currencyRates->orderBy('date', 'desc')->first();
        $lastCurrencyRate = $lastCurrencyRateModel->currency_rate;
        $lastUpdateRateDate = $lastCurrencyRateModel->date;

        $countryModels = $currencyModel->countries()->get();
        $countryNames = $countryModels->map(function ($item) {
            return $item->name;
        })
        ->toArray();

        $currencyData = [
            'currencyId' => $currencyModel->id,
            'currencyName' => $currencyModel->name,
            'currencyIso' => $currencyModel->iso,
            'currencyCbrfId' => $currencyModel->cbrf_id,
            'countryNames' => $countryNames,
            'currencyRate' => $lastCurrencyRate,
            'lastUpdateRateDate' => $lastUpdateRateDate ? $lastUpdateRateDate->format('d.m.Y') : null
        ];

        return $this->render('app/currencies/show.html.twig', compact('currencyData', 'chartData'));
    }
}

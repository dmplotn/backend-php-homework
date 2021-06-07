<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Currency;

class WelcomeController extends AbstractController
{
    public function index()
    {
        $currentRatesData = Currency::currentRatesData();
        $data = $currentRatesData->map(function ($item) {
            return [
                'currencyId' => $item->currency_id,
                'currencyIso' => $item->currency_iso,
                'currencyRate' => round($item->currency_rate, 2),
                'countryIso' => $item->country_iso
            ];
        })
        ->toArray();

        return $this->render('app/welcome.html.twig', compact('data'));
    }
}

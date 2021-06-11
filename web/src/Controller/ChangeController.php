<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Currency;

class ChangeController extends AbstractController
{
    public function index()
    {
        session_start();
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        session_destroy();

        $currentRatesData = Currency::currentRatesData()
        ->get()
        ->unique('currency_id')
        ->filter(fn($item) => $item->currency_rate !== null)
        ->map(function ($item) {
            return [
                'currencyId' => $item->currency_id,
                'currencyIso' => $item->currency_iso,
                'currencyName' => $item->currency_name,
                'currencyRate' => (double) $item->currency_rate
            ];
        })
        ->values()
        ->toArray();

        return $this->render('app/change.html.twig', compact('message', 'currentRatesData'));
    }
}

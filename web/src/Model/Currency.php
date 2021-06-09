<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use WouterJ\EloquentBundle\Facade\Db;

class Currency extends Model
{
    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function rates()
    {
        return $this->hasMany(CurrencyRate::class);
    }

    public static function currentRatesData()
    {
        $latestCurrencyRates = Db::table('currency_rates')
            ->selectRaw('currency_id, max(date) as date')
            ->groupBy('currency_id');

        return Db::table('currencies')
            ->select(
                'currencies.id as currency_id',
                'currencies.iso as currency_iso',
                'currencies.cbrf_id as currency_cbrf_id',
                'currencies.name as currency_name',
                'countries.id as country_id',
                'countries.name as country_name',
                'countries.iso as country_iso',
                'currency_rates.currency_rate',
                'currency_rates.date'
            )
            ->join('countries', 'currencies.id', '=', 'countries.currency_id')
            ->leftJoin('currency_rates', 'currencies.id', '=', 'currency_rates.currency_id')
            ->joinSub($latestCurrencyRates, 'latest_currency_rates', function ($join) {
                $join
                    ->on('currency_rates.currency_id', '=', 'latest_currency_rates.currency_id')
                    ->where(function ($query) {
                        $query->whereNull('currency_rates.date')
                            ->orWhere('currency_rates.date', '=', DB::raw('latest_currency_rates.date'));
                    });
            });
    }
}

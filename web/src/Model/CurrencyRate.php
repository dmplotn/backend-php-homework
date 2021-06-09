<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    protected $casts = [
        'currency_rate' => 'float',
        'date' => 'date'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}

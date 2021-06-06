<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}

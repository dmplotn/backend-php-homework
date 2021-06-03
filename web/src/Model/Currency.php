<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function countries()
    {
        return $this->hasMany(Country::class);
    }
}

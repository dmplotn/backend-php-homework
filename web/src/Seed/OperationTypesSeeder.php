<?php

namespace App\Seed;

use WouterJ\EloquentBundle\Seeder;
use App\Model\OperationType;

class OperationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operationTypeModelSell = new OperationType();
        $operationTypeModelSell->name = 'sell';

        $operationTypeModelBuy = new OperationType();
        $operationTypeModelBuy->name = 'buy';

        $operationTypeModelSell->save();
        $operationTypeModelBuy->save();
    }
}

<?php

namespace App\Seed;

use WouterJ\EloquentBundle\Facade\Db;
use WouterJ\EloquentBundle\Seeder;
use Symfony\Component\Yaml\Yaml;
use App\Model\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = Yaml::parseFile('seeding_data/currencies_data.yml');

        Db::beginTransaction();

        $createCurrencies = function (array $currencies): void {
            foreach ($currencies as $currency) {
                $currencyModel = new Currency();
                $currencyModel->name = $currency['name'];
                $currencyModel->iso = $currency['currency_iso'];
                $currencyModel->cbrf_id = $currency['currency_cbrf_id'];
                $currencyModel->save();
            }
        };

        $createCurrencies($currencies);

        Db::commit();
    }
}

<?php

namespace App\Seed;

use WouterJ\EloquentBundle\Facade\Db;
use WouterJ\EloquentBundle\Seeder;
use Symfony\Component\Yaml\Yaml;
use App\Model\Country;
use App\Model\Currency;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = Yaml::parseFile('seeding_data/countries_data.yml');

        Db::beginTransaction();

        $createCountries = function (array $countries): void {
            foreach (
                $countries as [
                    'name' => $name,
                    'country_iso' => $countryIso,
                    'currency_iso' => $currencyIso
                ]
            ) {
                $currencyId = Currency::where('iso', $currencyIso)->value('id');

                $countryModel = new Country();
                $countryModel->name = $name;
                $countryModel->iso = $countryIso;
                $countryModel->currency_id = $currencyId;
                $countryModel->save();
            }
        };

        $createCountries($countries);

        Db::commit();
    }
}

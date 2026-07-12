<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Countries\CountriesFacade as Countries;

class CountriesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the countries table
        DB::table('countries')->delete();

        // Get all of the countries
        $countries = Countries::getList();
        foreach ($countries as $countryId => $country) {
            DB::table('countries')->insert(
                array(
                    'id' => $countryId,
                    'name' => $country['name'],
                    'currency' => ((isset($country['currency'])) ? $country['currency'] : null),
                    'currency_symbol' => ((isset($country['currency_symbol'])) ? $country['currency_symbol'] : null),
                    'currency_code' => ((isset($country['currency_code'])) ? $country['currency_code'] : null),
                    'iso_3166_2' => $country['iso_3166_2'],
                    'iso_3166_3' => $country['iso_3166_3'],
                    'calling_code' => $country['calling_code'],
                    'flag' => ((isset($country['flag'])) ? $country['flag'] : 'default.png')
                ),
            );
        }
    }
}

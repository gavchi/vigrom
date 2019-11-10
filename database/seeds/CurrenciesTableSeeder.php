<?php

use Illuminate\Database\Seeder;
use \App\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create(['code' => 'RUB']);
        Currency::create(['code' => 'USD']);
        Currency::create(['code' => 'EUR']);
    }
}

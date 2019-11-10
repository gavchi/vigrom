<?php

use Illuminate\Database\Seeder;
use \App\Models\Currency;
use \App\Models\Exchange;

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
        factory(Exchange::class, 50)->create();
    }
}

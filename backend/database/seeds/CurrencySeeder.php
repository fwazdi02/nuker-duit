<?php

use Illuminate\Database\Seeder;
use App\Currency;
class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['code' => 'usd', 'name' => 'US Dollar'],
            ['code' => 'eur', 'name' => 'Euro'],
            ['code' => 'gbp', 'name' => 'Pound Sterling'],
            ['code' => 'jpy', 'name' => 'Japan Yen'],
            ['code' => 'aud', 'name' => 'Australian Dollar'],
            ['code' => 'hkd', 'name' => 'Hong Kong Dollar'],
            ['code' => 'sgd', 'name' => 'Singapore Dollar'],
            ['code' => 'thb', 'name' => 'Thai Baht'],
            ['code' => 'inr', 'name' => 'Indian Rupee'],
            ['code' => 'myr', 'name' => 'Malaysian Ringgit'],
        ];
        Currency::insert($currencies);
    }
}

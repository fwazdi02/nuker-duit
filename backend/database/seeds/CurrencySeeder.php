<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            ['usd', 'US Dollar'],
            ['eur', 'Euro'],
            ['gbp', 'Pound Sterling'],
            ['jpy', 'Japan Yen'],
            ['aud', 'Australian Dollar'],
            ['hkd', 'Hong Kong Dollar'],
            ['sgd', 'Singapore Dollar'],
            ['thb', 'Thai Baht'],
            ['inr', 'Indian Rupee'],
            ['myr', 'Malaysian Ringgit'],
        ];
        
        foreach ($currencies as $currency) {
            DB::insert('insert into currencies (code, name) values (?, ?)', [
                $currency[0],
                $currency[1],
            ]);
        }
    }
}

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
            ['usd', 'US Dollar', 10000, date('Y-m-d H:i:s')],
            ['eur', 'Euro', 10000, date('Y-m-d H:i:s')],
            ['gbp', 'Pound Sterling', 10000, date('Y-m-d H:i:s')],
            ['jpy', 'Japan Yen', 10000, date('Y-m-d H:i:s')],
            ['aud', 'Australian Dollar', 10000, date('Y-m-d H:i:s')],
            ['hkd', 'Hong Kong Dollar', 10000, date('Y-m-d H:i:s')],
            ['sgd', 'Singapore Dollar', 10000, date('Y-m-d H:i:s')],
            ['thb', 'Thai Baht', 10000, date('Y-m-d H:i:s')],
            ['inr', 'Indian Rupee', 10000, date('Y-m-d H:i:s')],
            ['myr', 'Malaysian Ringgit', 10000, date('Y-m-d H:i:s')],
        ];
        
        foreach ($currencies as $currency) {
            DB::insert('insert into currencies (code, name, available_amount, created_at) values (?, ?, ?, ?)', [
                $currency[0],
                $currency[1],
                $currency[2],
                $currency[3],
            ]);
        }
    }
}

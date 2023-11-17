<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class MoneyChanger {
    public static function getExchangeRate($exchange_code, $type = 'buy')
    {
        $locale_code = env('LOCALE_CURRENCY', 'idr');
        $api_url = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies';
        
        if($type == 'buy') {
            $api_url .= "/$exchange_code/$locale_code.json";
        }else{
            $api_url .= "/$locale_code/$exchange_code.json";
        }
        $response = Http::get($api_url);
        if($response->successful()) {
            return ['success'=> true, 'data' => $response->json()];
        } else {
            return ['success'=> false, 'data' => null];
        }
    }
}
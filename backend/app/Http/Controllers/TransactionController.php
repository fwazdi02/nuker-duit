<?php

namespace App\Http\Controllers;
use \MoneyChanger;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function TransactionSell(Request $request){
        $code = $request->input('code');
        $data = MoneyChanger::getExchangeRate($code);
        return response()->json($data, $data['success'] === true ? 200 : 400);
    }
}

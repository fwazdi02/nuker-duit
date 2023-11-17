<?php

namespace App\Http\Controllers;
use \MoneyChanger;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getRate(Request $request){
        $code = $request->input('code');
        $transaction_type = $request->input('type', 'buy');
        $data = MoneyChanger::getExchangeRate($code, $transaction_type);
        return response()->json($data, $data['success'] === true ? 200 : 400);
    }
    
    public function exchange(Request $request){
        $code = $request->input('code');
        $amount = $request->input('amount');
        $transaction_type = $request->input('type', 'buy');

        $data = MoneyChanger::getExchangeRate($code, $transaction_type);
        if($data['success'] === true){
            $rate = $data['data'][$transaction_type === 'buy' ? 'idr' : $code];
            $result = round($rate * $amount, 2);
            $message = '';
            if($transaction_type == 'buy'){
                $message = "You have successfully exchanged $amount ($code) to $result (idr)";
            }else{
                $message = "You have successfully exchanged $amount (idr) to $result ($code)";
            }
            return response()->json([
                'success' => true, 
                'message' => $message,
            ], 200);
        }
        return response()->json(['success' => false, 'message' => "Something went wrong, please try again"], 200);
    }
}

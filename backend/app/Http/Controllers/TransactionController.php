<?php

namespace App\Http\Controllers;
use \MoneyChanger;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TransactionController extends Controller
{
    public function getRate(Request $request){
        $code = $request->input('code');
        $transaction_type = $request->input('type');
        // remove default value of 'type' to make understandable
        $validator = Validator::make($request->all(), [
            'code' => 'required|exists:currencies,code',
            'type' => 'required|in:buy,sell',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'messages' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }

        $data = MoneyChanger::getExchangeRate($code, $transaction_type);
        return response()->json($data, $data['success'] === true ? 200 : 400);
    }
    
    public function exchange(Request $request){
        $code = $request->input('code');
        $amount = $request->input('amount');
        $transaction_type = $request->input('type');

        $validator = Validator::make($request->all(), [
            'code' => 'required|exists:currencies,code',
            'type' => 'required|in:buy,sell',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'messages' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
        

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

            // save transanction to db
            $currency = DB::select('select id from currencies where code = ?', [$code])[0];
            $user_id = $request->user()->id;
            DB::insert('insert into transactions (currency_id, type, amount, rate, amount_result, created_by) values (?, ?, ?, ?, ?, ?)', 
            [$currency->id, $transaction_type, $amount, $rate, $result, $user_id]);

            return response()->json([
                'success' => true, 
                'message' => $message,
            ], 200);
        }
        return response()->json(['success' => false, 'message' => "Something went wrong, please try again"], 200);
    }
}

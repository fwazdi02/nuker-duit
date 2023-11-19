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
                'message' => implode(",", $validator->messages()->all()),
            ];
            return response()->json($response, 400);
        }

        $data = MoneyChanger::getExchangeRate($code);
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
                'message' => implode(",", $validator->messages()->all()),
            ];
            return response()->json($response, 400);
        }
        

        $data = MoneyChanger::getExchangeRate($code);
        if($data['success'] === true){
            $rate = $data['data']['idr'];
            $result = round($rate * $amount, 2);
            $message = '';
            if($transaction_type == 'buy'){
                $message = "You have successfully exchanged $amount ($code) to $result (idr)";
            }else{
                $message = "You have successfully exchanged $amount (idr) to $result ($code)";
            }

            // save transanction to db
            $currency = DB::select('select * from currencies where code = ?', [$code])[0];
            $user_id = $request->user()->id;
            $stock_amount = $currency->available_amount;

            if($transaction_type == 'buy'){
                $new_amount = (double)$stock_amount + (double)$amount;
            }else{
                $new_amount = (double)$stock_amount - (double)$amount;
            }
            
            // check is stock positive 
            if($new_amount < 0){
                return response()->json(['success' => false, 'message' => "Insufficient stock"], 400);
            }

            try {
                DB::beginTransaction();
                DB::update('update currencies set available_amount = ?, updated_at = ? where code = ?', [$new_amount, date('Y-m-d H:i:s') , $code]);
                DB::insert('insert into transactions (currency_id, type, amount, rate, amount_result, amount_stock, created_by, created_at) values (?, ?, ?, ?, ?, ?, ?, ?)', 
                [$currency->id, $transaction_type, $amount, $rate, $result, $new_amount, $user_id, date('Y-m-d H:i:s')]);
            }
            catch(Exception $e){
                DB::rollBack();
                return response()->json(['success' => false, 'message' => "Something went wrong, please try again"], 200);
            }

            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => $message,
            ], 200);
        }

        return response()->json(['success' => false, 'message' => "Something went wrong, please try again"], 200);
    }


    public function recentTransactions(){
        $user_id = auth()->user()->id;
        $transactions = DB::select("select distinct c.code, c.name, t.rate, t.created_at 
        from transactions as t 
        join currencies as c on t.currency_id = c.id 
        where t.created_by = ? 
        and t.created_at is not null
        and t.created_at > now() - interval '5 minutes'
        order by t.created_at desc 
        limit 4", [$user_id]);
        return response()->json(['success' => true, 'data' => $transactions], 200);
    }


    public function summaries(Request $request){
        $range = $request->input('range', null);
        $user_id = auth()->user()->id;
        $data_summaries = DB::select("
        select s1.code, s1.name,
        s1.total_buy,
        s1.total_sell,
        case
            when s1.last_saldo is null then 
                (select c1.available_amount from currencies as c1 where c1.code = s1.code) 
            else
                s1.last_saldo
            end as saldo
        from (
            select 
            c.code,
            c.name,
            (select coalesce(sum(t.amount), 0) from public.transactions as t where t.type = 'buy' and t.currency_id = c.id) as total_buy,
            (select coalesce(sum(t.amount), 0) from public.transactions as t where t.type = 'sell' and t.currency_id = c.id) as total_sell,
            (select 
                t.amount_stock 
                from public.transactions as t 
                where t.currency_id = c.id 
                order by t.created_at desc limit 1) as last_saldo
            from public.currencies as c
        ) as s1
        ");
        return response()->json(['success' => true, 'data' => $data_summaries], 200);
    }

}

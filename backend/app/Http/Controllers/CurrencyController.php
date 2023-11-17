<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    function index(Request $request){
        $data = DB::select('select * from currencies');
        return response()->json([ 'success' => true ,'data' => $data], 200);
    }
}



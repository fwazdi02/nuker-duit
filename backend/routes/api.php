<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $tokenResult = $user->createToken('MyAppToken');
        $accessToken = $tokenResult->accessToken;
        $tokenType = 'Bearer';
        $expiresIn = $tokenResult->token->expires_at->timestamp;
        $response = [
            'user' => $user,
            'access_token' => $accessToken,
            'token_type' => $tokenType,
            'expires_in' => $expiresIn,
        ];
        return response()->json(['success'=> true, 'data' => $response], 200);
    }
return response()->json([ 'success' => false, 'message' => 'Wrong email or password, please try again'], 400);
});

Route::middleware('auth:api')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
    
    Route::get('currencies', [CurrencyController::class, 'index']);
    Route::post('rate', [TransactionController::class, 'getRate']);
    Route::post('exchange', [TransactionController::class, 'exchange']);
});



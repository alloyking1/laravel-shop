<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group('/v1', function(){
//     Route::group('/user', function (){

//     });
// });

Route::prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    });
});

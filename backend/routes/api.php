<?php

use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\ForecastController;
use App\Http\Controllers\Api\GeoapifyController;
use App\Http\Controllers\Api\WeatherController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/forecast', ForecastController::class)->only([
    'index',
    'show',
]);
Route::apiResource('/geoapify', GeoapifyController::class)->only([
    'index',
]);

Route::get('/weather', WeatherController::class);
Route::get('/cities', CitiesController::class);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('/weather', [WeatherController::class, 'index']);
//Route::get('/weather', [WeatherController::class, 'showWeatherForm']);
//Route::get('/weather', [WeatherController::class, 'getWeather']);

Route::get('/check-db', function () {
    try {
        \DB::connection()->getPdo();
        return "Connected to database: " . \DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Could not connect to the database. Error: " . $e->getMessage();
    }
});

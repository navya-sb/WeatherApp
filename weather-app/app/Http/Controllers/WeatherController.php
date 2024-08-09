<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    // protected $weatherService;

    // public function __construct(WeatherService $weatherService)
    // {
    //     $this->weatherService = $weatherService;
    // }



    // // Function to fetch weather data from OpenWeather API
    // public function fetchWeatherData($city)
    // {
    //     $apiKey = env('OPENWEATHERMAP_API_KEY'); // Store your API key in the .env file
    //     $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

    //     $response = Http::get($url);

    //     if ($response->successful()) {
    //         return $response->json();
    //     }

    //     return null;
    // }

    // // Function to store weather data in the database
    // public function storeWeatherData($city)
    // {
    //     $weatherData = $this->fetchWeatherData($city);

    //     if ($weatherData) {
    //         DB::table('weather_forecasts')->insert([
    //             'city' => $city,
    //             'description' => $weatherData['weather'][0]['description'],
    //             'temperature' => $weatherData['main']['temp'],
    //             'humidity' => $weatherData['main']['humidity'],
    //             'wind_speed' => $weatherData['wind']['speed'],
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }
    // }

    // public function showWeatherForm(Request $request)
    // {
    //     $weather = null;
    //     if ($request->has('city')) {
    //         try {
    //             $weather = $this->weatherService->fetchWeather($request->input('city'));
    //         } catch (\Exception $e) {
    //             Log::error('Weather fetching error:', ['error' => $e->getMessage()]);
    //             return view('weather', ['error' => 'Failed to fetch weather data.']);
    //         }
    //     }

    //     return view('weather', ['weather' => $weather]);
    // }

    public $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $city = $request->input('city');
        if (empty($city)) {
            return view('weather', ['error' => 'City name is required.']);
        }

        try {
            $weather = $this->weatherService->fetchWeather($city);
            return view('weather', ['weather' => $weather]);
        } catch (\Exception $e) {
            \Log::error('Weather fetch error: ' . $e->getMessage());
            return view('weather', ['error' => 'Unable to fetch weather data.']);
        }
    }
}
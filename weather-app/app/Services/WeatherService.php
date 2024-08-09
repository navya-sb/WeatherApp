<?php
namespace App\Services;

use App\Models\WeatherForecast;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
    }

    public function fetchWeather($city)
    {
        $response = Http::get("http://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric'
        ]);
        $data = env('OPENWEATHERMAP_API_KEY');
        Log::info('Request URL:', [
            'url' => "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$data}&units=metric"
        ]);

        if ($response->failed()) {
            \Log::error('Weather API request failed', ['response' => $data]);
            throw new \Exception('Unable to fetch weather data.');
        }

        $data = $response->json();

        $weather = new WeatherForecast();
        $weather->city = $data['name'];
        $weather->description = $data['weather'][0]['description'];
        $weather->temperature = $data['main']['temp'];
        $weather->humidity = $data['main']['humidity'];
        $weather->wind_speed = $data['wind']['speed'];
        $weather->save();

        return $weather;
    }
}
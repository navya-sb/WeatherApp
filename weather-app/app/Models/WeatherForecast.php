<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    use HasFactory;
    protected $fillable = ['city', 'description', 'temperature', 'humidity', 'wind_speed'];
}
//36e54ed241e297fbe129bfb842fa2243
//b81c41c2e0642f62bd4b23d16662509e

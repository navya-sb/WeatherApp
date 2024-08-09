<!DOCTYPE html>
<html>
<head>
    <title>Weather Forecast</title>
</head>
<body>
    <form action="/weather" method="GET">
        <input type="text" name="city" placeholder="Enter city name" required>
        <button type="submit">Get Weather</button>
    </form>

    @if(isset($error))
        <p style="color: red;">{{ $error }}</p>
    @elseif(isset($weather))
        <h2>Weather in {{ $weather->city }}</h2>
        <p>Description: {{ $weather->description }}</p>
        <p>Temperature: {{ $weather->temperature }} °C</p>
        <p>Humidity: {{ $weather->humidity }} %</p>
        <p>Wind Speed: {{ $weather->wind_speed }} m/s</p>
    @endif
</body>
</html>
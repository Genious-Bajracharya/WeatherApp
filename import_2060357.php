<?php
$sql = "SELECT *
FROM weather
WHERE city = '{$_GET['city']}'
AND weather_when >= DATE_SUB(NOW(), INTERVAL 10 SECOND)
ORDER BY weather_when DESC limit 1";
$result = $mysqli -> query($sql);

if ($result->num_rows == 0) {
$url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $_GET['city'] . '&appid=b794e500daee088eae8d3199511cd899&units=metric';

$data = file_get_contents($url);
$json = json_decode($data, true);

$weather_description = $json['weather'][0]['description'];
$weather_temperature = $json['main']['temp'];
$weather_wind = $json['wind']['speed'];
$weather_when = date("Y-m-d H:i:s");
$city = $json['name'];
$Humidity=$json['main']['humidity'];
$Maximum_Temperature=$json['main']['temp_max'];
$Minimum_Temperature=$json['main']['temp_min'];



$sql = "INSERT INTO weather (weather_description, weather_temperature, weather_wind, weather_when, city,Humidity,Maximum_Temperature,Minimum_Temperature)
VALUES('{$weather_description}', {$weather_temperature}, {$weather_wind}, '{$weather_when}', '{$city}',{$Humidity},{$Maximum_Temperature},{$Minimum_Temperature})";

if (!$mysqli -> query($sql)) {
echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");

}
}
?>


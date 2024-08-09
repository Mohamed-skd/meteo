<?php
require_once "../../app.php";

$page = basename(__DIR__);
$title = "Météo";

function getPlaceCoord(string $search)
{
  global $serverFn;
  try {
    $api = $serverFn->fetch("https://geocoding-api.open-meteo.com/v1/search?name=$search&count=1&language=fr&format=json");
    if (!isset($api["results"])) return [];

    $res = [
      $api["results"][0]["country"],
      $api["results"][0]["name"],
      $api["results"][0]["latitude"],
      $api["results"][0]["longitude"]
    ];
    // print_r($api);
    // print_r($res);
  } catch (Exception $err) {
    return $serverFn->error($err);
  }
  return $res;
}
function getPlaceWeather(array $coord)
{
  if (!$coord) return false;
  global $serverFn;
  global $dateFn;

  try {
    [$country, $place, $latitude, $longitude] = $coord;
    $api = $serverFn->fetch("https://api.open-meteo.com/v1/forecast?latitude=$latitude&longitude=$longitude&current=temperature_2m,relative_humidity_2m,apparent_temperature,is_day,precipitation,cloud_cover,surface_pressure,wind_speed_10m,wind_direction_10m&daily=temperature_2m_max,temperature_2m_min,sunrise,sunset&forecast_days=1");
    if (!isset($api["current"]) || !isset($api["daily"])) return false;

    $weather = [
      "place" => $place,
      "country" => $country,
      "time" => $dateFn->formatDate(format: "d/m/Y à H:i"),
      "is_day" => $api["current"]["is_day"] ? "☀️" : "🌃",
      "temp" => $api["current"]["temperature_2m"] . "°C",
      "temp_max" => $api["daily"]["temperature_2m_max"][0] . "°C",
      "temp_min" => $api["daily"]["temperature_2m_min"][0] . "°C",
      "temp_feel" => $api["current"]["apparent_temperature"] . "°C",
      "humidity" => $api["current"]["relative_humidity_2m"] . "%",
      "precipitation" => $api["current"]["precipitation"] . "mm",
      "cloud_cover" => $api["current"]["cloud_cover"] . "%",
      "pressure" => $api["current"]["surface_pressure"] . "hPa",
      "wind_speed" => $api["current"]["wind_speed_10m"] . "km/h",
      "wind_direction" => $api["current"]["wind_direction_10m"] . "°"
    ];
    // print_r($api);
    // print_r($weather);
  } catch (Exception $err) {
    return $serverFn->error($err);
  }

  return $weather;
}

if (isset($_GET["place"])) {
  $place = $strFn->escape($_GET["place"]);
  if ($place && strlen($place) <= 100) {
    $coord = getPlaceCoord($place);
    $weather = getPlaceWeather($coord);
  } else {
    unset($place);
  }
}
<?php

session_start();
$url_json = "http://api.openweathermap.org/data/2.5/weather?lat=" . $_SESSION['latitud'] . "&lon=" . $_SESSION['longitud'] . "&units=metric&lang=es";
//$url_json = "http://api.openweathermap.org/data/2.5/weather?lat=37.39&lon=-5.98&units=metric&lang=es";

$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$json = curl_exec($ch);
curl_close($ch);
$data = json_decode($json, true);
$descripcion = $data['weather'][0]['description'];
$temperatura = $data['main']['temp'];
echo "Temperatura: ".$temperatura."°C<br>Tiempo: ".$descripcion;
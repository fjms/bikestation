<?php

session_start();

$latidud = floor($_SESSION['latitud'] * 100) / 100;
$longitud = floor($_SESSION['longitud'] * 100) / 100;

$url_json = "http://api.openweathermap.org/data/2.5/weather?lat=" . $latitud . "&lon=" . $longitud . "&units=metric&lang=es";
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$json = curl_exec($ch);
curl_close($ch);
$data = json_decode($json, true);
$descripcion = $data['weather'][0]['description'];
$icono = $data['weather'][0]['icon'] . ".png";
$temperatura = $data['main']['temp'];
echo "<h3>" . $_SESSION['ciudad'] . "</h3>";
echo '<img src="http://openweathermap.org/img/w/' . $icono . '" ><br>';
echo $descripcion . "<br>" . $temperatura . "°C";

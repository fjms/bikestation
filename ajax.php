<?php

session_start();
if (isset($_SESSION['id'])) {
    $url_json = "http://api.citybik.es/v2/networks/" . $_SESSION['id'];
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $json = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($json, true);
    $station = $data['network']['stations'];
    $col = [];
    for ($i = 0; $i < count($station); $i++) {
        $fil = [];
        $fil['name'] = $station[$i]['name'];
        $fil['slots'] = $station[$i]['extra']['slots'];
        $fil['free_bikes'] = $station[$i]['free_bikes'];
        $fil['empty_slots'] = $station[$i]['empty_slots'];
        $col['data'][$i] = $fil;
    }
    $datos = json_encode($col);
    echo $datos;
}
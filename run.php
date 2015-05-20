<?php

session_start();


if (isset($_POST['enviar'])) {
    $_SESSION['id'] = $_POST['ciudad'];
    header('Location: ./index.php');
} else if (isset($_GET['q'])) {
    $pais = $_GET['q'];
    $url_json = "http://api.citybik.es/v2/networks/?fields=id,location";
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $json = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($json, true);
    $net = $data['networks'];
    for ($i = 0; $i < count($data['networks']); $i++) {
        $country = $net[$i]['location']['country'];
        if ($country === $pais) {
            echo "<option value=" . $net[$i]['id'] . ">";
            echo $net[$i]['location']['city'];
            echo "</option>";
        }
    }
}
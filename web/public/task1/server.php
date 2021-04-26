<?php

session_start();

if (!isset($_GET['ip'])) {
    echo json_encode(['status' => 'error']);
    exit;
}

['ip' => $ip] = $_GET;

if (isset($_SESSION[$ip])) {
    $cityName = $_SESSION[$ip];
    echo json_encode([
        'status' => 'success',
        'cityName' => $cityName,
        'isCached' => true
    ]);
    exit;
}

$wsdl = 'http://ws.cdyne.com/ip2geo/ip2geo.asmx?WSDL';
$client = new SoapClient($wsdl);

$result = $client->ResolveIP(['ipAddress' => $ip, 'licenseKey' => 0]);

if (is_soap_fault($result)) {
    echo json_encode(['status' => 'error']);
    exit;
}

$cityName = $result->ResolveIPResult->City;

if (empty($cityName)) {
    echo json_encode(['status' => 'error']);
    exit;
}

$_SESSION[$ip] = $cityName;

echo json_encode([
    'status' => 'success',
    'cityName' => $cityName,
    'isCached' => false
]);

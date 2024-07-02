<?php
header('Content-Type: application/json');

// Only allow GET REQUEST
if( $_SERVER['REQUEST_METHOD'] != 'GET'){
    echo 'Unsupported Request Method';
    exit;
}

// Check if Name Exists
if( trim($_GET['visitor_name']) == '' ){
    echo 'Visitor Name empty';
    exit;
}

// Trim from whitespaces
$name = trim($_GET['visitor_name']);
$name = str_replace('"', '', $name);


$client_ip = $_SERVER['REMOTE_ADDR'];

// Get IP details
$client_details = json_decode(file_get_contents("http://ipinfo.io/{$client_ip}/json"));
$greetings = 'Hello, '. $name .'!, the temperature is 11 degrees Celcius in '. $client_details->city;

$response = [
    'client_ip' => $client_ip,
    'location' => $client_details->city,
    'greetings' => $greetings,
];
echo json_encode($response);
exit;

?>
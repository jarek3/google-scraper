<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if (!isset($_GET['q']) || empty($_GET['q'])) {
    echo json_encode(["error" => "Nezadali jste klíčové slovo."]);
    exit;
}

$query = urlencode($_GET['q']);
$apiKey = 'AIzaSyDJmWnC2Ln25Kqxnjy_qcQ4rcnkU3Chv_w';  // Tvůj API klíč
$searchEngineId = '9638f6645fffe407b';  // Tvůj Search Engine ID
$url = "https://www.googleapis.com/customsearch/v1?q={$query}&key={$apiKey}&cx={$searchEngineId}";

$response = file_get_contents($url);
if ($response === false) {
    echo json_encode(["error" => "Chyba při získávání výsledků."]);
    exit;
}
$response = file_get_contents($url);


$data = json_decode($response, true);
$results = [];

foreach ($data['items'] as $item) {
    $results[] = [
        "title" => $item['title'],
        "url" => $item['link']
    ];
}

echo json_encode(["results" => $results], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

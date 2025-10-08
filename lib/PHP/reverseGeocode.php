<?php
  header('Content-Type: application/json');

  if (!isset($_GET['lat']) || !isset($_GET['lon'])) {
    echo json_encode(['error' => 'Missing lat/lon']);
    exit;
  }

  $lat = $_GET['lat'];
  $lon = $_GET['lon'];

  $url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=$lat&lon=$lon";

  $options = [
    'http' => [
      'header' => "User-Agent: GazetteerApp/1.0\r\n"
    ]
  ];

  $context = stream_context_create($options);
  $response = file_get_contents($url, false, $context);

  if ($response === FALSE) {
    echo json_encode(['error' => 'Failed to reach Nominatim']);
  } else {
    echo $response;
  }
?>
<?php

$xmlFile = 'data.xml';

if (!file_exists($xmlFile)) {
    die('XML file not found.');
}

$xml = simplexml_load_file($xmlFile);

if (!$xml) {
    die('Failed to parse XML.');
}

// Decide output format: ?format=json or ?format=html
$format = $_GET['format'] ?? 'json';

if ($format === 'html') {
    header('Content-Type: text/html; charset=UTF-8');

    echo "<h2>XML Data (HTML Output)</h2><ul>";

    foreach ($xml->item as $item) {
        echo "<li>";
        foreach ($item as $key => $value) {
            echo "<strong>{$key}:</strong> {$value}<br>";
        }
        echo "</li><br>";
    }

    echo "</ul>";
} else {
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($xml, JSON_PRETTY_PRINT);
}

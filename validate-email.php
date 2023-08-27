<?php
$mysqli = require __DIR__ . "/database.php";

// Corrected SQL query with proper string concatenation
$sql = sprintf("SELECT * FROM users WHERE email ='%s'", $mysqli->real_escape_string($_GET["email"]));

$result = $mysqli->query($sql);

$is_available = $result->num_rows === 0;

// Set the appropriate content type for JSON response
header("Content-Type: application/json");

// Build an associative array for the JSON response
$response = ["available" => $is_available];

// Encode the response as JSON and echo it
echo json_encode($response);

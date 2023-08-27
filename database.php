<?php

// Credentials
$host = 'localhost';
$dbname = 'login_db';
$username = 'root';
$password = 'kensotosala';

$mysqli = new mysqli(hostname: $host, username: $username, password: $password, database: $dbname, port: 3308);


// Validate the connection
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}


return $mysqli;

<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'login_db';
$username = 'root';
$password = 'kensotosala';

// Create a new instance of the mysqli class to establish a database connection
$mysqli = new mysqli(hostname: $host, username: $username, password: $password, database: $dbname, port: 3308);

// Check if there's a connection error
if ($mysqli->connect_errno) {
    // If an error occurs, terminate execution and display the error message
    die("Connection error: " . $mysqli->connect_error);
}

// Return the database connection object for use in other parts of the application
return $mysqli;

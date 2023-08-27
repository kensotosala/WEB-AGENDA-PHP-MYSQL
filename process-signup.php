<?php

// Validate user information
if (empty($_POST['name'])) {
    die("Name cannot be empty");
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter!");
}

if (!preg_match("/[0-9]/i", $_POST["password"])) {
    die("Password must contain at least one number!");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}


// Hash the password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


// DB
$mysqli = require __DIR__ . "/database.php";


// Insert
$sql = "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss", $_POST['name'], $_POST['email'], $password_hash);


// Check the register
try {
    if ($stmt->execute()) {
        header("Location: signup-success.html");
        exit;
    }
} catch (mysqli_sql_exception $e) {
    $error_message = "Email already taken";
    die($error_message);
}

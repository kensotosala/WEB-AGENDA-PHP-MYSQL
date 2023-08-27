<?php
// Check if the 'name' field is empty
if (empty($_POST['name'])) {
    // If it's empty, terminate the script and display an error message
    die("Name cannot be empty");
}

// Check if the 'email' field contains a valid email address
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    // If not a valid email, terminate the script and display an error message
    die("Valid email is required");
}

// Check if the length of the 'password' field is at least 8 characters
if (strlen($_POST["password"]) < 8) {
    // If the password is too short, terminate the script and display an error message
    die("Password must be at least 8 characters");
}

// Check if the 'password' field contains at least one letter
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    // If no letter is found, terminate the script and display an error message
    die("Password must contain at least one letter!");
}

// Check if the 'password' field contains at least one number
if (!preg_match("/[0-9]/i", $_POST["password"])) {
    // If no number is found, terminate the script and display an error message
    die("Password must contain at least one number!");
}

// Check if the 'password' and 'password_confirmation' fields match
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    // If passwords don't match, terminate the script and display an error message
    die("Passwords must match");
}

// Hash the password using the default password hashing algorithm
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Require the database connection configuration
$mysqli = require __DIR__ . "/database.php";

// SQL query to insert user data into the 'users' table
$sql = "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)";

// Initialize a new statement object
$stmt = $mysqli->stmt_init();

// Check if the statement is prepared successfully
if (!$stmt->prepare($sql)) {
    // If not prepared successfully, terminate the script and display an error message
    die("SQL error: " . $mysqli->error);
}

// Bind the parameters to the statement
$stmt->bind_param("sss", $_POST['name'], $_POST['email'], $password_hash);

try {
    // Execute the statement
    if ($stmt->execute()) {
        // If the execution is successful, redirect to the signup success page and exit
        header("Location: signup-success.html");
        exit;
    }
} catch (mysqli_sql_exception $e) {
    // If an exception is caught, set an error message and terminate the script
    $error_message = "Email already taken";
    die($error_message);
}

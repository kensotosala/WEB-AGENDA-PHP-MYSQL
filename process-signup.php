<?php

// Validate user information
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

print_r($_POST);
var_dump($password_hash);

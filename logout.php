<?php
// Start the session to work with session variables
session_start();

// Destroy the current session, effectively logging the user out
session_destroy();

// Redirect the user to the "index.php" page after logging out
header("Location: index.php");

// Exit the script to prevent further execution
exit;

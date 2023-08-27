<?php
// Start a new session.
session_start();

// Check if the `user_id` session variable is set.
if (isset($_SESSION["user_id"])) {

    // Connect to the database.
    $mysqli = require __DIR__ . "/database.php";

    // Prepare the SQL query.
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";

    // Execute the SQL query.
    $result = $mysqli->query($sql);

    // Fetch the user row from the result set.
    $user = $result->fetch_assoc();
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <h1>Home</h1>

        <?php
        // Check if the user key exists in the session array
        if (isset($user)) : ?>
            <!-- Display a greeting message with the user's name (escaping HTML characters) -->
            <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
            <!-- Provide a link to log out -->
            <p><a href="logout.php">Log out</a></p>
        <?php else : ?>
            <!-- If the user key doesn't exist in the session array, show these options -->
            <!-- Provide links to login and signup pages -->
            <p><a href="login.php">Login</a> or <a href="signup.html">sign up</a></p>
        <?php endif; ?>

    </main>
    <footer>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
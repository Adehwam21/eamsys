<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['objLogin'])) {
    // Redirect to the dashboard if logged in
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management - Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS files here -->
</head>
<body>

    <div class="container">
        <header>
            <h1>Employee Management System</h1>
            <nav>
                <ul>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </header>

        <div class="content">
            <h2>Welcome to the Employee Management System</h2>
            <p>Please log in to access the dashboard.</p>
        </div>
    </div>

</body>
</html>
